<div class="container">

<div id="public_url_alert" class="alert alert-success text-center" role="alert">
	This vote is publicly accessible by this link:
	<a href="<?php echo $this->_Condorcet_Vote->getPublicURL() ; ?>" class="alert-link"><?php echo $this->_Condorcet_Vote->getPublicURL() ; ?></a>
</div>
<div class="alert alert-danger text-center" role="alert">
	You can admin this vote by this link :
	<a href="<?php echo $this->_Condorcet_Vote->getAdminURL() ; ?>" class="alert-link"><?php echo $this->_Condorcet_Vote->getAdminURL() ; ?></a>
	(not share it !)
</div>

	<section class="breadcrumb">
		<header>
			<h2 class="text-center"><?php echo $this->_Condorcet_Vote->getTitle(); ?> <small>Editor</small></h2>
		</header>

		<form name="edit_vote" action="" method="post">
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
				<input type="text" name="votes_delete" class="form-control"></textarea>
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
									<input type="checkbox" name="methods[]" value="<?php echo $method; ?>"
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
				<textarea name="edit_description" class="form-control" rows="2"><?php echo $this->_Condorcet_Vote->getDescription() ; ?>				</textarea>
			</section>

			<button class="btn btn-success" type="submit">Create Vote!</button>
		</form>
	</section>

</div> <!-- /container -->

<hr>
