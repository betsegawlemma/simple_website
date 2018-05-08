<?php # Script 10.5 - #5
// This script retrieves all the records from the users table.
// This new version allows the results to be sorted in different ways.

if (!isset($_COOKIE['user_id'])) {
	// Need the functions:
	require('includes/redirect_function.inc.php');
	redirect_user();
	}

$page_title = 'View Messages';
include('includes/header.html');
echo '<h1>View Messages</h1>';

require('mysql_connect.php');

// Number of records to show per page:
$display = 10;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} else { // Need to determine.
 	// Count the number of records:
	$q = "SELECT COUNT(user_id) FROM messages";
	$r = @mysqli_query($dbc, $q);
	$row = @mysqli_fetch_array($r, MYSQLI_NUM);
	$records = $row[0];
	// Calculate the number of pages...
	if ($records > $display) { // More than 1 page.
		$pages = ceil ($records/$display);
	} else {
		$pages = 1;
	}
} // End of p IF.

// Determine where in the database to start returning results...
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
	$start = $_GET['s'];
} else {
	$start = 0;
}

// Determine the sort...
// Default is by registration date.
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'rd';

// Determine the sorting order:
switch ($sort) {
	case 'ln':
		$order_by = 'last_name ASC';
		break;
	case 'fn':
		$order_by = 'first_name ASC';
		break;
	case 'sd':
		$order_by = 'submitted_date ASC';
		break;
	case 'email':
		$order_by = 'email ASC';
		break;
	default:
		$order_by = 'submitted_date ASC';
		$sort = 'rd';
		break;
}

// Define the query:
$q = "SELECT last_name, first_name, email, DATE_FORMAT(submitted_date, '%M %d, %Y') AS sd, user_id, comments FROM messages ORDER BY $order_by LIMIT $start, $display";
$r = @mysqli_query($dbc, $q); // Run the query.

// Table header:
echo '<table class="table table-striped">
<thead>
  <tr>
  	<th scope="col"><strong>Delete</strong></th>
    <th scope="col"><strong><a href="view_messages.php?sort=fn">First Name</a></strong></th>
	<th scope="col"><strong><a href="view_messages.php?sort=ln">Last Name</a></strong></th>
	<th scope="col"><strong><a href="view_messages.php?sort=email">Email</a></strong></th>
	<th scope="col"><strong><a href="view_messages.php?sort=sd">Submitted Date</a></strong></th>
	<th scope="col"><strong>Comments</strong></th>
</tr>
</thead>
<tbody>
';

// Fetch and print all the records....
$bg = '#eeeeee';
while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
	$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
		echo '<tr bgcolor="' . $bg . '">
		<td><a href="delete_message.php?id=' . $row['user_id'] . '">Delete</a></td>
        <td>' . $row['first_name'] . '</td>
		<td>' . $row['last_name'] . '</td>
		<td>' . $row['email'] . '</td>
		<td>' . $row['sd'] . '</td>
		<td>' . $row['comments'] . '</td>		
	</tr>
	';
} // End of WHILE loop.

echo '</tbody></table>';
mysqli_free_result($r);
mysqli_close($dbc);

// Make the links to other pages, if necessary.
if ($pages > 1) {

	echo '<br><p>';
	$current_page = ($start/$display) + 1;

	// If it's not the first page, make a Previous button:
	if ($current_page != 1) {
		echo '<a href="view_users.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
	}

	// Make all the numbered pages:
	for ($i = 1; $i <= $pages; $i++) {
		if ($i != $current_page) {
			echo '<a href="view_users.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
		} else {
			echo $i . ' ';
		}
	} // End of FOR loop.

	// If it's not the last page, make a Next button:
	if ($current_page != $pages) {
		echo '<a href="view_users.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
	}

	echo '</p>'; // Close the paragraph.

} // End of links section.

include('includes/footer.html');
?>