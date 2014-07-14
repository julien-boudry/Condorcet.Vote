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
						<a href="https://github.com/julien-boudry/Condorcet" target="_blank">Condorcet Class <span class="label label-info"><?php echo $this->_objectCondorcet->getObjectVersion(); ?></span></a>
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
			</ul>
		  </div>
		  <div class="tab-pane fade in" id="vote_candidates">
		  	<ul>
		  		<?php
		  			foreach ($this->_objectCondorcet->getCandidatesList() as $candidate)
		  			{
		  				echo '<li>'.$candidate.'</li>';
		  			}
		  		?>
		  	</ul>
		  </div>
		  <div class="tab-pane fade in" id="vote_votes">3</div>
		</div>
	</section>

	<section>
		<header class="page-header">
			<h2>Results</h2>
		</header>

	<div class="panel-group" id="accordion">
	  <?php
	  foreach ($this->_objectCondorcet->getAuthMethods() as $title => $method) : ?>
		<div class="panel panel-default">
		    <header class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#<?php echo $method ; ?>" style="cursor:pointer;">
		      <h3 class="panel-title">
		          <?php echo $title ; ?>
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
								foreach ($this->_objectCondorcet->getResult($method) as $rank => $version) : ?>
									<li class="list-group-item">
										<span class="badge"><?php echo $rank; ?></span>
										<?php echo $version; ?>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
						<div class="tab-pane fade in" id="<?php echo $method ; ?>_details">
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
	</div>
	</section>


</section> <!-- /container -->
