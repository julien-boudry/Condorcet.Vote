<?php

class Vote_Controller extends Controller
{
	protected $_view = 'Vote' ;

	protected $_Condorcet_Vote = false ;
	protected $_objectCondorcet ;

		//////


	public function __construct ($build = false)
	{
		parent::__construct();

		// Construction depuis Edit
		if (is_object($build))
		{
			$this->_Condorcet_Vote = $build ;
			$this->_objectCondorcet = $this->_Condorcet_Vote->_objectCondorcet ;
		}
		// Construction depuis URL avec parametre(s) manquant(s)
		elseif (empty($_GET['vote']))
		{
			Events::add( new EventsError (404) );
		}
		// Tentative de construction depuis URL
		else
		{
			try
			{
				$this->_Condorcet_Vote = new Condorcet_Vote ($_GET['vote']);
				$this->_objectCondorcet = $this->_Condorcet_Vote->_objectCondorcet ;
			}
			catch (Exception $e) {
				Events::add( new EventsError (server_code: 404, private_details: $e) );
				$this->_Condorcet_Vote = false ;
			}
		}

		if ($this->_Condorcet_Vote !== false)
			{ Controller::AddCanonical( $this->_Condorcet_Vote->getPublicURL() ); }
	}


	protected function getTitle ()
	{
		return 'Condorcet Vote: ' . $this->_Condorcet_Vote->getTitle() ;
	}

}