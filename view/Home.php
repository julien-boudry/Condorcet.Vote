<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
    <section class="container">
        <h1>Condorcet Vote : Starting</h1>
        <p>Condorcet Vote is a simple solution, allowing you to create unlimited online elections whose results are calculated according to various Condorcet voting systems like Schulze or Copeland. You can also use the primitive method of the <em>Marquis de Condorcet</em> himself.</p>
        <p>These mathematical methods of election, designed for a single round, allow obtaining a more orderly and democratic ranking than majority voting.</p>

        <button class="btn btn-primary btn-lg center-block" data-toggle="modal" data-target="#new_vote">
            Create a new Vote now!
        </button>
    </section>
</div>

<div class="container">

    <section class="home-section" style="margin-top:0px;">
        <header class="text-center">
            <img src="<?php echo BASE_URL . 'assets/IMG/condorcet-black.png'; ?>" alt="condorcet black">
            <h2>What is the Condorcet Method?</h2>
        </header>
        <p>Marie Jean Antoine Nicolas de Caritat, Marquis de Condorcet, who died March 29, 1794, was a philosopher, mathematician, and French politician, representative of the Enlightenment.</p>

        <p>From 1785 onwards, in several publications, he developed political, judicial, and mathematical frameworks for the design of fairer and more consensual electoral systems, now called the "Condorcet method".</p>

        <p>In a Condorcet vote, each voter must rank the candidates in order of preference, admitting cases of equality. A candidate wins the election when voters prefer them to every other candidate, when compared one at a time. We can find this winner by conducting a series of pairwise comparisons.<br>
        His method makes it possible to find a winner and a loser among all candidates involved.</p>

        <aside class="text-right"><em><a href="http://en.wikipedia.org/wiki/Condorcet_method" target="_blank">Learn more on Wikipedia &rarr;</a></em></aside>
    </section>
    <hr class="clearfix">

    <section class="home-section">
        <header class="text-center">
            <span class="fa fa-cogs home-icon"></span>
            <h2>What are the advanced Condorcet methods?</h2>
        </header>
        <p>They are modern mathematical algorithms, sometimes computationally heavy, that extend and complement the original methods of the Marquis de Condorcet, without ever contradicting the results.</p>

        <p>Specifically, these methods can overcome shortcomings such as the <a href="https://en.wikipedia.org/wiki/Voting_paradox" target="_blank">Condorcet paradox</a>, a special case where no winner or loser can normally be determined.
        These methods are also used to represent a complete ranking of the election.</p>

        <p>Each has its biases, its advantages and disadvantages, and may require more or less computing power. They meet certain advanced anti-manipulation criteria like "independence of clones", "Smith criterion", or "local independence".</p>

        <p>The most advanced and well-established of them are the Schulze, Ranked Pairs, and Kemeny-Young methods.</p>

        <b>Complete list of supported methods on Condorcet-Vote.org:</b>
        <br><br>
        <?php require '../view/Parts/methods_list.php'; ?>
        <br><br>
        <span class="home-button-wrapper"><a href="<?php echo BASE_URL.'Condorcet_Methods'; ?>">
            <button class="btn btn-success btn-lg center-block">
                Learn more about methods &rarr;
            </button>
        </a></span>

    </section>
    <hr class="clearfix">

    <section class="home-section" id="home-how">
        <header class="text-center">
            <span class="fa fa-graduation-cap home-icon"></span>
            <h2>How to create and administer a vote ?</h2>
        </header>

        <h3 style="margin-top:5%;">Introduction</h3>

            <p>Condorcet-Vote is a simple and powerful tool allowing you to create private and unlimited election results. You can also open the results to public consultation, allow identified persons to vote, or fully open the vote to the public.

            The voting list is editable at creation or afterwards, with the ability to add and delete votes.

            It is also possible to choose which advanced methods to display in the results, and associate one or more tags with each vote (useful for linking a vote to a person).</p>
        <br><br>
        <span class="home-button-wrapper"><a href="<?php echo BASE_URL.'Manual'; ?>">
            <button class="btn btn-success btn-lg center-block">
                Go to manual &rarr;
            </button>
        </a></span>
    </section>

</div> <!-- /container -->