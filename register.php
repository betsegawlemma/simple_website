<?php # Script 18.6 - register.php
// This is the registration page for the site.
require('includes/config.inc.php');
$page_title = 'Register';
include('includes/header.html');
include('includes/redirect_function.inc.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.
// Need the database connection:
require(MYSQL);
// Trim all the incoming data:
$trimmed = array_map('trim', $_POST);
// Assume invalid values:
$fn = $ln = $e = $p = FALSE;
// Check for a first name:
if (preg_match('/^[A-Z \'.-]{2,20}$/i', $trimmed['first_name'])) {
$fn = mysqli_real_escape_string($dbc, $trimmed['first_name']);
} else {
echo '<p class="bg-danger">Please enter your first name!</p>';
}
// Check for a last name:
if (preg_match('/^[A-Z \'.-]{2,40}$/i', $trimmed['last_name'])) {
$ln = mysqli_real_escape_string($dbc, $trimmed['last_name']);
} else {
echo '<p class="bg-danger">Please enter your last name!</p>';
}
// Check for an email address:
if (filter_var($trimmed['email'], FILTER_VALIDATE_EMAIL)) {
$e = mysqli_real_escape_string($dbc, $trimmed['email']);
} else {
echo '<p class="bg-danger">Please enter a valid email address!</p>';
}
// Check for a password and match against the confirmed password:
if (strlen($trimmed['password1']) >= 6) {
if ($trimmed['password1'] == $trimmed['password2']) {
$p = password_hash($trimmed['password1'], PASSWORD_DEFAULT);
} else {
echo '<p class="bg-danger">Your password did not match the confirmed password!</p>';
}
} else {
echo '<p class="bg-danger">Please enter a valid password!</p>';
}
if ($fn && $ln && $e && $p) { // If everything's OK...
    // Make sure the email address is available:
    $q = "SELECT user_id FROM users WHERE email='$e'";
    $r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br>MySQL Error: " .
mysqli_error($dbc));
if (mysqli_num_rows($r) == 0) { // Available.

    // Create the activation code:
    $a = md5(uniqid(rand(), true));
    // Add the user to the database:
    $q = "INSERT INTO users (email, pass, first_name, last_name, active,
    registration_date) VALUES ('$e', '$p', '$fn', '$ln', '$a', NOW() )";
    $r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br>MySQL Error:
    " . mysqli_error($dbc));
    if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
    
    redirect_user('view_users.php');
    include('includes/footer.html'); // Include the HTML footer.
    exit(); // Stop the page.
    } else { // If it did not run OK.
    echo '<p class="bg-danger">You could not be registered due to a system
    error. We apologize for any inconvenience.</p>';
    }

    } else { // The email address is not available.
    echo '<p class="bg-danger">That email address has already been registered. If
    you have forgotten your password, use the link at right to have your password sent to you.
    </p>';
    }
    } else { // If one of the data tests failed.
    echo '<p class="bg-danger">Please try again.</p>';
    }
    mysqli_close($dbc);
    } // End of the main Submit conditional.
    ?>
    <h1>Register</h1>
    <form action="register.php" method="post">
    <div class="form-group row">
    <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
    <div class="col-sm-10"> 
        <input type="text" name="first_name" value="<?php if (isset($trimmed['first_name'])) echo $trimmed['first_name']; 
    ?>">
    </div>
    </div>
    <div class="form-group row">
    <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
    <div class="col-sm-10"> 
        <input type="text" name="last_name" value="<?php if (isset($trimmed['last_name'])) echo $trimmed['last_name']; 
    ?>">
    </div>
    </div>
    <div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label">Email Address</label>
    <div class="col-sm-10"> 
   <input type="email" name="email" value="<?php if (isset($trimmed['email'])) echo $trimmed['email']; ?>">
   </div>
    </div>
    <div class="form-group row">
    <label for="password1" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10"> 
    <input type="password" name="password1" value="<?php if (isset($trimmed['password1'])) echo $trimmed['password1']; ?>"> 
    </div>
    </div>
    <div class="form-group row">
    <label for="password2" class="col-sm-2 col-form-label">Confirm Password</label>
    <div class="col-sm-10"> 
    <input type="password" name="password2" value="<?php if (isset($trimmed['password2'])) echo $trimmed['password2']; ?>">
    </div>
    </div>
    <div class="form-group row">
    <div class="col-sm-10"> 
    <button type="submit" name="submit" class="btn btn-primary" value="Register">Register</button>
    </div>
    </div>
    </form>
    <?php include('includes/footer.html'); ?>