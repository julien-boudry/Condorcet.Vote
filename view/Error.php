<div class="container" style="margin-top:10%;">

<?php foreach (Events::getFatalErrors() as $error) { ?>

    <h1 class="text-center">Error : <?php echo $error->_name; ?></h1>

        <h2 class="text-center">
            <small><?php echo $error->_public_details; ?></small>
        </h2>

<?php } ?>

</div> <!-- /container -->