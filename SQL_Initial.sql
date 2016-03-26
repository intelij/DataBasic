/*drop database if exists DataBasic;

create database DataBasic;
*/
use DataBasic;

drop table if exists Passenger;
CREATE TABLE Passenger
	(PID int auto_increment not null,
	email Char(25) NOT NULL,
	password Char(25) NOT NULL,
	phoneNum Integer,
	firstName Char(25),
	lastName Char(25),
  PRIMARY KEY (PID));

drop table if exists Car;
CREATE TABLE Car
	(licenseNum char(25),
	type char(25),
	color char(25),
PRIMARY KEY (licenseNum));

drop table if exists Driver;
CREATE TABLE Driver
	(DID int auto_increment not null,
	email Char(25),
	password Char(25),
	phoneNum Integer,
	firstName Char(25),
	lastName Char(25),
	licenseNum Char(25) NOT NULL,
PRIMARY KEY (DID),
FOREIGN KEY (licenseNum) references Car (licenseNum));

drop table if exists RideShare;
CREATE TABLE RideShare
  (RID int auto_increment not null,
  destination Char(25),
  price Integer,
  DID Integer NOT NULL,
  address Char(25),
  postalCode Char(25),
  province Char(25),
  city Char(25),
  rdate Char(25),
  rtime Char(25),
  Ctime Char(25),
  CDate Char(25),
	seats Integer,
	seatsLeft Integer,
  PRIMARY KEY (RID),
  FOREIGN KEY (DID) references Driver (DID));

drop table if exists Participates;
CREATE TABLE Participates
	(PID Integer NOT NULL,
	RID Integer NOT NULL,
  PRIMARY KEY (PID, RID),
  FOREIGN KEY (PID) REFERENCES Passenger (PID),
  FOREIGN KEY (RID) REFERENCES RideShare (RID) );

drop table if exists Transaction;
CREATE TABLE Transaction
	(TID int auto_increment not null,
	Type Char(25),
	RID Integer NOT NULL,
	PID Integer NOT NULL,
PRIMARY KEY (TID),
FOREIGN KEY (RID) REFERENCES RideShare (RID) ,
FOREIGN KEY (PID) REFERENCES Passenger (PID));








