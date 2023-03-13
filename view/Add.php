<div class="container">
    <header>
        <h2 class="text-center">Voting</h2>
    </header>

    <form name="add_vote" method="post">
    <section>
        <header class="page-header">
            <h3>Your Identifiant <small>(Optional)</small></h3>
        </header>
        <?php if ($this->_mode === 'Personnal') { ?>
        <div class="text-center">
            <strong style="font-weight:150%;"><?php echo htmlspecialchars($_GET['personnal_name'] ?? ''); ?></strong>
        </div>
    <?php } elseif ($this->_mode === 'Public') { ?>
        <input type="text" name="add_name" pattern="<?php echo REGEX_ADD_NAME; ?>" maxlength="<?php echo NAME_MAX_LENGHT; ?>" class="center-block" spellcheck="false">
    <?php } ?>
    </section>


    <section>
        <header class="page-header">
            <h3>Your Vote</h3>
        </header>
        <div class="row">
                <div class="col-lg-6 col-md-6 .col-sm-8 col-xs-6 center-block input-group">
                    <input type="text" name="add_vote_content" class="form-control" required placeholder="A>B>C=D=E>Z" autocomplete="off" pattern="<?php echo REGEX_ADD_VOTE; ?>" spellcheck="false">
                </div><!-- /input-group -->
        </div><!-- /.row -->
    </section>

    <hr>
    <button class="btn btn-info center-block" type="submit">Add you vote</button>

    </form>

</div> <!-- /container -->

<hr>