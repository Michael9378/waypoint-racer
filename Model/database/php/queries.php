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



/***************************************************
****************** USER FUNCTIONS ****************** 
****************************************************/

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



/***************************************************
**************** VEHICLE FUNCTIONS ***************** 
****************************************************/

function getVehicles( $username ) {
	$sql = 'SELECT make, model, year, type FROM  garage, vehicle WHERE garage.username="'.$username.'" AND garage.vehicleid=vehicle.vehicleid';
	return sql_get_query($sql);
}



/***************************************************
****************** TRACK FUNCTIONS ***************** 
****************************************************/

function getTrackInfo( $trackID ){
	$sql = 'SELECT * FROM  track WHERE trackid="'.$trackID.'"';
	return sql_get_query($sql);
}

function setTrackInfo( $trackID, $creator, $trackname, $trackdescription, $tracktags, $distancemiles ) {
	// check if track doesnt exist yet
	if( !getTrackInfo($trackID) ) {
		// insert the track into the database
		$sql = 'INSERT INTO track (creator, trackname, trackdescription, tracktags, distancemiles) VALUES ("'.$trackID.'", "'.$creator.'", "'.$trackname.'", "'.$trackdescription.'", "'.$tracktags.'", "'.$distancemiles.'")';
	}
	else {
		// track already exists, update password and email
		$sql = 'UPDATE track SET creator="'.$creator.'",trackname="'.$trackname.'",trackdescription="'.$trackdescription.'",tracktags="'.$tracktags.'",distancemiles="'.$distancemiles.'" WHERE trackid="'.$trackID.'"';
	}
	// return query
	return sql_set_query($sql);
}



/***************************************************
**************** WAYPOINT FUNCTIONS **************** 
****************************************************/

function getWaypoints( $trackID, $pointorder ){
	// if point order is set to -1, get all waypoints for trackid
	if ($pointorder == -1 )
		$sql = 'SELECT * FROM  waypoint WHERE trackid="'.$trackID.'"';
	else
		$sql = 'SELECT * FROM  waypoint WHERE trackid="'.$trackID.'" AND pointorder="'.$pointorder.'"';
		
	return sql_get_query($sql);
}

function setWaypoints( $waypointsArr ) {
	// pass array of waypoints to add to database
	// waypoint object has trackID, pointorder, isfinish, latitude, longitude
}

function updateWaypoint( $trackID, $pointorder, $isfinish, $latitude, $longitude ) {
	// check if waypoint doesnt exist yet
	if( !getWaypoints($trackID, $pointorder) ) {
		// insert the waypoint into the database
		$sql = 'INSERT INTO track (creator, trackname, trackdescription, tracktags, distancemiles) VALUES ("'.$trackID.'", "'.$creator.'", "'.$trackname.'", "'.$trackdescription.'", "'.$tracktags.'", "'.$distancemiles.'")';
	}
	else {
		// waypoint already exists, update password and email
		$sql = 'UPDATE waypoint SET isfinish="'.$isfinish.'",latitude="'.$latitude.'",longitude="'.$longitude.'" WHERE trackid="'.$trackID.'" AND pointorder="'.$pointorder.'"';
	}
	// return query
	return sql_set_query($sql);
}



/***************************************************
**************** LAPTIME FUNCTIONS ***************** 
****************************************************/

?>