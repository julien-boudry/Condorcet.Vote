<?php

class Edit_Controller extends Controller
{
	protected $_view = 'edit' ;

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
		elseif (is_null($condorcet_vote) && isset($_GET['vote']) && isset($_GET['admin_code']))
		{
			try {
				$this->_Condorcet_Vote = new Condorcet_Vote($_GET['vote']);		
			} catch (Exception $e) {
				$this->_Condorcet_Vote = false ;
				return false ;
			}

			// Controle de la validité du code
			if ($this->_Condorcet_Vote->_bean->admin_code !== $_GET['admin_code'])
			{
				$this->_Condorcet_Vote = false ;
				return false ;
			}

			// Demande d'édition ?
			if	(
					isset($_POST['is_edit']) &&
					isset($_POST['edit_description'])
				)
			{
				$this->update_vote();
			}
		}
	}

	protected function update_vote ()
	{
		// Update (ou non) de la description
		if	(
				$_POST['edit_description'] !== $this->_Condorcet_Vote->_bean->description
				&&
				$_POST['edit_description'] <= CONFIG_DESCRIPTION_LENGHT
			)
		{
			$this->_Condorcet_Vote->_bean->description = $_POST['edit_description'] ;
		}

		// Update (ou non) de la des methods
		$this->_Condorcet_Vote->update_methods(
			( empty($_POST['edit_methods']) ) ? array() : $_POST['edit_methods']
		);


		// Delete Votes
		if (!empty($_POST['delete_votes']))
		{
			try
			{
				$delete_votes = $_POST['delete_votes'];

				if (Condorcet\Condorcet::isJson($delete_votes))
				{
					$delete_votes = Condorcet\Condorcet::prepareJson($delete_votes);

					if (!is_array($delete_votes))
						{$delete_votes = array();}
				}
				else
				{
					$delete_votes = Condorcet\Condorcet::prepareParse($delete_votes, false);
				}

				foreach ($delete_votes as &$value) {
					if (is_numeric($value))
						{$value = intval($value);}
				}
				
				$this->_Condorcet_Vote->_objectCondorcet->removeVote($delete_votes);

			}
			catch (Exception $e)
			{}
		}

		// Add votes
		if (!empty($_POST['add_votes']))
		{
			try
			{
				if (Condorcet\Condorcet::isJson($_POST['add_votes']))
				{
					$this->_Condorcet_Vote->_objectCondorcet->jsonVotes($_POST['add_votes']);
				}
				else
				{
					$this->_Condorcet_Vote->_objectCondorcet->parseVotes($_POST['add_votes']);
				}

			}
			catch (Exception $e)
			{}
		}
	}


	public function showPage ($follow = null, $position = 'after')
	{
		if ($this->_Condorcet_Vote !== false)
		{
			$vote_view = new Vote_Controller ($this->_Condorcet_Vote);

			parent::showPage($vote_view);
		}
		else
		{
			$error = new Error_Controller(500);
			$error->showPage();
		}
	}

}