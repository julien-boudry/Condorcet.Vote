<?php

class Add_Controller extends Controller
{
	protected $_view = 'add' ;

		//////

	protected $_Condorcet_Vote = false ;


	public function __construct ($condorcet_vote = null)
	{
		parent::__construct();
		
		// Edit Controller est appellé depuis Create Controller
		if (is_object($condorcet_vote))
		{
			$this->_Condorcet_Vote = $condorcet_vote ;
		}
		// Edit Controller est appelé directement via URL (pas d'API)
		elseif	(	is_null($condorcet_vote) && 
					isset($_GET['vote']) &&
					isset($_GET['mode'])
				)
		{
			try {
				$this->_Condorcet_Vote = new Condorcet_Vote($_GET['vote']);
			} catch (Exception $e)
			{
				$this->_Condorcet_Vote = false ;
				return false ;
			}

			if	(
					$_GET['mode'] === 'Public' &&
					isset($_GET['free_vote_code'])
				)
			{
				if	( $this->_Condorcet_Vote->getFreeVoteCode() !== $_GET['free_vote_code']	)
				{
					$this->_Condorcet_Vote = false ;
					return false ;
				}
			}
			elseif	( 	$_GET['mode'] === 'Personnal' &&
						isset($_GET['personnal_name']) &&
						isset($_GET['personnal_code']) )
			{
				if	( $this->_Condorcet_Vote->getPersonnalVoteCode($_GET['personnal_name']) !== $_GET['personnal_code'] )
				{
					$this->_Condorcet_Vote = false ;
					return false ;
				}
			}
			else
			{
				$this->_Condorcet_Vote = false ;
				return false ;
			}
		}
	}


	public function showPage ($follow = null, $position = 'after')
	{
		if ($this->_Condorcet_Vote !== false)
		{
			parent::showPage(new Vote_Controller ($this->_Condorcet_Vote));
		}
		else
		{
			$error = new Error_Controller(500);
			$error->showPage();
		}
	}

}