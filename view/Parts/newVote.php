<div class="modal fade" id="new_vote" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h2 class="modal-title" id="myModalLabel">Create a new Vote</h2>
			</div>
			<form name="new_vote" action="<?php echo BASE_URL . 'Create/'; ?>" method="post">
			<div class="modal-body">
					<section>
							<header class="page-header" style="margin-top:1%;">
									<h3>Add Candidates</h3>
							</header>
							<input type="text" name="candidates" spellcheck="false" required class="form-control" pattern="<?php echo REGEX_NEW_ADD_CANDIDATE; ?>"
							placeholder="Richard Wagner ; Gustav Mahler ; Claude Debussy ; Charles Koechlin" 
							>
							<?php setHelper('enter_candidates'); ?>
					</section>

					<section>
							<header class="page-header">
									<h3>Add Vote(s)
										<small class="pull-right tooltips" data-toggle="tooltip" data-placement="right"
											title="If checked, your users can not vote anonymously or use their personal invitation."
										>
											Disallow any method of public voting
											<input type="checkbox" name="close">
										</small>
									</h3>
							</header>
							<textarea name="votes" class="form-control vote-parser" rows="3" spellcheck="false"
							placeholder="Claude Debussy > Richard Wagner = Gustav Mahler > Charles Koechlin" 
							></textarea>
							<?php setHelper('enter_votes'); ?>
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
							<?php setHelper('methods_infos', 'warning'); ?>
					</section>

					<section>
							<header class="page-header">
									<h3><small>(Optional)</small> Description</h3>
							</header>
							<textarea spellcheck="true" name="description" class="form-control" rows="2"
							maxlength=<?php echo CONFIG_DESCRIPTION_LENGHT ; ?>
							></textarea>
					</section>

			</div>
			<div class="modal-footer">
				<div class="input-group col-xs-12 col-sm-8 col-md-7 col-lg-6 pull-right">
						<input name="title" type="text" class="form-control" placeholder="Vote Title" required spellcheck="true" pattern="<?php echo REGEX_TITLE ; ?>">
						<span class="input-group-btn">
								<button class="btn btn-success" type="submit">Create Vote!</button>
						</span>
				</div>
			</div>
			</form>			
		</div>
	</div>
</div>
