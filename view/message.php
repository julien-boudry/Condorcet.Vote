<div class="container">

<?php if ( !empty(Events::showNormalErrors(true)) ) : foreach (Events::getNormalErrors() as $error) : ?>

	<div class="alert alert-danger" role="alert">
		<span class="glyphicon glyphicon-remove ranking_icon pull-left margin-icon"></span>
		<?php echo $error->_private_details ; ?>
	</div>

<?php endforeach; ?>

<?php else : foreach (Events::showMessages('Success', true) as $success) : ?>


	<div class="alert alert-success" role="alert">
		<span class="glyphicon glyphicon-ok ranking_icon pull-left margin-icon"></span>
		<?php echo $success->_public_details ; ?>
	</div>

<?php endforeach; ?>

<?php foreach (Events::showMessages('Infos', true) as $info) : ?>

	<div class="alert alert-info" role="alert">
		<span class="glyphicon glyphicon-ok ranking_icon pull-left margin-icon"></span>
		<?php echo $info->_public_details ; ?>
	</div>

<?php endforeach; endif; ?>

</div>