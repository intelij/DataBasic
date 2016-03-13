<!-- Utility PHP -->
<!-- Based off of https://netbeans.org/kb/docs/php/wish-list-lesson2.html -->


<?php
class RideshareDB extends mysqli {

// single instance of self shared among all instances
    private static $instance = null;
    // db connection config vars
    private $user = "DataBasicTeam";
    private $pass = "CPSC304!";
    private $dbName = "DataBasic";
    private $dbHost = "databasic.cvhyllwoxxb3.us-west-1.rds.amazonaws.com";


    //This method must be static, and must return an instance of the object if the object
    //does not already exist.
    public static function getInstance() {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    // The clone and wakeup methods prevents external instantiation of copies of the Singleton class,
    // thus eliminating the possibility of duplicate objects.
    public function __clone() {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

    public function __wakeup() {
        trigger_error('Deserializing is not allowed.', E_USER_ERROR);
    }

    // private constructor
    private function __construct() {
        parent::__construct($this->dbHost, $this->user, $this->pass, $this->dbName);
        if (mysqli_connect_error()) {
            exit('Connect Error (' . mysqli_connect_errno() . ') '
                . mysqli_connect_error());
        }
        parent::set_charset('utf-8');
    }

    public function verify_user_credentials($name, $password) {
        $name = $this->real_escape_string($name);
        $password = $this->real_escape_string($password);
        $result = $this->query("SELECT 1 FROM wishers WHERE name = '"
            . $name . "' AND password = '" . $password . "'");
        return $result->data_seek(0);
    }



}