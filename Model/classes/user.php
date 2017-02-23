<?php 

// User class
// users have a friends list
// users have a vehicle list
// users have a list of created tracks
// users have a list of laptimes

function createUser($username, $password, $email) {
	if( !getUser( $username ) ) {
		setUser( $username, $password, $email );
		return new User( $username, $password, $email );
	}
	else {
		return false;
	}
}

class User {
	var $username; // string
	var $password; // string that will be encrypted
	var $email; // can be used as id
	var $vehicles = []; // array of vehicle objects
	var $friends = []; // array of users
	var $tracks = []; // array of tracks this user has created
	var $lapTimes = []; // array of lap times for this user.

	function __construct( $username, $password, $email ) {
		// set username and password
		$this->username = $username;
		$this->password = $password;
		$this->email = $email;
	}

	function getUserInfo(){
		// validate username and password
		$loggedIn = $this->userLogin();
		// make sure we are logged in
		if( $loggedIn ) {
			// populate variables from database
			$this->email = $this->getEmail();
			$this->vehicles = $this->getVehicles();
			$this->friends = $this->getFriends();
			$this->tracks = $this->getTracks();
			$this->lapTimes = $this->getLapTimes();
		}
		else {
			// username and password do not much
			die("Incorrect username/password combination.");
		}
	}

	function userLogin() {
		// check username against password in db and log user in
		return true;
	}

	function getVehicles() {
		// make call to database with passed username to get Vehicles.
		return;
	}

	function getFriends() {
		// make call to database with passed username to get Friends.
		return;
	}

	function getTracks() {
		// make call to database with passed username to get Tracks.
		return;
	}

	function getLapTimes() {
		// make call to database with passed username to get LapTimes.
		return;
	}

}

?>