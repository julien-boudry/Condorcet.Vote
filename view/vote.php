<section class="container">

	<header>
		<h1 class="text-center"><?php echo $this->_Condorcet_Vote->getTitle(); ?> <small>Vote</small></h1>
		<p>
			<?php echo $this->_Condorcet_Vote->getComment(); ?>
		</p>
	</header>

	<section>
		<header class="page-header">
			<h2>Informations & Votes</h2>
		</header>

		<ul class="nav nav-tabs" role="tablist">
		  <li class="active"><a href="#vote_global_info" role="tab" data-toggle="tab">Global Informations</a></li>
		  <li><a href="#vote_candidates" role="tab" data-toggle="tab"><span class="badge"><?php echo $this->_objectCondorcet->countCandidates() ; ?></span> Candidates</a></li>
		  <li><a href="#vote_votes" role="tab" data-toggle="tab"><span class="badge"><?php echo $this->_objectCondorcet->countVotes() ; ?></span> Votes</a></li>
		</ul>

		<div class="tab-content" style="padding-top:2%;">
			<div class="tab-pane fade in active" id="vote_global_info">
				<ul>
					<li>
						<em>Compute by
							<a href="https://github.com/julien-boudry/Condorcet" target="_blank">Condorcet Class</a>
							<span class="label label-info"><?php echo $this->_objectCondorcet->getObjectVersion(); ?></span>
						</em>
					</li>
					<li>
						<strong>Create on:</strong>
						<?php echo $this->_Condorcet_Vote->getDate(); ?>
					</li>
					<li>
						<strong>Number of update:</strong>
						<?php echo $this->_Condorcet_Vote->getCountUpdate(); ?>
					</li>
					<?php if ($this->_Condorcet_Vote->getCountUpdate() > 0) : ?>
					<li>
						<strong>Create on:</strong>
						<?php echo $this->_Condorcet_Vote->getUpdateDate(); ?>
					</li>
					<?php endif; ?>
					<li>
						<strong>Computing time:</strong>
						<?php echo number_format($this->_objectCondorcet->getGlobalTimer(true),2); ?> second(s)
					</li>
				</ul>
			</div>
			<section class="tab-pane fade in" id="vote_candidates">
				<ul>
					<?php
						foreach ($this->_objectCondorcet->getCandidatesList() as $candidate)
						{
							echo '<li>'.$candidate.'</li>';
						}
					?>
				</ul>
			</section>
			<section class="tab-pane fade in" id="vote_votes">
				<?php foreach ($this->_objectCondorcet->getVotesList() as $voteid => $vote) : ?>
				<div class="panel-group" id="votes_accordion">
					<div class="panel panel-warning">
						<header class="panel-heading" data-toggle="collapse" data-parent="#votes_accordion" data-target="#<?php echo $vote['tag'][0] ; ?>_voteid" style="cursor:pointer;">
							<h4 class="panel-title">
								<span class="glyphicon glyphicon-indent-left margin-icon"></span>
								Vote N° <?php echo $vote['tag'][0] ; ?>
								<small>

								</small>
								<span class="caret pull-right"></span>
							</h4>
						</header>
						<div id="<?php echo $vote['tag'][0] ; ?>_voteid" class="panel-collapse collapse">
							<div class="panel-body">
								<?php echo $vote['tag']; ?>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
			</section>
		</div>
	</section>

	<section>
		<header class="page-header">
			<h2>Natural Condorcet Winner & Loser</h2>
		</header>
			<div class="alert alert-success" role="alert">
				<?php if(!is_null($this->_objectCondorcet->getWinner())) : ?>
					<span class="fa fa-trophy ranking_icon margin-icon"></span>
					<strong>Natural Condorcet Winner:</strong>
					<?php echo $this->_objectCondorcet->getWinner(); ?>
				<?php else: ?>
					<span class="glyphicon glyphicon-ban-circle ranking_icon margin-icon"></span>
					<strong>No natural Condorcet Winner found</strong>
				<?php endif; ?>
			</div>
			<div class="alert alert-danger" role="alert">
				<?php if(!is_null($this->_objectCondorcet->getLoser())) : ?>
					<span class="fa fa-hand-o-down ranking_icon margin-icon"></span>
					<strong>Natural Condorcet Loser:</strong>
					<?php echo $this->_objectCondorcet->getLoser(); ?>
				<?php else: ?>
					<span class="glyphicon glyphicon-ban-circle ranking_icon margin-icon"></span>
					<strong>No natural Condorcet Loser found</strong>
				<?php endif; ?>
			</div>

		<section class="panel-group" id="pairewise_accordion">
			<div class="panel panel-primary">
				<header class="panel-heading" data-toggle="collapse" data-parent="#pairewise_accordion" data-target="#the_pairwise" style="cursor:pointer;">
					<h4 class="panel-title">
						<span class="glyphicon glyphicon-indent-left margin-icon"></span> Look PairWise
						<span class="caret pull-right"></span>
					</h4>
				</header>
				<div id="the_pairwise" class="panel-collapse collapse">
					<div class="panel-body">
						<pre><?php
							print_r($this->_objectCondorcet->getPairwise());
						?></pre>
					</div>
				</div>
			</div>
		</section>
	</section>

	<section>
		<header class="page-header">
			<h2>Advanced Results</h2>
		</header>

		<div class="panel-group" id="results_accordion">
		  <?php
		  foreach (unserialize(CONDORCET_METHOD) as $title => $method) : ?>
			<section class="panel panel-info">
			    <header class="panel-heading" data-toggle="collapse" data-parent="#results_accordion" data-target="#<?php echo $method ; ?>" style="cursor:pointer;">
			      <h3 class="panel-title">
			      		<span class="glyphicon glyphicon-th-list margin-icon"></span>
						<?php echo $title ; ?>
			      		<span class="caret pull-right"></span>
			      </h3>
			    </header>
			    <div id="<?php echo $method ; ?>" class="panel-collapse collapse">
					<div class="panel-body">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
						  <li class="active"><a href="#<?php echo $method ; ?>_ranking" role="tab" data-toggle="tab">Ranking</a></li>
						  <li><a href="#<?php echo $method ; ?>_details" role="tab" data-toggle="tab">Details</a></li>
						</ul>

						<!-- Tab panes -->
						<div class="tab-content">
							<div class="tab-pane fade in active" id="<?php echo $method ; ?>_ranking">
								<ul class="list-group">
									<?php
									foreach ($this->_objectCondorcet->getResult($method) as $rank => $version) : 

										$version = implode(' / ',explode(',', $version));
										?>
										<li class="list-group-item
										<?php
											echo ($version === $this->_objectCondorcet->getWinner()) ? 'list-group-item-success ' : '' ;
											echo ($version === $this->_objectCondorcet->getLoser()) ? 'list-group-item-danger' : '' ;  
										?>">
											<span class="badge">
												<?php echo $rank; ?>
											</span>
											<?php 
												echo $version;
											?>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
							<div class="tab-pane fade in" id="<?php echo $method ; ?>_details">
							</div>
						</div>
					</div>
				</div>
			</section>
		<?php endforeach; ?>
		</div>
	</section>


</section> <!-- /container -->
