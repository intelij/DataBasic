ALTER TABLE DataBasic.Participates DROP FOREIGN KEY Participates_ibfk_1;
ALTER TABLE DataBasic.Participates DROP FOREIGN KEY Participates_ibfk_2;
ALTER TABLE DataBasic.RideShare DROP FOREIGN KEY RideShare_ibfk_1;
ALTER TABLE DataBasic.RideShare DROP FOREIGN KEY RideShare_Location_postalCode_fk;
ALTER TABLE DataBasic.Driver DROP FOREIGN KEY Driver_ibfk_1;
DROP TABLE DataBasic.Participates;
DROP TABLE DataBasic.RideShare;
DROP TABLE DataBasic.Driver;
DROP TABLE DataBasic.Passenger;
DROP TABLE DataBasic.Location;
DROP TABLE DataBasic.Car;

USE DataBasic;

CREATE TABLE `Car` (
 `licenseNum` char(25) NOT NULL,
 `type` char(25) NOT NULL,
 `color` char(25) NOT NULL,
 PRIMARY KEY (`licenseNum`),
 UNIQUE KEY `Car_licenseNum_uindex` (`licenseNum`)
);

CREATE TABLE `Driver` (
 `DID` int(11) NOT NULL AUTO_INCREMENT,
 `email` char(25) NOT NULL,
 `password` char(25) NOT NULL,
 `phoneNum` char(25) NOT NULL,
 `name` char(25) NOT NULL,
 `licenseNum` char(25) NOT NULL,
 PRIMARY KEY (`DID`),
 UNIQUE KEY `Driver_name_uindex` (`name`),
 KEY `licenseNum` (`licenseNum`),
 CONSTRAINT `Driver_ibfk_1` FOREIGN KEY (`licenseNum`) REFERENCES `Car` (`licenseNum`)
);

CREATE TABLE `Location` (
 `postalCode` char(25) NOT NULL,
 `city` char(25) NOT NULL,
 `province` char(25) NOT NULL,
 PRIMARY KEY (`postalCode`),
 UNIQUE KEY `Location_postalCode_uindex` (`postalCode`)
);

CREATE TABLE `Participates` (
 `PID` int(11) NOT NULL,
 `RID` int(11) NOT NULL,
 `Type` char(25) DEFAULT NULL,
 PRIMARY KEY (`PID`,`RID`),
 KEY `RID` (`RID`),
 CONSTRAINT `Participates_ibfk_1` FOREIGN KEY (`PID`) REFERENCES `Passenger` (`PID`),
 CONSTRAINT `Participates_ibfk_2` FOREIGN KEY (`RID`) REFERENCES `RideShare` (`RID`) ON DELETE CASCADE
);

CREATE TABLE `Passenger` (
 `PID` int(11) NOT NULL AUTO_INCREMENT,
 `email` char(25) NOT NULL,
 `password` char(25) NOT NULL,
 `phoneNum` char(25) NOT NULL,
 `name` char(25) NOT NULL,
 PRIMARY KEY (`PID`),
 UNIQUE KEY `Passenger_name_uindex` (`name`)
);

CREATE TABLE `RideShare1` (
 `RID` int(11) NOT NULL AUTO_INCREMENT,
 `destination` char(25) NOT NULL,
 `price` float NOT NULL,
 `DID` int(11) NOT NULL,
 `address` char(25) DEFAULT NULL,
 `postalCode` char(25) NOT NULL,
 `rdate` date NOT NULL,
 `rtime` time DEFAULT NULL,
 `seats` int(11) NOT NULL,
 `seatsLeft` int(11) NOT NULL,
 `Cdatetime` datetime NOT NULL,
 PRIMARY KEY (`RID`),
 KEY `DID` (`DID`),
 KEY `RideShare_Location_postalCode_fk` (`postalCode`),
 CONSTRAINT `RideShare_Location_postalCode_fk` FOREIGN KEY (`postalCode`) REFERENCES `Location` (`postalCode`),
 CONSTRAINT `RideShare_ibfk_1` FOREIGN KEY (`DID`) REFERENCES `Driver` (`DID`),
 CHECK (destination='Whistler' OR 'Victoria' OR 'Richmond' OR 'Vancouver' OR 'MaCrib')
);