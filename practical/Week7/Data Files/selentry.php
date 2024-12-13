<?php
include 'include.php';
doDB();

if (!$_POST)  {
	//haven't seen the selection form, so show it
	$display_block = "<h1>Select an Entry</h1>";

	//get parts of records
	$get_list_sql = "SELECT id,
	                 CONCAT_WS(', ', l_name, f_name) AS display_name
	                 FROM master_name ORDER BY l_name, f_name";
	$get_list_res = mysqli_query($mysqli, $get_list_sql) or die(mysqli_error($mysqli));

	if (mysqli_num_rows($get_list_res) < 1) {
		//no records
		$display_block .= "<p><em>Sorry, no records to select!</em></p>";

	} else {
		//has records, so get results and print in a form
		$display_block .= "
		<form method=\"post\" action=\"".$_SERVER['PHP_SELF']."\">
		<p><label for=\"sel_id\">Select a Record:</label><br/>
		<select id=\"sel_id\" name=\"sel_id\" required=\"required\">
		<option value=\"\">-- Select One --</option>";

		while ($recs = mysqli_fetch_array($get_list_res)) {
			$id = $recs['id'];
			$display_name = stripslashes($recs['display_name']);
			$display_block .= "<option value=\"".$id."\">".$display_name."</option>";
		}

		$display_block .= "
		</select></p>
		<button type=\"submit\" name=\"submit\" value=\"view\">View Selected Entry</button>
		</form>";
	}
	//free result
	mysqli_free_result($get_list_res);

} else if ($_POST) {
	//check for required fields
	if ($_POST['sel_id'] == "")  {
		header("Location: selentry.php");
		exit;
	}

	//create safe version of ID
	$safe_id = mysqli_real_escape_string($mysqli, $_POST['sel_id']);

	//get master_info
	$get_master_sql = "SELECT concat_ws(' ', f_name, l_name) as display_name
	                   FROM master_name WHERE id = '".$safe_id."'";
	$get_master_res = mysqli_query($mysqli, $get_master_sql) or die(mysqli_error($mysqli));

	while ($name_info = mysqli_fetch_array($get_master_res)) {
		$display_name = stripslashes($name_info['display_name']);
	}

	$display_block = "<h1>Showing Record for ".$display_name."</h1>";

	//free result
	mysqli_free_result($get_master_res);
	
	//get all email
	$get_email_sql = "SELECT email FROM email
	                  WHERE master_id = '".$safe_id."'";
	$get_email_res = mysqli_query($mysqli, $get_email_sql) or die(mysqli_error($mysqli));

	 if (mysqli_num_rows($get_email_res) > 0) {

		$display_block .= "<p><strong>Email:</strong><br/>
		<ul>";

		while ($email_info = mysqli_fetch_array($get_email_res)) {
			$email = stripslashes($email_info['email']);
			
			$display_block .= "<li>$email</li>";
		}

		$display_block .= "</ul>";
	}

	//free result
	mysqli_free_result($get_email_res);

	//get personal notes
	$get_notes_sql = "SELECT note FROM personal_notes
	                  WHERE master_id = '".$safe_id."'";
	$get_notes_res = mysqli_query($mysqli, $get_notes_sql) or die(mysqli_error($mysqli));
	
	if (mysqli_num_rows($get_notes_res) > 0) {
	    
	    $display_block .= "<p><strong>Notes:</strong><br/>
		<ul>";
	    
	    while ($notes_info = mysqli_fetch_array($get_notes_res)) {
	        $note = stripslashes($notes_info['note']);
	        
	        $display_block .= "<li>$note</li>";
	    }
	    
	    $display_block .= "</ul>";
	}
	
	//free result
	mysqli_free_result($get_notes_res);
	

	$display_block .= "<br/>
	<p style=\"text-align: center\"><a href=\"".$_SERVER['PHP_SELF']."\">select another</a></p>";
}
//close connection to MySQL
mysqli_close($mysqli);
?>
<!DOCTYPE html>
<html>
<head>
<title>My Records</title>
</head>
<body>
<?php echo $display_block; ?>
</body>
</html>