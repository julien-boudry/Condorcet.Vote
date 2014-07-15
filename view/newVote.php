<div class="modal fade" id="new_vote" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h2 class="modal-title" id="myModalLabel">Create a new Vote</h2>
			</div>
			<div class="modal-body">
				<form name="new_vote" action="?route=Create" method="post">
					<section>
							<header class="page-header" style="margin-top:1%;">
									<h3>Add Candidates</h3>
							</header>
							<textarea name="candidates" required class="form-control" rows="1" placeholder="Candidate 1"></textarea>
					</section>

					<section>
							<div class="page-header">
									<h3>Add Votes</h3>
							</div>
							<textarea name="votes" class="form-control" rows="3" required></textarea>
					</section>

					<section>
							<header class="page-header">
									<h3>Condorcet Methods</h3>
							</header>
								<div class="row center-block">
									<?php $i=1;
									foreach(unserialize(CONDORCET_METHOD) as $title => $method) : ?>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="btn-group">
											<span class="input-group-addon">
												<input type="checkbox" name="methods[]" value="<?php echo $method; ?>" checked>
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
							<textarea name="comment" class="form-control" rows="2"></textarea>
					</section>

			</div>
			<div class="modal-footer">
				<div class="input-group col-xs-12 col-sm-8 col-md-7 col-lg-6 pull-right">
						<input name="title" type="text" class="form-control" placeholder="Vote Title" required>
						<span class="input-group-btn">
								<button class="btn btn-success" type="submit">Create Vote!</button>
						</span>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
