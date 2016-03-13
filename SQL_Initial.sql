/*
Passenger(PID, email, password, phone#, firstName, lastName, cNum, expDate)
Driver(DID, email, password, phone#, firstName, lastName, license#, cNum, expDate)
Car(licensePlate#, type, color)
Create_RideShare(RID, destination, price, did, address, postalCode, province, city, date, time, Ctime, Cdate)
Participates(PID, RID)
Transaction(TID, Type, RID, PID)

TODO: Fix the SQL syntax
*/

drop database if exists RideShare;

create database Rideshare;

use RideShare;

drop table if exists Passenger;
CREATE TABLE Passenger
	(PID Integer NOT NULL,
	email Char(25) NOT NULL,
	password Char(25) NOT NULL,
	phoneNum Integer,
	firstName Char(25),
	lastName Char(25),
	licenseNum Char(25)
  PRIMARY KEY (PID));

drop table if exists Driver;
CREATE TABLE Driver
	(DID Integer,
	email Char(25),
	password Char(25),
	phoneNum Integer,
	firstName Char(25),
	lastName Char(25),
	licenseNum Char(25) NOT NULL,
PRIMARY KEY (DID),
FOREIGN KEY (licenseNum) references Car (licenseNum));

drop table if exists Car;
CREATE TABLE Car
	(licenseNum char(25),
	type char(25),
	color char(25),
PRIMARY KEY (licenseNum));

drop table if exists RideShare;
CREATE TABLE RideShare
  destination Char(25),
  price Integer,
  DID Integer NOT NULL,
  address Char(25),
  postalCode Char(25),
	province Char(25),
	city Char(25),
  date Char(25),
  time Char(25),
  Ctime Char(25),
  CDate Char(25),
  UNIQUE(DID),
  PRIMARY KEY (RID),
  FOREIGN KEY (DID) references Driver, (PID) references Passenger);

drop table if exists Participates;
CREATE TABLE Participates
	(PID Integer,
	RID Integer,
  PRIMARY KEY (PID, RID),
  FOREIGN KEY (PID) REFERENCES Passenger, (RID) REFERENCES RideShare);

drop table if exists Transaction;
CREATE TABLE Transaction
	(TID Integer,
	Type Char(25),
	RID Integer,
	PID Integer
PRIMARY KEY (TID)
FOREIGN KEY (TID) REFERENCES RideShare, (PID) REFERENCES Passenger);

commit;







