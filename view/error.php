<div class="container">


<?php foreach (Events::getFatalErrors() as $error) : ?>

	<h1 class="text-center">Error : <?php echo $error->_name ; ?></h1>

	<div class="center-block">
		<small><?php echo $error->_public_details ; ?></small>
	</div>

<?php endforeach; ?>

</div> <!-- /container -->
