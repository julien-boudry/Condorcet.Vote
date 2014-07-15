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
		// Edit Controller est appelé directement (pas d'API)
		elseif (is_null($condorcet_vote) && isset($_GET['vote']) && isset($_GET['admin_code']))
		{
			$this->_Condorcet_Vote = new Condorcet_Vote($_GET['vote']);

			if ($this->_Condorcet_Vote->_bean->admin_code !== $_GET['admin_code'])
			{
				$this->_Condorcet_Vote = false ;
			}
		}
	}

		//////

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