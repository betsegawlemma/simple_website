<?php # Script 18.6 - register.php
// This is the registration page for the site.
require('includes/config.inc.php');
$page_title = 'Messages';
include('includes/header.html');
include('includes/redirect_function.inc.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.
// Need the database connection:
require(MYSQL);
// Trim all the incoming data:
$trimmed = array_map('trim', $_POST);
// Assume invalid values:
$fn = $ln = $e = $m = FALSE;
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
    if (preg_match('/^[A-Z \'.-]{2,40}$/i', $trimmed['comments'])) {
        $c = mysqli_real_escape_string($dbc, $trimmed['comments']);
        } else {
        echo '<p class="bg-danger">Please enter your comments!</p>';
        }
if ($fn && $ln && $e && $c) { // If everything's OK...
    
    // Add the user to the database:
    $q = "INSERT INTO messages (email, first_name, last_name, comments,
    submitted_date) VALUES ('$e', '$fn', '$ln', '$c', NOW() )";
    $r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br>MySQL Error:
    " . mysqli_error($dbc));
    if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
    
    redirect_user('view_messages.php');
    include('includes/footer.html'); // Include the HTML footer.
    exit(); // Stop the page.
    } else { // If it did not run OK.
    echo '<p class="bg-danger">Your comment could not be send due to a system
    error. We apologize for any inconvenience.</p>';
    }
    } else { // If one of the data tests failed.
    echo '<p class="bg-danger">Please try again.</p>';
    }
    mysqli_close($dbc);
}
    ?>
<p>Please fill out this form to contact us.</p>
<form action="contact.php" method="post">
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
    <label for="comments" class="col-sm-2 col-form-label">Comments</label>
    <div class="col-sm-10"> 
        <textarea name="comments" rows="5" cols="50"><?php if (isset($_POST['comments'])) echo $_POST['comments']; ?></textarea>
    </div>
    </div>
    <div class="form-group">
    <div class="col-sm-10"> 
    <button type="submit" name="submit" class="btn btn-primary" value="Send">Send</button>
    </div>
    </div>
</form>
<?php
include("includes/footer.html");
?>