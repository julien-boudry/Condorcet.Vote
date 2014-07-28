<?php

class Events
{
	public static $_error_list = array() ;
	public static $_message_list = array() ;

	public static function add (Events $event)
	{
		if (get_class($event) === 'Error') :
			self::$_error_list[] = $event ;
		elseif (get_class($event) === 'Message') :
			self::$_message_list[] = $event ;
		endif;
	}

	public static function getFatalErrors ()
	{
		$retour = array();

		foreach (self::$_error_list as $error)
		{
			if ($error->_visibility > 0 && $error->_level > 0)
			{
				$retour[] = $error ;
			}
		}

		return (!empty($retour)) ? $retour : null ;
	}

	public static function getErrorCode ()
	{
		foreach (self::$_error_list as $error)
		{
			if (is_int($error->_server_code))
			{
				return $error->_server_code ;
			}
		}

		// Pas d'erreur :
		return null ;
	}

	public static function isAnyError ($minLevel = 0)
	{
		if ($minLevel === 0 && empty(self::$_error_list))
			{ return false ; }
		elseif ($minLevel === 0)
			{ return true ; }
		elseif ($minLevel !== 0)
		{ 
			foreach (self::$_error_list as $error)
			{
				if ($error->_level >= $minLevel)
				{
					return true ;
				}
			}

			return false ;
		}		
	}

		//////

	public $_source ;
}


class Error extends Events
{
	public $_server_code ;
	public $_name ;
	public $_public_details ;
	public $_private_details ;
	public $_visibility ; // 2 = tjs visible / 1 = Visible en mode DEV / 0 = Jamais visible
	public $_level ; // 0=service normal / 1=Erreur remarquable / Erreur grave

	protected $_line ;
	protected $_timestamp ;

		//////

	public function __construct ($server_code = null, $name = null, $private_details = null, $public_details = null, $visibility = 2, $level = 1)
	{
		$this->_server_code = $server_code ;
		$this->_name = $name ;
		$this->_private_details = $private_details ;
		$this->_public_details = $public_details ;
		$this->_visibility = $visibility ;
		$this->_level = $level;

		$this->_timestamp = time() ;	

		$this->_line = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1) ;
		$this->_line = $this->_line[0]['file'] . ' - l.' . $this->_line[0]['line'] ;

		$this->autoComplete() ;
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
				{ $this->_name = 'Error 404'; }
		}

			///

		if (is_null($this->_private_details) && !is_null($this->_public_details))
		{
			$this->_private_details = $this->_public_details ;
		}
	}
}