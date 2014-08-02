<div class="container">

	<section class="page-section">
		<header>
			<span class="fa fa-cogs home-icon page-icon"></span>
			<h1>A look around the various methods of Condorcet</h1>
		</header>

		<h2>Introduction</h2>
		
		<p>These methods are modern mathematical algorithms, sometimes heavy, to extend and complement the original methods of the Marquis de Condorcet, without ever results do contradict.</p>

		<p>Specifically, these methods can overcome shortages such as the <a href="https://en.wikipedia.org/wiki/Voting_paradox" target="_blank">Condorcet paradox</a>. A special case where no winner or loser can not normally be determined.
		These methods are also used to represent a complete ranking of the election.</p>

		<p>Each has its biases, its advantages and disadvantages, and may require more computing power or less. Meet certain anti-manipulation advanced criteria like "independence of clone", "Smith criterion" or "local independence".</p>
		
		<p><strong>If you do not have specific needs, we recommend the use of Schulze Winning method.</strong></p>

		<h2>Specifications</h2>

		<p class="text-center">Above all, a small table summarizing the characteristics of the main methods of advanced votes, that they meet or fail the Condorcet criterions.</p><br>

		<table class="wikitable" style="text-align:center">
			<tr>
				<td style="width:8%;"></td>
				<td style="width:3%;"><a target="_blank" href="http://en.wikipedia.org/wiki/Monotonicity_criterion" title="Monotonicity criterion">Monotonic</a></td>
				<td style="width:3%;"><a target="_blank" href="http://en.wikipedia.org/wiki/Condorcet_criterion" title="Condorcet criterion">Condorcet</a></td>
				<td style="width:3%;"><a target="_blank" href="http://en.wikipedia.org/wiki/Majority_criterion" title="Majority criterion">Majority</a></td>
				<td style="width:3%;"><a target="_blank" href="http://en.wikipedia.org/wiki/Condorcet_loser_criterion" title="Condorcet loser criterion">Condorcet loser</a></td>
				<td style="width:3%;"><a target="_blank" href="http://en.wikipedia.org/wiki/Majority_loser_criterion" title="Majority loser criterion">Majority loser</a></td>
				<td style="width:3%;"><a target="_blank" href="http://en.wikipedia.org/wiki/Mutual_majority_criterion" title="Mutual majority criterion">Mutual majority</a></td>
				<td style="width:3%;"><a target="_blank" href="http://en.wikipedia.org/wiki/Smith_criterion" title="Smith criterion">Smith</a></td>
				<td style="width:3%;"><a target="_blank" href="http://en.wikipedia.org/wiki/Independence_of_Smith-dominated_alternatives" title="Independence of Smith-dominated alternatives">ISDA</a></td>
				<td style="width:3%;"><a target="_blank" href="http://en.wikipedia.org/wiki/Independence_of_irrelevant_alternatives#Local_independence" title="Independence of irrelevant alternatives">LIIA</a></td>
				<td style="width:3%;"><a target="_blank" href="http://en.wikipedia.org/wiki/Independence_of_clones_criterion" title="Independence of clones criterion">Clone independence</a></td>
				<td style="width:3%;"><a target="_blank" href="http://en.wikipedia.org/wiki/Reversal_symmetry" title="Reversal symmetry">Reversal symmetry</a></td>
				<td style="width:3%;"><a target="_blank" href="http://en.wikipedia.org/wiki/Polynomial_time" title="Polynomial time" class="mw-redirect">Polynomial time</a></td>
				<td style="width:3%;"><a target="_blank" href="http://en.wikipedia.org/wiki/Participation_criterion" title="Participation criterion">Participation</a>, <a target="_blank" href="http://en.wikipedia.org/wiki/Consistency_criterion" title="Consistency criterion">Consistency</a></td>
				<td style="width:3%;"><a target="_blank" href="http://en.wikipedia.org/wiki/Resolvability_criterion" title="Resolvability criterion">Resolvability</a></td>
			</tr>
			<tr>
				<th>Schulze</th>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
			</tr>
			<tr>
				<th><a target="_blank" href="http://en.wikipedia.org/wiki/Ranked_Pairs" title="Ranked Pairs" class="mw-redirect">Ranked Pairs</a></th>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
			</tr>
			<tr>
				<th><a target="_blank" href="http://en.wikipedia.org/wiki/Copeland%27s_method" title="Copeland's method">Copeland</a></th>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
			</tr>
			<tr>
				<th><a target="_blank" href="http://en.wikipedia.org/wiki/Kemeny%E2%80%93Young_method" title="Kemeny–Young method">Kemeny-Young</a></th>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
			</tr>
			<tr>
				<th><a target="_blank" href="http://en.wikipedia.org/wiki/Nanson%27s_method" title="Nanson's method">Nanson</a></th>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
			</tr>
			<tr>
				<th><a target="_blank" href="http://en.wikipedia.org/wiki/Nanson%27s_method#Baldwin_method" title="Nanson's method">Baldwin</a></th>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
			</tr>
			<tr>
				<th><a target="_blank" href="http://en.wikipedia.org/wiki/Instant-runoff_voting" title="Instant-runoff voting">Instant-runoff voting</a></th>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
			</tr>
			<tr>
				<th><a target="_blank" href="http://en.wikipedia.org/wiki/Borda_count" title="Borda count">Borda</a></th>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
			</tr>
			<tr>
				<th><a target="_blank" href="http://en.wikipedia.org/wiki/Bucklin_voting" title="Bucklin voting">Bucklin</a></th>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
			</tr>
			<tr>
				<th><a target="_blank" href="http://en.wikipedia.org/wiki/Coombs%27_method" title="Coombs' method">Coombs</a></th>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
			</tr>
			<tr>
				<th><a target="_blank" href="http://en.wikipedia.org/wiki/Minimax_Condorcet" title="Minimax Condorcet">MiniMax</a></th>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
			</tr>
			<tr>
				<th><a target="_blank" href="http://en.wikipedia.org/wiki/Plurality_voting_system" title="Plurality voting system">Plurality</a></th>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
			</tr>
			<tr>
				<th><a target="_blank" href="http://en.wikipedia.org/wiki/Anti-plurality_voting" title="Anti-plurality voting">Anti-plurality</a></th>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
			</tr>
			<tr>
				<th><a target="_blank" href="http://en.wikipedia.org/wiki/Contingent_vote" title="Contingent vote">Contingent voting</a></th>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
			</tr>
			<tr>
				<th><a target="_blank" href="http://en.wikipedia.org/wiki/Sri_Lankan_contingent_vote" title="Sri Lankan contingent vote" class="mw-redirect">Sri Lankan contingent voting</a></th>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
			</tr>
			<tr>
				<th><a target="_blank" href="http://en.wikipedia.org/wiki/Supplementary_vote" title="Supplementary vote" class="mw-redirect">Supplementary voting</a></th>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
			</tr>
			<tr>
				<th><a target="_blank" href="http://en.wikipedia.org/wiki/Dodgson%27s_method" title="Dodgson's method">Dodgson</a></th>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#F99;vertical-align:middle;text-align:center;" class="table-no">No</td>
				<td style="background:#9F9;vertical-align:middle;text-align:center;" class="table-yes">Yes</td>
			</tr>
