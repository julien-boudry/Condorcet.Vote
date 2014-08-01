<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
	<section class="container">
		<h1>Condorcet Vote : Starting</h1>
		<p>Condorcet Vote is a simple solution, allowing you to create online unlimited elections whose results are calculated according to various Condorcet voting system like Schulze or Copeland. You can also use primitive method of the <em>Marquis de Condorcet</em> himself.</p>
		<p>These mathematical methods of election for a single turn, allows obtaining a ranking orderly and democratic than majority vote.</p>

		<button class="btn btn-primary btn-lg center-block" data-toggle="modal" data-target="#new_vote">
			Create a new Vote now!
		</button>
	</section>
</div>

<div class="container">

	<section class="home-section" style="margin-top:0px;">
		<header class="text-center">
			<img src="<?php echo BASE_URL . 'view/IMG/condorcet-black.png'; ?>" alt="condorcet black">
			<h2>What is Condorcet Method ?</h2>
		</header>
		<p>Marie Jean Antoine Nicolas de Caritat, Marquis de Condorcet, who died March 29, 1794. Was a philosopher, mathematician, and French politician, representative of the Enlightenment.</p>

		<p>From 1785 onwards, and in several publications, he developed a political, judicial and mathematics for the design of electoral system fairer and consensual. Now called "Condorcet method".</p>

		<p>To start a vote of Condorcet, each voter must ranks the candidates in order of preference, admit cases of equalities. A candidate win the election when voters prefer it to each other candidate, when compared to them one at a time. We can found this winner by conducting a series of pairwise comparisons.<br>
		His method allows to find a winner and a loser among all candidates involved.</p>

		<aside class="text-right"><em><a href="http://en.wikipedia.org/wiki/Condorcet_method" target="_blank">Learn more on Wikipedia &rarr;</a></em></aside>
	</section>
	<hr class="clearfix">

	<section class="home-section">
		<header class="text-center">
			<span class="fa fa-cogs home-icon"></span>
			<h2>What are the advanced methods of Condorcet ?</h2>
		</header>
		<p>They are modern mathematical algorithms, sometimes heavy, to extend and complement the original methods of the Marquis de Condorcet, without ever results do contradict.</p>

		<p>Specifically, these methods can overcome shortages such as the <a href="https://en.wikipedia.org/wiki/Voting_paradox" target="_blank">Condorcet paradox</a>. A special case where no winner or loser can not normally be determined.
		These methods are also used to represent a complete ranking of the election.</p>

		<p>Each has its biases, its advantages and disadvantages, and may require more computing power or less. Meet certain anti-manipulation advanced criteria like "independence of clone", "Smith criterion" or "local independence".</p>

		<p>The most advanced and experienced of them are Schulze, Ranking-Pair or Kemeny-Young methods.</p>

		<b>Complete list of supported method by Condorcet-Vote.org :</b>
		<br><br>
		<?php require 'view/Parts/methods_list.php' ; ?>
		<br><br>		
			<button class="btn btn-success btn-lg center-block">
				<a href="<?php echo BASE_URL.'Condorcet_Methods' ; ?>">
				Learn more about methods &rarr;
				</a>
			</button>
		
	</section>
	<hr class="clearfix">

	<section class="home-section" id="home-how">
		<header class="text-center">
			<span class="fa fa-graduation-cap home-icon"></span>
			<h2>How to create and administer a vote ?</h2>
		</header>

		<h3 style="margin-top:5%;">Introduction</h3>

			<p>Condorcet-Vote is a simple and powerful tools allowing you to either create tests results quite private and unlimited. But also open to the public consultation results, allow the person to vote identified itself or the full public opening.

			The voting list is editable from the creation or after creation, in addition and deletion.

			It is also possible to choose the results of advanced display methods, and associate each vote one or more tags (useful for associating a vote and a person).</p>
		<br><br>
			<button class="btn btn-success btn-lg center-block">
				<a href="<?php echo BASE_URL.'Manual' ; ?>">
				Go to manual &rarr;
				</a>
			</button>
	</section>

</div> <!-- /container -->