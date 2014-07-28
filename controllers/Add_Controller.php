<?php

class Add_Controller extends Controller
{
	protected $_view = 'Add' ;

		//////

	protected $_Condorcet_Vote = false ;

	protected $_mode ;
	protected $_etat ;


	public function __construct ($condorcet_vote = null)
	{
		parent::__construct();
		
		if	(	isset($_GET['vote']) &&
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

			// Is Open ?
			if (!$this->_Condorcet_Vote->isOpen())
			{
				Events::add( new Error (404, null, 'Le vote est fermé') );
				return false ;
			}

			// Public Mode
			if	(
					$_GET['mode'] === 'Public' &&
					isset($_GET['free_vote_code'])
				)
			{
				$this->_mode = 'Public' ;

				if	( $this->_Condorcet_Vote->getFreeVoteCode() !== $_GET['free_vote_code']	)
				{
					$this->_Condorcet_Vote = false ;
					return false ;
				}

				// Reception des votes
				if	(
						isset($_POST['add_vote_content']) &&
						isset($_POST['add_name'])
					)
				{
					// Check vote déjà existant
					if	(
							!empty($_POST['add_name']) && 
							!empty($this->_Condorcet_Vote->_objectCondorcet->getVotesList($_POST['add_name']))
						)
					{
						$this->_etat = 'double' ;
						return false ;
					}

					// Test d'enregistrement
					$this->_etat = ($this->try_add_vote($_POST['add_name'], $_POST['add_vote_content'])) ? true : false ;
				}
			}
			// Personnal mode
			elseif	(
						$_GET['mode'] === 'Personnal' &&
						isset($_GET['personnal_name']) && !empty($_GET['personnal_name']) &&
						isset($_GET['personnal_code'])
					)
			{
				$this->_mode = 'Personnal' ;

				if	( $this->_Condorcet_Vote->getPersonnalVoteCode($_GET['personnal_name']) !== $_GET['personnal_code'] )
				{
					$this->_Condorcet_Vote = false ;
					return false ;
				}

				// Check vote déjà existant
				if ( !empty($this->_Condorcet_Vote->_objectCondorcet->getVotesList($_GET['personnal_name'])) )
				{
					$this->_etat = 'double' ;
					return false ;
				}

				// Reception des votes
				if (isset($_POST['add_vote_content']))
				{
					// Test d'enregistrement
					$this->_etat = ($this->try_add_vote($_GET['personnal_name'], $_POST['add_vote_content'])) ? true : false ;
				}
			}
			else
			{
				$this->_Condorcet_Vote = false ;
				return false ;
			}
		}
	}

	protected function try_add_vote ($name, $vote)
	{
		if	( 
				(empty($name) && $this->_mode === 'Personnal') || // ligne de pure sécurité parano.
				(!empty($name) && $this->_mode === 'Public' && strlen($name > 20) && !ctype_alpha($name))				
			)
		{
			return false ;
		}

		$name = array(
			($this->_mode === 'Personnal') ? 'Personnal-Vote' : 'Public-Vote'
			,$name
		);

		try {
			$this->_Condorcet_Vote->_objectCondorcet->addVote($vote, $name);		
		} catch (Exception $e) {
			return false ;
		}

		return true ;
	}


	public function showPage ($follow = null, $position = 'after')
	{
		if ($this->_Condorcet_Vote !== false)
		{
			parent::showPage(new Vote_Controller ($this->_Condorcet_Vote));
		}
		else
		{
			Events::add( new Error (502) );
				return false ;

			parent::showPage();
		}
	}

}