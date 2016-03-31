INSERT INTO Car (licenseNUM,type,color)
VALUES ('123abc','SUV', 'Black'),
  ('234abc', 'sedan', 'blue'),
  ('123bcd', 'truck', 'red'),
  ('234bcd', 'van', 'silver'),
  ('345cde', 'suv', 'white');

INSERT INTO Driver (email,password,phoneNum,firstName,lastName,licenseNum)
VALUES (123, 'abc@abc.com', 6041234567, 'Bryant', 'Kobe', 12345),
  ('bcd@abc.com', 'bcd', 6041234568, 'Russell', 'Bill', 23456),
  ('cde@abc.com', 'cde', 6041234569, 'Curry', 'Steph', 34567),
  ('def@abc.com', 'def', 6041234561, 'Lowry', 'Kyle', 45678),
  ('efg@abc.com', 'efg', 6041234562, 'James', 'LeBron', 56789);

INSERT INTO Passenger (email,password,phoneNum,firstName,lastName)
VALUES ('abc@abc.com', 'abc', 6041234567, 'Kobe', 'Bryant'),
  ('bcd@abc.com', 'bcd', 6041234568, 'Bill', 'Russell'),
  ('cde@abc.com', 'cde', 6041234569, 'Steph', 'Curry'),
  ('def@abc.com', 'def', 6041234561, 'Kyle', 'Lowry'),
  ('efg@abc.com', 'efg', 6041234562, 'LeBron', 'James');

INSERT INTO RideShare (destination, price, DID, address, postalCode, rdate, rtime, CDate, Ctime)
VALUES ('whistler', 10, 123, '523 Abbot Street', 'V7D4M0', '2/15/2016', '10:00 AM', '2/13/2016', '5:43 PM'),
  ('big white', 5, 234, '324 Abbot Street', 'V7D4M0', '2/16/2016', '6:00 AM', '2/13/2016', '5:40 PM'),
  ('revelstoke', 15, 345, '109 Spruce Street', 'V7D4B1', '2/17/2016', '9:00 AM', '2/14/2016', '1:20 AM'),
  ('whistler', 20, 456, '214 41st Ave', 'V7D4P4', '2/18/2016', '7:00 AM', '2/14/2016', '1:04 PM'),
  ('victoria', 10, 567, '1234 West Mall', 'V7D4S2', '2/19/2016', '9:00 AM', '2/11/2016', '2:30 AM');

INSERT INTO Participates (PID,RID, Type)
VALUES (567, 123, 'cash'),
(123, 123, 'cash'),
(345, 456, 'cash'),
(234, 456, 'PayPal'),
(456, 567, 'PayPal');









