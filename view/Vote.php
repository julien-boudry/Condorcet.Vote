<?php declare(strict_types=1);
use CondorcetPHP\Condorcet\Utils\CondorcetUtil;

?>

<section class="container">

    <header>
        <h1 class="text-center"><?php


 echo $this->_Condorcet_Vote->getTitle(); ?> <small>Vote</small></h1>
        <?php if (!empty($this->_Condorcet_Vote->getDescription())) { ?>
        <p class="breadcrumb">
            <?php echo $this->_Condorcet_Vote->getDescription(); ?>
        </p>
        <?php } ?>
    </header>

    <section>
        <header class="page-header">
            <h2>Informations & Votes</h2>
        </header>

        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#vote_global_info" role="tab" data-toggle="tab">Global Informations</a></li>
            <li><a href="#vote_candidates" role="tab" data-toggle="tab"><span class="badge"><?php echo $this->_objectCondorcet->countCandidates(); ?></span> Candidates</a></li>
            <li><a href="#vote_votes" role="tab" data-toggle="tab"><span class="badge"><?php echo $this->_objectCondorcet->countVotes(); ?></span> Votes</a></li>
        </ul>

        <div class="tab-content" style="padding-top:2%;">
            <div class="tab-pane fade in active" id="vote_global_info">
                <ul>
                    <li>
                        <em>Compute by
                            <a href="https://github.com/julien-boudry/Condorcet" target="_blank">Condorcet PHP</a>
                            <span class="label label-info"><?php echo $this->_objectCondorcet->getObjectVersion(true); ?></span>
                        </em>
                    </li>
                    <li>
                        <strong>Create on:</strong>
                        UTC <?php echo $this->_Condorcet_Vote->getDate(); ?>
                    </li>
                    <li>
                        <strong class="tooltips" data-toggle="tooltip" data-placement="bottom"
                        title="Number of amendments to the vote since its inception.">
                            Update count:
                        </strong>
                        <?php echo $this->_Condorcet_Vote->getCountUpdate(); ?>
                    </li>
                    <?php if ($this->_Condorcet_Vote->getCountUpdate() > 0) { ?>
                    <li>
                        <strong>Last update on:</strong>
                        UTC <?php echo $this->_Condorcet_Vote->getUpdateDate(); ?>
                    </li>
                    <?php } ?>
                    <li>
                        <strong class="tooltips" data-toggle="tooltip" data-placement="bottom"
                        title="Computation time accumulated by the algorithms after each update of the vote.">
                            Cumulated computing time:
                        </strong>
                        <?php echo number_format($this->_objectCondorcet->getGlobalTimer(true), 2); ?> second(s)
                    </li>
                </ul>
            </div>
            <section class="tab-pane fade in" id="vote_candidates">
                <ul>
                    <?php
                        foreach ($this->_objectCondorcet->getCandidatesList() as $candidate) {
                            echo '<li>'.$candidate.'</li>';
                        }
