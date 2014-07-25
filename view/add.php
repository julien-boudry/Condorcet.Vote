<div class="container">

<?php if ($this->_etat === false) : ?>
<div class="alert alert-danger" role="danger">
	<span class="glyphicon glyphicon-remove ranking_icon pull-left margin-icon"></span>
	Error
</div>
<?php elseif ($this->_etat === 'double') : ?>
<div class="alert alert-danger" role="danger">
	<span class="glyphicon glyphicon-remove ranking_icon pull-left margin-icon"></span>
	Vous avez déjà voté
</div>
<?php endif; ?>

<?php if ($this->_etat === true) : ?>
<div class="alert alert-success" role="success">
	<span class="glyphicon glyphicon-ok ranking_icon pull-left margin-icon"></span>
	Your vote has been succefull register
</div>
<?php elseif (is_null($this->_etat) || $this->_etat === false) : ?>
<section class="breadcrumb">
	<header>
		<h2 class="text-center">Voting</h2>
	</header>

	<form name="add_vote" method="post">
	<section>
		<header class="page-header">
			<h3>Your Identifiant <small>(Optionnal)</small></h3>
		</header>
		<?php if ($this->_mode === 'Personnal') : ?>
		<div class="text-center">
			<strong style="font-weight:150%;"><?php echo htmlspecialchars($_GET['personnal_name']) ; ?></strong>
		</div>
	<?php elseif ($this->_mode === 'Public') : ?>
		<input type="text" name="add_name" pattern="[a-zA-Z]+" maxlength="20" class="center-block">
	<?php endif; ?>
	</section>


	<section>
		<header class="page-header">
			<h3>Your Vote</h3>
		</header>
		<div class="row">
				<div class="col-lg-6 col-md-6 .col-sm-8 col-xs-6 center-block input-group">
					<input type="text" name="add_vote_content" class="form-control" required placeholder="A>B>C=D=E>Z" autocomplete="off" pattern="[a-zA-Z0-9>= ]+">
				</div><!-- /input-group -->
		</div><!-- /.row -->
	</section>

	<hr>
	<button class="btn btn-info center-block" type="submit">Add you vote</button>

	</form>

</section>
<?php endif; ?>

</div> <!-- /container -->

<hr>