</table>
<aside class="text-right"><em><a href="https://en.wikipedia.org/wiki/Schulze_method#Comparison_table" target="_blank">Source : Wikipedia EN &rarr;</a></em></aside>

	<h2>Supported method on Condorcet-Vote.org</h2>

	<?php require 'view/Parts/methods_list.php' ; ?>


	<h2>Condorcet Methods Overview</h2>

		<h3>Schulze</h3>

		<h4>Resume</h5>
		<p>If for a pairwise contest X either beats or ties Y, then we say that X has a path to Y, with a strength equal to the number of voters ranking X over Y. <br>
		If X has a path to Y of strength m, and Y has a path to Z of strength n, then we say that X has a path to Z equal to the minimum of m and n. <br>
		Of all the paths from X to Y, a maximum path strength can be found. If the maximum path strength from X to Y is greater than the maximum path strength from Y to X, then Y cannot win. The winner is the candidate that does not lose any such maximum path strength comparisons.</p>

		<h4>Documentation by Martin Schulze himself :</h5>

		<ul><li><a href="http://m-schulze.9mail.de/" target="_blank">http://m-schulze.9mail.de</a></li></ul>

		<h3></h3>
		<h3></h3>
		<h3></h3>
		<h3></h3>
		<h3></h3>
		<h3></h3>
		<h3></h3>
		<h3></h3>
		<h3></h3>


</section>

</div> <!-- /container -->