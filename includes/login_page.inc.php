<?php //login.php

// This page prints any errors associated with logging in
// and it creates the entire login page, including the form.
// Include the header:
$page_title = 'Login';
include('includes/header.html');
// Print any error messages, if they exist:
if (isset($errors) && !empty($errors)) {
echo '<h1>Error!</h1>
<p class="error">The following error(s) occurred:<br>';
foreach ($errors as $msg) {
echo " - $msg<br>\n";
}
echo '</p><p>Please try again.</p>';
}
// Display the form:
?><h1>Login</h1>
<form action="login.php" method="POST">
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" name="pass" class="form-control" id="inputPassword3" placeholder="Password">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" name="submit" value="Login" class="btn btn-primary">Login</button>
    </div>
  </div>
</form>
<?php
include("includes/footer.html");
?>