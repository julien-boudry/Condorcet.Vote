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

		//////

	public $_source ;
}


class Error extends Events
{
	public $_server_code ;
	public $_name ;
	public $_details ;
	public $_visibility ; // 2 = tjs visible / 1 = Visible en mode DEV / 0 = Jamais visible
	public $_level ; // 0=service normal / 1=Erreur remarquable / Erreur grave

	protected $_timestamp ;

		//////

	public function __construct ($source = null, $server_code = null, $name = null, $details = null, $visibility = 2, $level = 1)
	{
		$this->_server_code = $server_code ;
		$this->_name = $name ;
		$this->_details = $details ;
		$this->_visibility = $visibility ;
		$this->_level = $level;
		$this->_source = $source;

		$this->_timestamp = time() ;

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
			$bean->details = $this->_details ;
			$bean->visibility = $this->_visibility ;
			$bean->level = $this->_level ;
			$bean->source = $this->_source ;

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

			if (is_null($this->_details)) 
				{ $this->_details = '???'; }
		}
	}
}