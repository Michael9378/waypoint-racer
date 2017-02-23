<?php 

// Get queries use this
function sql_get_query($sql) {
	
	// prepare connection to database
	// this file is hidden from Git as it has login information to database
	require "Model/database/php/dbconnect.php";
		
	// connect to database
	mysqli_connect( $dbservername, $dbusername, $dbpassword );
	
	// make the query
	$response = $conn->query($sql);
	
	// check for rows
	if($response->num_rows > 0) {
		// store rows in an array
		$rows = array();
		// push rows and return
		while( $row = $response->fetch_assoc() ) {
			array_push($rows, $row);
		}
		// close connection
		mysqli_close();
		return $rows;
	}
	else {
		return false;
	}
	
}

// Insert, Update, Drop queries use this
function sql_set_query($sql) {

	// prepare connection to database
	require "Model/database/php/dbconnect.php";

	// connect to database
	mysqli_connect( $dbservername, $dbusername, $dbpassword );

	// make the query
	$response = $conn->query($sql);

	// close connection
	mysqli_close();

	return $response;
}

function getUser( $username ) {
	$sql = 'SELECT * FROM  user WHERE username="'.$username.'"';
	return sql_get_query($sql);
}

function setUser( $username, $password, $email ) {
	// check if user doesnt exist yet
	if( !getUser($username) ) {
		// insert the user into the database
		$sql = 'INSERT INTO user (username, password, email) VALUES ("'.$username.'", "'.$password.'", "'.$email.'")';
	}
	else {
		// user already exists, update password and email
		$sql = 'UPDATE user SET password="'.$password.'", email="'.$email.'" WHERE username="'.$username.'"';
	}
	// return query
	return sql_set_query($sql);
}

function getTrackInfo( $trackID ){
	$sql = 'SELECT * FROM  track WHERE trackid="'.$trackID.'"';
	return sql_get_query($sql);
}

function setTrackInfo( $trackID, $creator, $trackname, $trackdescription, $tracktags, $distancemiles ) {
	// check if user doesnt exist yet
	if( !getTrackInfo($trackID) ) {
		// insert the user into the database
		$sql = 'INSERT INTO track (creator, trackname, trackdescription, tracktags, distancemiles) VALUES ("'.$trackID.'", "'.$creator.'", "'.$trackname.'", "'.$trackdescription.'", "'.$tracktags.'", "'.$distancemiles.'")';
	}
	else {
		// user already exists, update password and email
		$sql = 'UPDATE track SET creator="'.$creator.'",trackname="'.$trackname.'",trackdescription="'.$trackdescription.'",tracktags="'.$tracktags.'",distancemiles="'.$distancemiles.'" WHERE trackid="'.$trackID.'"';
	}
	// return query
	return sql_set_query($sql);
}

?>