<!-- Fixed navbar -->
<header class="navbar navbar-fixed-top navbar-custom" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <img id="logo" src="<?php echo BASE_URL; ?>assets/IMG/mini-logo.png" alt="Logo">
            <a class="navbar-brand" href="<?php echo BASE_URL; ?>">Condorcet Vote</a>
        </div>
        <nav class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active" data-toggle="modal" data-target="#new_vote"><a href="#">New Vote</a></li>
                <li><a href="<?php echo BASE_URL; ?>Condorcet_Methods">Condorcet methods</a></li>
                <li><a href="<?php echo BASE_URL; ?>Manual">Help</a></li>
                <li><a href="<?php echo BASE_URL; ?>About">About</a></li>
                 <!--
                 <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="#">Separated link</a></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
                -->
            </ul>
            <div class="nav navbar-nav pull-right" style="margin-top:10px;">
                <a href="<?php echo BASE_URL; ?>Donate">
                    <span class="label label-warning"><strong><i class="fa fa-btc"></i> DONATE</strong></span>
                </a>
            </div>
        </nav><!--/.nav-collapse -->
    </div>
</header>

<div id="maintenance-banner">
    <div class="container">
        <p>
            <strong><i class="fa fa-info-circle"></i> This website is no longer actively maintained.</strong>
        </p>
        <p>
            Try <a href="https://desktop.condorcet.vote" target="_blank" rel="noopener"><strong>Condorcet Desktop</strong></a> &mdash; a full-featured app to compute Condorcet elections, right from your browser or locally.
        </p>
        <a href="https://desktop.condorcet.vote" target="_blank" rel="noopener" class="btn btn-sm maintenance-banner-btn">
            Try Condorcet Desktop &rarr;
        </a>
    </div>
</div>