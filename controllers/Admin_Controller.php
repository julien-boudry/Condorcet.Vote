<?php

class Admin_Controller extends Controller
{
	protected $_view = 'Admin' ;

	const ERROR_URL = 'This vote or this admin code do not exist.' ;

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

				Events::add( new Error (404, null, null, self::ERROR_URL) );

				$this->_Condorcet_Vote = false ;

				return false ;
			}

			// Controle de la validité du code
			if ($this->_Condorcet_Vote->_bean->admin_code !== $_GET['admin_code'])
			{
				Events::add( new Error (404, null, null, self::ERROR_URL) );

				$this->_Condorcet_Vote = false ;

				return false ;
			}

			// Demande d'édition ?
			if	(
					isset($_POST['is_edit']) &&
					isset($_POST['edit_description']) &&
					isset($_POST['delete_type'])
				)
			{
				$this->update_vote();
			}
		}
	}


	protected function update_vote ()
	{
		// Update (ou non) de la description (l'affichage de l'erreur est exclusivement géré en front)
		if	(
				$_POST['edit_description'] !== $this->_Condorcet_Vote->_bean->description
				&&
				strlen($_POST['edit_description']) <= CONFIG_DESCRIPTION_LENGHT
			)
		{
			$this->_Condorcet_Vote->_bean->description = $_POST['edit_description'] ;
		}

		// Update (ou non) de la des methodes (l'affichage de l'erreur est exclusivement géré en front)
		$this->_Condorcet_Vote->update_methods(
			( empty($_POST['edit_methods']) ) ? array() : $_POST['edit_methods']
		);

		// Open or close
		$this->_Condorcet_Vote->setOpen( (isset($_POST['close'])) ? false : true );

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

				$delete_mode = ($_POST['delete_type'] === 'without') ? false : true ;
				
				$counter_remove = $this->_Condorcet_Vote->_objectCondorcet->removeVote($delete_votes, $delete_mode);

				Events::add( new Success ($counter_remove . ' deleted votes') );

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
			catch (Condorcet\CondorcetException $e)
			{
				Events::add( new Error (502, null, null, $e->getMessage(), 2, 0) );
			}
		}
	}


	protected function getTitle ()
	{
		return 'Admin Vote: ' . $this->_Condorcet_Vote->getTitle() ;
	}


	public function showPage ($follow = null, $position = 'after')
	{
		if ($this->_Condorcet_Vote !== false)
		{
			parent::AddJS(BASE_URL.'view/JS/sha224.js', 3);
			parent::AddJS(BASE_URL.'view/JS/php.js');
			parent::showPage(new Vote_Controller ($this->_Condorcet_Vote));
		}
		else
		{
			parent::showPage();
		}
	}

}