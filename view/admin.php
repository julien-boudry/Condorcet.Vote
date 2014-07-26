<div class="container">

	<div id="vote_url_box">
		<div class="alert alert-success text-center" role="alert">
			<span class="glyphicon glyphicon-globe pull-left ranking_icon"></span>
			This vote is publicly accessible by this link:
			<a href="<?php echo $this->_Condorcet_Vote->getPublicURL() ; ?>" class="alert-link"><?php echo $this->_Condorcet_Vote->getPublicURL() ; ?></a>
		</div>
		<div class="alert alert-danger text-center" role="alert">
			<span class="glyphicon glyphicon-eye-close pull-left ranking_icon"></span>
			You can admin this vote by this link :
			<a href="<?php echo $this->_Condorcet_Vote->getAdminURL() ; ?>" class="alert-link"><?php echo $this->_Condorcet_Vote->getAdminURL() ; ?></a>
			(not share it !)
		</div>
	</div>

	<section class="breadcrumb">
		<header>
			<h2 class="text-center"><?php echo $this->_Condorcet_Vote->getTitle(); ?> <small>Editor</small></h2>
		</header>

		<form name="edit_vote" action="<?php echo $this->_Condorcet_Vote->getAdminURL() ; ?>" method="post">
			<input type="hidden" name="is_edit" value="true">
			<section>
				<header class="page-header">
					<h3>Add Votes</h3>
				</header>
				<textarea name="add_votes" class="form-control" rows="3"></textarea>
			</section>

			<section>
				<header class="page-header">
					<h3>Delete Votes by tags</h3>
				</header>
				<input type="text" name="delete_votes" class="form-control"
				placeholder="Julian;Mike;Christelle # All votes with one of this three tags will be deleting (before adding your new votes)">
			</section>

			<section>
				<header class="page-header">
					<h3>Condorcet Methods</h3>
				</header>
					<div class="row center-block">
						<?php 
						$allow_methods = unserialize($this->_Condorcet_Vote->_bean->methods);

						$i=1;
						foreach(unserialize(CONDORCET_METHOD) as $title => $method) : ?>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="btn-group">
								<span class="input-group-addon">
									<input type="checkbox" name="edit_methods[]" value="<?php echo $method; ?>"
			<?php echo (in_array($method, $allow_methods, true)) ? 'checked' : '' ; ?>
									>
								</span>
								<span class="input-group-addon alert-danger">
									<?php echo $title; ?>
								</span>
							</div><!-- /input-group -->
						</div>
						<?php endforeach; ?>
					</div><!-- /.row -->
			</section>

			<section>
				<header class="page-header">
					<h3><small>(Optionnal)</small> Description</h3>
				</header>
				<textarea name="edit_description" class="form-control" rows="2"
				maxlength=<?php echo CONFIG_DESCRIPTION_LENGHT ; ?>
				><?php echo htmlspecialchars($this->_Condorcet_Vote->getDescription()) ; ?></textarea>
			</section>

			<section>
				<header class="page-header">
					<h3>Public voting
						<small class="pull-right">Disallow any method of public voting
							<input type="checkbox" name="close"
							<?php echo (!$this->_Condorcet_Vote->_bean->open) ? 'checked' : '' ; ?>
							>
						</small>
					</h3>
				</header>
				<section id="external_voting">
					<div class="alert alert-info text-center" role="alert">
						<?php $freeVoteUrl = $this->_Condorcet_Vote->getFreeVoteUrl() ; ?>
						<span class="glyphicon glyphicon-envelope pull-left ranking_icon"></span>
						This URL can be use by anyone to vote... if you share it :
						<a href="<?php echo $freeVoteUrl; ?>" class="alert-link"><?php echo $freeVoteUrl ; ?></a>
					</div>

					<div class="alert alert-warning text-center" role="alert">
						<span class="glyphicon glyphicon-list-alt pull-left ranking_icon"></span>
					<button type="button" class="btn btn-warning"  data-toggle="modal" data-target="#edit_personnal">Set personnal & unique access</button>
					</div>
				</section>
			</section>

			<button class="btn btn-info center-block" type="submit">Edit Vote!</button>
		</form>
	</section>

<section class="modal fade" id="edit_personnal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<header class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title" id="myModalLabel">Modal title</h4>
		</header>
		<div class="modal-body">

			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->_Condorcet_Vote->getPersonnalVoteBaseUrl(); ?></span>

				<input type="text" id="edit_personnal_identifiant" class="form-control"
				placeholder="name or identifiant (alphabetic, without space)" maxlength="25" size="25" 
				pattern="[a-zA-Z]+"
				required autocomplete="off"
				data-admin_code="<?php echo $this->_Condorcet_Vote->getAdminCode(); ?>"
				data-hash_code="<?php echo $this->_Condorcet_Vote->getHashCode(); ?>"
				data-base_url="<?php echo $this->_Condorcet_Vote->getPersonnalVoteBaseUrl() ; ?>"
				>

				<span id="edit_personnal_code" class="input-group-addon">/***</span>
			</div>
			<button id="keynote_add_button" type="button" class="btn btn-default center-block" style="margin-top:2%;" disabled>Add to keynote</button>

			<hr>

			<textarea id="personnal_keynote" rows="10" class="center-block" readonly></textarea>
			</div>

		<div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		</div>
	</div>
	</div>
</section>


</div> <!-- /container -->

<hr>