<?php

abstract class Events
{
	public static $_errors_list = array() ;
	public static $_success_list = array() ;
	public static $_infos_list = array() ;

	public static function add (Events $event)
	{
		if (get_class($event) === 'Error') :
			self::$_errors_list[] = $event ;
		elseif (get_class($event) === 'Success') :
			self::$_success_list[] = $event ;
		elseif (get_class($event) === 'Info') :
			self::$_infos_list[] = $event ;
		endif;
	}

	public static function isAnyEvent ($minLevel = 0, $maxLevel = null)
	{
		if	(
				self::isAnyError($minLevel, $maxLevel) ||
				self::isAnySuccess($minLevel, $maxLevel) ||
				self::isAnyInfo($minLevel, $maxLevel)
			)
			{ return true ; }
		else
			{ return false ; }
	}


	// Errors
		public static function getFatalErrors ()
		{
			$retour = array();

			foreach (self::$_errors_list as $error)
			{
				if ($error->_visibility > 0 && $error->_level > 0)
				{
					$retour[] = $error ;
				}
			}

			return (!empty($retour)) ? $retour : null ;
		}

		public static function getNormalErrors ()
		{
			$retour = array();

			foreach (self::$_errors_list as $error)
			{
				if ($error->_visibility > 0 && $error->_level === 0)
				{
					$retour[] = $error ;
				}
			}

			return (!empty($retour)) ? $retour : null ;
		}

		public static function getErrorCode ()
		{
			foreach (self::$_errors_list as $error)
			{
				if (is_int($error->_server_code))
				{
					return $error->_server_code ;
				}
			}

			// Pas d'erreur :
			return null ;
		}

		public static function isAnyError ($minLevel = 0, $maxLevel = null)
		{
			if ($minLevel === 0 && empty(self::$_errors_list))
				{ return false ; }
			elseif ($maxLevel === null)
			{ 
				foreach (self::$_errors_list as $error)
				{
					if ($error->_level >= $minLevel)
					{
						return true ;
					}
				}
			}
			elseif ($maxLevel >= $minLevel)
			{ 
				foreach (self::$_errors_list as $error)
				{
					if ($error->_level >= $minLevel && $error->_level <= $maxLevel)
					{
						return true ;
					}
				}
			}

			return false ;
		}

	// Success

		public static function isAnysuccess ($minLevel = 0, $maxLevel = null)
		{
			if ($minLevel === 0 && empty(self::$_success_list))
				{ return false ; }
			elseif ($maxLevel === null)
			{ 
				foreach (self::$_success_list as $succes)
				{
					if ($succes->_level >= $minLevel)
					{
						return true ;
					}
				}
			}
			elseif ($maxLevel >= $minLevel)
			{ 
				foreach (self::$_success_list as $succes)
				{
					if ($succes->_level >= $minLevel && $succes->_level <= $maxLevel)
					{
						return true ;
					}
				}
			}

			return false ;
		}

	// Infos

		public static function isAnyinfo ($minLevel = 0, $maxLevel = null)
		{
			if ($minLevel === 0 && empty(self::$_infos_list))
				{ return false ; }
			elseif ($maxLevel === null)
			{ 
				foreach (self::$_infos_list as $info)
				{
					if ($info->_level >= $minLevel)
					{
						return true ;
					}
				}
			}
			elseif ($maxLevel >= $minLevel)
			{ 
				foreach (self::$_infos_list as $info)
				{
					if ($info->_level >= $minLevel && $info->_level <= $maxLevel)
					{
						return true ;
					}
				}
			}

			return false ;
		}

		//////

	public $_level ;  // 0=service normal / 1=Erreur remarquable / 3=Erreur grave
	public $_public_details ;
	public $_visibility ; // 2 = tjs visible / 1 = Visible en mode DEV / 0 = Jamais visible

}


class Error extends Events
{
	public $_server_code ;
	public $_name ;
	public $_private_details ;

	protected $_line ;
	protected $_timestamp ;

		//////

	public function __construct (
		$server_code = null,
		$name = null,
		$private_details = null,
		$public_details = null,
		$visibility = 2,
		$level = 2,
		$line = null)
	{
		$this->_server_code = $server_code ;
		$this->_name = $name ;
		$this->_private_details = $private_details ;
		$this->_public_details = $public_details ;
		$this->_visibility = $visibility ;
		$this->_level = $level;

		$this->_timestamp = time() ;

		if ($line !== null)
		{

		}
		else
		{
			$this->_line = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1) ;
			$this->_line = $this->_line[0]['file'] . ' - l.' . $this->_line[0]['line'] ;
		}

		$this->autoComplete() ;

		// if (CONFIG_ENV === 'DEV') { var_dump(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS)); }
	}

	public function __destruct ()
	{
		if ($this->_level > 0)
		{
			$bean = R::dispense( 'error' );

			$bean->date = R::isoDateTime($this->_timestamp) ;

			$bean->server_code = $this->_server_code;
			$bean->name = $this->_name ;
			$bean->public_details = $this->_public_details ;
			$bean->private_details = $this->_private_details ;
			$bean->visibility = $this->_visibility ;
			$bean->level = $this->_level ;
			$bean->line = $this->_line ;

			R::store($bean);
		}
	}

		//////

	protected function autoComplete ()
	{
		if ($this->_server_code === 404)
		{
			if (is_null($this->_name)) 
				{ $this->_name = '404'; }
		}
		elseif ($this->_server_code === 500)
		{
			if (is_null($this->_name)) 
				{ $this->_name = '500'; }
		}

			///

		if (is_null($this->_private_details) && !is_null($this->_public_details))
		{
			$this->_private_details = $this->_public_details ;
		}
	}
}

abstract class Message extends Events
{	
	public function __construct ($public_details, $visibility = 2, $level = 0)
	{
		$this->_public_details = $public_details ;
		$this->_visibility = $visibility ;
		$this->_level = $level;
	}
}

class Success extends Message
{}

class Info extends Message
{}