<div class="container">

    <section class="page-section col-md-11">
        <header>
            <span class="fa fa-cogs home-icon page-icon"></span>
            <h1>A look around the various methods of Condorcet</h1>
        </header>

        <span class="anchor" id="introduction"></span>
        <h2>Introduction</h2>

        <p>These methods are modern mathematical algorithms, sometimes computationally heavy, that extend and complement the original methods of the Marquis de Condorcet, without ever contradicting the results.</p>

        <p>Specifically, these methods can overcome shortcomings such as the <a href="https://en.wikipedia.org/wiki/Voting_paradox" target="_blank">Condorcet paradox</a>, a special case where no winner or loser can normally be determined.
        These methods are also used to represent a complete ranking of the election.</p>

        <p>Each has its biases, its advantages and disadvantages, and may require more or less computing power. They meet certain advanced anti-manipulation criteria like "independence of clones", "Smith criterion", or "local independence".</p>

        <p><strong>If you do not have specific needs, we recommend the use of Schulze Winning method.</strong></p>

        <span class="anchor" id="specifications"></span>
        <h2>Specifications</h2>

        <p class="text-center">First, a small table summarizing the characteristics of the main advanced voting methods, and whether they meet or fail the Condorcet criteria.</p><br>

        <table class="wikitable" style="text-align:center">
            <tr>
                <td style="width:10%;"></td>
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
                <td style="width:3%;"><a target="_blank" href="http://en.wikipedia.org/wiki/Plurality_criterion" title="Plurality Criterion">Plurality</a></td>
            </tr>
            <tr>
                <th><a target="_blank" href="http://en.wikipedia.org/wiki/Schulze_method" title="Schulze Winnings" class="mw-redirect">Schulze Winning</a></th>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
            </tr>
            <tr>
                <th><a target="_blank" href="http://en.wikipedia.org/wiki/Schulze_method" title="Schulze Margin" class="mw-redirect">Schulze Margin</a></th>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
            </tr>
            <tr>
                <th><a target="_blank" href="http://en.wikipedia.org/wiki/Ranked_Pairs" title="Ranked Pairs" class="mw-redirect">Ranked Pairs</a></th>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
            </tr>
            <tr>
                <th><a target="_blank" href="http://en.wikipedia.org/wiki/Kemeny%E2%80%93Young_method" title="Kemeny–Young method">Kemeny-Young</a></th>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
            </tr>
            <tr>
                <th><a target="_blank" href="http://en.wikipedia.org/wiki/Copeland%27s_method" title="Copeland's method">Copeland</a></th>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
            </tr>
            <tr>
                <th><a target="_blank" href="http://en.wikipedia.org/wiki/Minimax_Condorcet" title="Minimax Condorcet">MiniMax Winning</a></th>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
            </tr>
            <tr>
                <th><a target="_blank" href="http://en.wikipedia.org/wiki/Minimax_Condorcet" title="Minimax Condorcet">MiniMax Margin</a></th>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
            </tr>
            <tr>
                <th><a target="_blank" href="http://en.wikipedia.org/wiki/Minimax_Condorcet" title="Minimax Condorcet">MiniMax-Opposition</a></th>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
            </tr>
            <tr>
                <th><a target="_blank" href="http://en.wikipedia.org/wiki/Dodgson%27s_method" title="Dodgson's method">Dodgson</a></th>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
            </tr>
            <tr>
                <th><a target="_blank" href="http://en.wikipedia.org/wiki/Nanson%27s_method" title="Nanson's method">Nanson</a></th>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
            </tr>
            <tr>
                <th><a target="_blank" href="http://en.wikipedia.org/wiki/Nanson%27s_method#Baldwin_method" title="Nanson's method">Baldwin</a></th>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
            </tr>
            <tr>
                <th><a target="_blank" href="http://en.wikipedia.org/wiki/Instant-runoff_voting" title="Instant-runoff voting">Instant-runoff voting</a></th>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
            </tr>
            <tr>
                <th><a target="_blank" href="http://en.wikipedia.org/wiki/Borda_count" title="Borda count">Borda</a></th>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
            </tr>
            <tr>
                <th><a target="_blank" href="http://en.wikipedia.org/wiki/Bucklin_voting" title="Bucklin voting">Bucklin</a></th>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
            </tr>
            <tr>
                <th><a target="_blank" href="http://en.wikipedia.org/wiki/Coombs%27_method" title="Coombs' method">Coombs</a></th>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
            </tr>
            <tr>
                <th><a target="_blank" href="http://en.wikipedia.org/wiki/Plurality_voting_system" title="Plurality voting system">Plurality</a></th>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
            </tr>
            <tr>
                <th><a target="_blank" href="http://en.wikipedia.org/wiki/Anti-plurality_voting" title="Anti-plurality voting">Anti-plurality</a></th>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
            </tr>
            <tr>
                <th><a target="_blank" href="http://en.wikipedia.org/wiki/Contingent_vote" title="Contingent vote">Contingent voting</a></th>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
            </tr>
            <tr>
                <th><a target="_blank" href="http://en.wikipedia.org/wiki/Sri_Lankan_contingent_vote" title="Sri Lankan contingent vote" class="mw-redirect">Sri Lankan contingent voting</a></th>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
            </tr>
            <tr>
                <th><a target="_blank" href="http://en.wikipedia.org/wiki/Supplementary_vote" title="Supplementary vote" class="mw-redirect">Supplementary voting</a></th>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
                <td class="red-cell">No</td>
                <td class="green-cell">Yes</td>
            </tr>
        </table>
        <aside class="text-right"><em><a href="https://en.wikipedia.org/wiki/Schulze_method#Comparison_table" target="_blank">Source : Wikipedia EN &rarr;</a></em></aside>


        <span class="anchor" id="supported_methods"></span>
        <h2>Supported methods on Condorcet-Vote.org</h2>

        <?php require '../view/Parts/methods_list.php'; ?>

        <span class="anchor" id="methods_overview"></span>
        <h2>Condorcet Methods Overview</h2>

        <article class="method_description">
            <span class="anchor" id="Schulze"></span>
            <h3 >Schulze</h3><aside><a href="https://en.wikipedia.org/wiki/Schulze_method" target="_blank">Schulze Method on Wikipedia &rarr;</a></aside>

            <h4>Summary</h4>
            <p>If for a pairwise contest X either beats or ties Y, then we say that X has a path to Y, with a strength equal to the number of voters ranking X over Y. <br>
            If X has a path to Y of strength m, and Y has a path to Z of strength n, then we say that X has a path to Z equal to the minimum of m and n. <br>
            Of all the paths from X to Y, a maximum path strength can be found. If the maximum path strength from X to Y is greater than the maximum path strength from Y to X, then Y cannot win. The winner is the candidate that does not lose any such maximum path strength comparisons.</p>

            <p>The Schulze method is undoubtedly the most popular advanced Condorcet method. It is commonly used in collaborative organizations such as Wikipedia, Debian, KDE, Pirate Party, Free Software Foundation Europe, OpenStack...</p>

            <h4>Documentation by Martin Schulze himself :</h4>

            <ul><li><a href="http://m-schulze.9mail.de/" target="_blank">http://m-schulze.9mail.de</a></li></ul>

            <h4>Variants</h4>

            <ol>
                <li>Schulze Winning (Recommended by M. Schulze)</li>
                <li>Schulze Margin</li>
                <li>Schulze Ratio</li>
            </ol>

            <h4>Note</h4>

            <p>Our implementation is simple and safe. It does not include the complex and heavy possible supplements (STV...) for advanced tie-breaking. Schulze meets the criterion of resolvability; the possibility of a draw is then already very low and increasingly unlikely when the number of voters exceeds the number of candidates.</p>

        </article>

        <article class="method_description">
            <span class="anchor" id="rkpairs"></span>
            <h3>Ranked Pairs</h3><aside><a href="http://en.wikipedia.org/wiki/Ranked_pairs" target="_blank">Ranked Pairs on Wikipedia &rarr;</a></aside>

            <h4>Summary</h4>
            <p>Ranked Pairs finds a complete ranking. Pairwise victories are processed starting from the greatest margin, and working down. These victories are locked, which means that the final ranking will agree with this pairwise decision. If a victory is processed that is incompatible with the previously locked victories, it is skipped. Once all victories are processed, a complete ranking is left.</p>

            <h4>Documentation</h4>

            <ul>
                <li><a href="<?php echo BASE_URL; ?>assets/DOCS/IndependenceofClones.pdf" target="_blank">Independence of Clones</a></li>
                <li><a href="<?php echo BASE_URL; ?>assets/DOCS/CompleteIndependenceofClones.pdf" target="_blank">Complete Independence of Clones</a></li>
            </ul>

            <h4>Note</h4>

            <p>Our own implementation of this method is experimental. <br>
            The results look good, but it does not handle contingency equalities, which are frequent in small votes; such disputes are then resolved arbitrarily.
            Paradoxically, our implementation is more reliable on large elections than small ones.</p>
        </article>

        <article class="method_description">
            <span class="anchor" id="kem-young"></span>
            <h3>Kemeny-Young</h3><aside><a href="http://en.wikipedia.org/wiki/Kemeny%E2%80%93Young_method" target="_blank">Kemeny-Young on Wikipedia &rarr;</a></aside>

            <h4>Summary</h4>
            <p>Each possible complete ranking of the candidates is given a "distance" score. For each pair of candidates, find the number of ballots that order them the opposite way as the given ranking. The distance is the sum across all such pairs. The ranking with the least distance wins.</p>

            <h4>Note</h4>
            <p>This method, particularly heavy, simply involves a series of calculations for each possible final classification. It is therefore dependent on the number of candidates (and not specifically the number of voters). Thus, if there are five candidates, there are 120 possibilities to calculate; for six there are 720; and for ten there are 3,628,800 possible solutions to compute and store! <br>
            <span style="color:red;">For this reason, the results of this method will only be provided here for elections comprising at most 5 candidates.</span></p>

            <p>Also, this method although excellent, tends not to reach a solution in the case of a very small number of voters (less than the number of candidates). This will be indicated in bold, and an arbitrary classification (but realistic) is provided for reference only.</p>
        </article>

        <article class="method_description">
            <span class="anchor" id="copeland"></span>
            <h3>Copeland</h3><aside><a href="http://en.wikipedia.org/wiki/Copeland%27s_method" target="_blank">Copeland on Wikipedia &rarr;</a></aside>

            <h4>Summary</h4>
            <p>Each alternative's Copeland score is calculated by subtracting the number of alternatives that pairwise beat it from the number that it beats. The alternatives with the highest Copeland score win.</p>

            <p>The Copeland method is very fast and simple. But this method fails the criterion of resolvability, so there are often ties in the results. Due to its ease of understanding, this method has been proposed and is still used in some local elections by universal suffrage around the world.</p>
        </article>

        <article class="method_description">
            <span class="anchor" id="minimax"></span>
            <h3>MiniMax</h3><aside><a href="http://en.wikipedia.org/wiki/Minimax_Condorcet" target="_blank">MiniMax on Wikipedia &rarr;</a></aside>

            <h4>Summary</h4>
            <p>Minimax selects as the winner the candidate whose greatest pairwise defeat is smaller than the greatest pairwise defeat of any other candidate.</p>

            <h4>Variants</h4>
            <p>When it is permitted to rank candidates equally, or to not rank all the candidates, three interpretations of the rule are possible. When voters must rank all the candidates, all three variants are equivalent.</p>

            <ol>
                <li>MiniMax Winning</li>
                <li>MiniMax Margin</li>
                <li>MiniMax Opposition <em>This is not a Condorcet method, because it fails occasionally its criteria!</em></li>
            </ol>

        </article>

    </section>


    <div class="col-md-1">
        <nav id="flexible-nav-bar" class="bs-docs-sidebar hidden-print hidden-xs hidden-sm affix" role="complementary" style="margin-top:8%;">
            <ul class="nav bs-docs-sidenav" role="tablist">
                <li class="active"><a href="#introduction">Introduction</a></li>
                <li><a href="#specifications">Specifications</a></li>
                <li><a href="#supported_methods">Supported methods</a></li>
                <li>
                    <a href="#methods_overview">Condorcet Methods Overview</a>
                    <ul class="nav" style="display:block;">
                        <li><a href="#Schulze">Schulze</a></li>
                        <li><a href="#rkpairs">Ranked pairs</a></li>
                        <li><a href="#kem-young">Kemeny-Young</a></li>
                        <li><a href="#copeland">Copeland</a></li>
                        <li><a href="#minimax">Minimax</a></li>
                    </ul>
                </li>
            </ul>
            <a class="back-to-top" href="#top">
                Back to top
            </a>
        </nav>
    </div>

</div> <!-- /container -->