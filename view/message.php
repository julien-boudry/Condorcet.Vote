<div class="container">

<?php if ( !empty(Events::getNormalErrors()) ) : foreach (Events::getNormalErrors() as $success) : ?>

	<div class="alert alert-danger" role="alert">
		<span class="glyphicon glyphicon-remove ranking_icon pull-left margin-icon"></span>
		<?php echo $success->_private_details ; ?>
	</div>

<?php endforeach; ?>

<?php else : foreach (Events::$_success_list as $success) : ?>


	<div class="alert alert-success" role="alert">
		<span class="glyphicon glyphicon-ok ranking_icon pull-left margin-icon"></span>
		<?php echo $success->_public_details ; ?>
	</div>

<?php endforeach; ?>

<?php foreach (Events::$_infos_list as $info) : ?>

	<div class="alert alert-info" role="alert">
		<span class="glyphicon glyphicon-ok ranking_icon pull-left margin-icon"></span>
		<?php echo $info->_public_details ; ?>
	</div>

<?php endforeach; endif; ?>

</div>