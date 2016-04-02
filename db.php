<?php
class RideshareDB extends mysqli
{

// single instance of self shared among all instances
    private static $instance = null;
    // db connection config vars
    private $user = "DataBasicTeam";
    private $pass = "CPSC304!";
    private $dbName = "DataBasic";
    private $dbHost = "databasic.cvhyllwoxxb3.us-west-1.rds.amazonaws.com";


    //This method must be static, and must return an instance of the object if the object
    //does not already exist.
    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    // The clone and wakeup methods prevents external instantiation of copies of the Singleton class,
    // thus eliminating the possibility of duplicate objects.
    public function __clone()
    {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

    public function __wakeup()
    {
        trigger_error('Deserializing is not allowed.', E_USER_ERROR);
    }

    // private constructor
    public function __construct()
    {
        parent::__construct($this->dbHost, $this->user, $this->pass, $this->dbName);
        if (mysqli_connect_error()) {
            exit('Connect Error (' . mysqli_connect_errno() . ') '
                . mysqli_connect_error());
        }
        parent::set_charset('utf-8');
    }

    public function get_driver_id_by_name($name) {
        $name = $this->real_escape_string($name);
        $driverID = $this->query("SELECT DID FROM Driver WHERE name = '"
            . $name . "'");
        return $driverID;
    }

    public function get_passenger_id_by_name($name) {
        $name = $this->real_escape_string($name);
        $passengerID = $this->query("SELECT PID FROM Passenger WHERE name = '"
            . $name . "'");
        return $passengerID;
    }

    //TRUE(1) is Passenger
    //FALSE(0) is Driver
    public function get_user_type($name){
        $name = $this->real_escape_string($name);

        $result = $this->query("SELECT 1 FROM Passenger WHERE name = '"
            . $name . "'");
        return $result->data_seek(0);
    }

    public function verify_user_credentials($name, $password)
    {
        $name = $this->real_escape_string($name);
        $password = $this->real_escape_string($password);

        $result = $this->query("SELECT 1 FROM Driver WHERE name = '"
            . $name . "' AND password = '" . $password . "'");

        if($result->data_seek(0) == FALSE) {
            $result = $this->query("SELECT 1 FROM Passenger WHERE name = '"
                . $name . "' AND password = '" . $password . "'");
            return $result->data_seek(0);
        }

        return $result->data_seek(0);
    }

    public function insert_car($licenseNum, $type, $color)
    {
        $licenseNum = $this->real_escape_string($licenseNum);
        $type = $this->real_escape_string($type);
        $color = $this->real_escape_string($color);

        $this->query("INSERT INTO Car (licenseNum, type, color)" .
            " VALUES ('" . $licenseNum . "', '" . $type. "', '" .$color."')");
    }

    public function create_driver($name, $email, $phoneNum, $password, $licenseNum) {
        $name = $this->real_escape_string($name);
        $email = $this->real_escape_string($email);
        $phoneNum = $this->real_escape_string($phoneNum);
        $licenseNum = $this->real_escape_string($licenseNum);
        $password = $this->real_escape_string($password);

        $this->query("INSERT INTO Driver (name, email, phoneNum, password, licenseNum)" .
        "VALUES ('" . $name . "',
         '" . $email . "',
         '" . $phoneNum . "',
         '" . $licenseNum . "',
         '" . $password . "'
         )");
    }

    public function create_passenger($name, $email, $phoneNum, $password){
        $name = $this->real_escape_string($name);
        $email = $this->real_escape_string($email);
        $phoneNum = $this->real_escape_string($phoneNum);
        $password = $this->real_escape_string($password);

        $this->query("INSERT INTO Passenger (name, email, phoneNum, password)" .
            "VALUES ('" . $name . "',
         '" . $email . "',
         '" . $phoneNum . "',
         '" . $password . "'
         )");


    }

    function format_date_for_sql($date){
        if ($date == "")
            return null;
        else {
            $dateParts = date_parse($date);
            return $dateParts["year"]*10000 + $dateParts["month"]*100 + $dateParts["day"];
        }

    }

    public function create_participates($PID, $RID, $Type){

        $PID = $this->real_escape_string($PID);
        $RID = $this->real_escape_string($RID);
        $Type = $this->real_escape_string($Type);

        $this->query("INSERT INTO Participates (PID, RID, Type)" .
            "VALUES (" . $PID . ",
         " . $RID . ",
         " . $Type . "
         )");



    }


    public function create_rideshare($DID, $destination, $price, $address, $postalCode, $province,
                                     $city, $rdate, $rtime, $Ctime, $CDate,$seats,$seatsLeft){
        //initialize variables
        $RID = $this->real_escape_string($RID);
        $DID = $this->real_escape_string($DID);
        $destination = $this->real_escape_string($destination);
        $price = $this->real_escape_string($price);
        $address = $this->real_escape_string($address);
        $postalCode = $this->real_escape_string($postalCode);
        $province = $this->real_escape_string($province);
        $city = $this->real_escape_string($city);
        $rdate = $this->real_escape_string($rdate);
        $rdate = $this->format_date_for_sql($rdate);
        $rtime = $this->real_escape_string($rtime);
        $Ctime = $this->real_escape_string($Ctime);
        $CDate = $this->real_escape_string($CDate);
        $CDate = $this->format_date_for_sql($CDate);
        $seats = $this->real_escape_string($seats);
        $seatsLeft = $this->real_escape_string($seatsLeft);

        $this->query("INSERT INTO RideShare (DID,  postalCode, destination, address, price, rdate, rtime, Ctime, CDate, seats, seatsLeft)" .
            " VALUES ( " . $DID . ",
             " . $postalCode .", " . $destination . ",
             " . $address . "," . $price . ",
             " . $rdate . "," . $rtime .",
             " . $Ctime . ", " . $CDate . ",
             " . $seats . ", " . $seatsLeft .")");

        $this->query("INSERT INTO Location (postalCode, city, province)" . " VALUES(" . $postalCode . ", " . $city . ", " . $province . ")");

    }

    public function get_available_rideshares(){
        return $this->query("SELECT rdate, name, destination, price, seats, seatsLeft, RID
                  FROM RideShare R, Driver D
                  WHERE R.DID = D.DID AND seatsLeft > 0 AND R.rdate >= curdate() /*AND r.rtime >= cast(gettime() as time)*/");
    }

    public function get_rideshare_byid($RID){
        return $this->query("SELECT rdate, name, destination, price, seats, seatsLeft, RID
                  FROM RideShare R, Driver D
                  WHERE R.RID = $RID AND R.DID = D.DID AND seatsLeft > 0 AND R.rdate >= curdate() /*AND r.rtime >= cast(gettime() as time)*/");
    }

    public function get_current_drivers_rideshares($driverID){
        return $this->query("SELECT rdate, destination, price, seats, seatsLeft
                  FROM RideShare R, Driver D
                  WHERE $driverID = D.DID AND R.DID = D.DID AND R.rdate >= curdate()");
    }

    public function get_past_drivers_rideshares($driverID){
        return $this->query("SELECT rdate, destination, price, seats, seatsLeft
                  FROM RideShare R, Driver D
                  WHERE $driverID = D.DID AND R.DID = D.DID AND R.rdate < curdate()");
    }

    public function get_rideshare_transactions($rideShareID){
        return $this->query("SELECT P.name, type, price
                            FROM RideShare R, Participates Pa, Passenger P
                            WHERE R.RID = $rideShareID AND R.RID = P.RID AND P.PID = Pa.PID ");
    }

    public function get_current_passengers_rideshares($passengerID){
    return $this->query("SELECT rdate, destination, price, seatsLeft
                  FROM RideShare R, Driver D, Participates Pa
                  WHERE $passengerID = P.PID AND P.PID = Pa.PID AND R.RID = Pa.RID AND R.rdate >= curdate()");
    }

    public function get_past_passengers_rideshares($passengerID){
        return $this->query("SELECT rdate, destination, price
                  FROM RideShare R, Passenger P, Participates Pa
                  WHERE $passengerID = P.PID AND P.PID = Pa.PID AND R.RID = Pa.RID AND R.rdate < curdate()");
    }

}