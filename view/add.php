<div class="container">

<section class="breadcrumb">
	<header>
		<h2 class="text-center">Voting</h2>
	</header>

	<form name="add_vote" method="post">
	<section>
		<header class="page-header">
			<h3>Your Name</h3>
		</header>

	</section>


	<section>
		<header class="page-header">
			<h3>Your Vote</h3>
		</header>
		<div class="row">
				<div class="col-lg-6 col-md-6 .col-sm-8 col-xs-6 center-block input-group">
					<input type="text" name="add_vote_content" class="form-control" required placeholder="A>B>C=D=E>Z" autocomplete="off" pattern="[^<:;,/\/|\\/]">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button">Go!</button>
					</span>
				</div><!-- /input-group -->
		</div><!-- /.row -->
	</section>

	<hr>
	<button class="btn btn-info center-block" type="submit">Add you vote</button>

	</form>

</section>

</div> <!-- /container -->

<hr>