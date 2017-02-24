
CREATE TABLE user (
	username VARCHAR(20) NOT NULL,
	password VARCHAR(30) NOT NULL,
	email VARCHAR(50) NOT NULL,
	PRIMARY KEY (username)
);

CREATE TABLE garage (
	username VARCHAR(20) NOT NULL,
	vehicleid INT,
	PRIMARY KEY(vehicleid)
);


CREATE TABLE vehicle (
	vehicleid INT NOT NULL AUTO_INCREMENT,
	make VARCHAR(20) NOT NULL,
	model VARCHAR(20),
	year INT NOT NULL,
	type INT NOT NULL,
	PRIMARY KEY (vehicleid)
);


CREATE TABLE track (
	trackid INT NOT NULL AUTO_INCREMENT,
	creator VARCHAR(20) NOT NULL,
	trackname VARCHAR(30) NOT NULL,
	trackdescription VARCHAR(300),
	tracktags VARCHAR(100),
	distancemiles FLOAT NOT NULL,
	PRIMARY KEY (trackid)
);


CREATE TABLE waypoint (
	trackid INT NOT NULL,
	pointorder INT NOT NULL,
	isfinish BIT,
	latitude DOUBLE NOT NULL,
	longitude DOUBLE NOT NULL,
	PRIMARY KEY (trackid, pointorder)
);


CREATE TABLE laptime (
	trackid INT NOT NULL,
	username VARCHAR(20) NOT NULL,
	vehicleid INT NOT NULL,
	timesec DOUBLE NOT NULL,
	PRIMARY KEY (trackid, username, vehicleid)
);