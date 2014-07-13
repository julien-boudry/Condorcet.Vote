<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
  <div class="container">
    <h1>Condorcet Vote : Starting</h1>
    <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
  </div>
</div>

<div class="container">

<div class="page-header">
  <h2>Create a new vote</h2>
</div>

<form name="new_vote" action="?route=Create" method="post">
  <section>
    <div class="page-header">
      <h3>Add Candidates</h3>
    </div>
    <textarea name="candidates" required class="form-control" rows="3" placeholder="Candidate 1"></textarea>
  </section>

  <section>
    <div class="page-header">
      <h3>Add Votes</h3>
    </div>
    <textarea name="votes" class="form-control" rows="3" required></textarea>
  </section>

  <hr>
    <div class="input-group center-block col-xs-12 col-sm-4 col-md-3 col-lg-3">
      <input name="title" type="text" class="form-control" placeholder="Vote Title" required>
      <span class="input-group-btn">
        <button class="btn btn-success" type="submit">Create Vote!</button>
      </span>
    </div>
</form>


</div> <!-- /container -->