?>
                </ul>
            </section>
            <section class="tab-pane fade in" id="vote_votes">
                <?php foreach ($this->_objectCondorcet->getVotesList() as $voteid => $vote) { ?>
                <div class="panel-group" id="votes_accordion">
                    <div class="panel panel-warning">
                        <header class="panel-heading" data-toggle="collapse" data-parent="#votes_accordion" data-target="#<?php echo $voteid; ?>_voteid" style="cursor:pointer;">
                            <h4 class="panel-title">
                                <span class="glyphicon glyphicon-indent-left margin-icon"></span>
                                <span class="caret pull-right"></span>
                                Vote N° <?php echo $voteid; ?>

                                <?php foreach ($vote->getTags() as $tag) { ?>

                                    <span class="pull-right tag-icon label <?php echo showOneTagClass($tag); ?>"><?php echo htmlspecialchars($tag ?? ''); ?></span>

                                <?php } ?>
                            </h4>
                        </header>
                        <div id="<?php echo $voteid; ?>_voteid" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul class="list-group">
                                    <?php
                $voteDate = date('l jS \of F Y, H:i:s', (int) $vote->getTimestamp());

                    $i = 0;
                    foreach ($vote->getContextualRanking($this->_objectCondorcet) as $rank => $rank_vote) { ?>
                                    <li class="list-group-item <?php echo ($i === 0) ? 'list-group-item-success' : ''; ?>">
                                        <span class="badge">
                                            <?php echo $rank; ?>
                                        </span>
                                        <?php
                            echo implode(' / ', $rank_vote);
                        ?>
                                    </li>
                                    <?php
                        $i++;
                    } ?>
                                </ul>
                                <em class="pull-right"><?php echo $voteDate . ' UTC'; ?></em>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </section>
        </div>
    </section>

<?php if ($this->_objectCondorcet->countVotes() > 0) { ?>
    <section>
        <header class="page-header">
            <h2>Natural Condorcet Winner & Loser</h2>
        </header>
            <div class="alert alert-success" role="alert">
                <?php if ($this->_objectCondorcet->getWinner() !== null) { ?>
                    <span class="fa fa-trophy ranking_icon margin-icon"></span>
                    <strong>Natural Condorcet Winner:</strong>
                    <?php echo $this->_objectCondorcet->getWinner(); ?>
                <?php } else { ?>
                    <span class="glyphicon glyphicon-ban-circle ranking_icon margin-icon"></span>
                    <strong>No natural Condorcet Winner found</strong>
                <?php } ?>
            </div>
            <div class="alert alert-danger" role="alert">
                <?php if ($this->_objectCondorcet->getLoser() !== null) { ?>
                    <span class="fa fa-hand-o-down ranking_icon margin-icon"></span>
                    <strong>Natural Condorcet Loser:</strong>
                    <?php echo $this->_objectCondorcet->getLoser(); ?>
                <?php } else { ?>
                    <span class="glyphicon glyphicon-ban-circle ranking_icon margin-icon"></span>
                    <strong>No natural Condorcet Loser found</strong>
                <?php } ?>
            </div>

        <section class="panel-group" id="pairewise_accordion">
            <div class="panel panel-primary">
                <header class="panel-heading" data-toggle="collapse" data-parent="#pairewise_accordion" data-target="#the_pairwise" style="cursor:pointer;">
                    <h4 class="panel-title">
                        <span class="glyphicon glyphicon-indent-left margin-icon"></span> Look PairWise
                        <span class="caret pull-right"></span>
                    </h4>
                </header>
                <div id="the_pairwise" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <?php setHtmlPairwise($this->_objectCondorcet->getPairwise()->getExplicitPairwise()); ?>
                    </div>
                </div>
            </div>
        </section>
    </section>

    <?php
    $allow_methods = json_decode($this->_Condorcet_Vote->_bean->methods, true);

    if (!empty($allow_methods)) { ?>
    <section>
        <header class="page-header">
            <h2>Advanced Results</h2>
        </header>

        <div class="panel-group" id="results_accordion">
        <?php
        foreach (CONDORCET_METHOD as $title => $method) {
            if (!\in_array($method, $allow_methods, true)) {
                continue;
            }
            ?>
            <section class="panel panel-info">
                    <header class="panel-heading" data-toggle="collapse" data-parent="#results_accordion" data-target="#<?php echo $method; ?>" style="cursor:pointer;">
                        <h3 class="panel-title">
                            <span class="glyphicon glyphicon-th-list margin-icon"></span>
                        <?php echo $title; ?>
                            <span class="caret pull-right"></span>
                        </h3>
                    </header>
                    <div id="<?php echo $method; ?>" class="panel-collapse collapse">
                    <div class="panel-body">
                    <?php
                        if ($method === 'KemenyYoung' || $method === 'RankedPairsWinning' || $method === 'RankedPairsWinning') {
                            // Limite de candidat
                            try {
                                $test_kemeny = $this->_objectCondorcet->getResult($method);
                            } catch (CondorcetPHP\Condorcet\Throwable\CandidatesMaxNumberReachedException $e) { ?>
                                    <em> You have to many candidate to use this method (limit is : <?php
                                        echo ('CondorcetPHP\Condorcet\Algo\Methods\\'.$method)::$_maxCandidates;
                                ?> candidates) </em>
                                    </div></div></section>
                                <?php
                                continue;
                            }

                            // Résultats arbitraire

                            if (!empty($test_kemeny->getWarning(CondorcetPHP\Condorcet\Algo\Methods\KemenyYoung\KemenyYoung::CONFLICT_WARNING_CODE))) {
                                $test_kemeny = explode(';', $test_kemeny->getWarning(CondorcetPHP\Condorcet\Algo\Methods\KemenyYoung\KemenyYoung::CONFLICT_WARNING_CODE)[0]['msg']);

                                echo '
                                <div class="kemeny-arbitrary">
                                    <strong>Arbitrary results: Kemeny-Young has '.$test_kemeny[0].' possible solutions at score '.$test_kemeny[1].'</strong><br>
                                    <em>This vote can not be resolved, and the following result is arbitrary but indicative. See calculation details for more information.</em>
                                </div>
                                ';
                            }

                            unset($test_kemeny);
                        }

            ?>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="active"><a href="#<?php echo $method; ?>_ranking" role="tab" data-toggle="tab">Ranking</a></li>
                            <li><a href="#<?php echo $method; ?>_details" role="tab" data-toggle="tab">Details</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="<?php echo $method; ?>_ranking">
                                <ul class="list-group">
                                    <?php
                            foreach ($this->_objectCondorcet->getResult($method) as $rank => $rankContent) {
                                $rankContent = implode(' / ', $rankContent);
                                ?>
                                        <li class="list-group-item
                                        <?php
                                    echo ($rankContent === $this->_objectCondorcet->getWinner()) ? 'list-group-item-success ' : '';
                                echo ($rankContent === $this->_objectCondorcet->getLoser()) ? 'list-group-item-danger' : '';
                                ?>">
                                            <span class="badge">
                                                <?php echo $rank; ?>
                                            </span>
                                            <?php
                                        echo $rankContent;
                                ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="tab-pane fade in" id="<?php echo $method; ?>_details">
                                <pre><?php
                                        if ($method === 'KemenyYoung' && $this->_objectCondorcet->countCandidates() > 7) {
                                            echo 'To many candidate for Kemeny-Young to show it on a page.';
                                        } else {
                                            print_r(
                                                CondorcetUtil::format(
                                                    $this->_objectCondorcet
                                                        ->getResult($method)->getStats(),
                                                    true
                                                )
                                            );
                                        }
            ?></pre>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>
        </div>
    </section>
    <?php } ?>
<?php } else { ?>
<section><em>This election does not yet contain any vote.</em></section>
<?php } ?>


</section> <!-- /container -->
