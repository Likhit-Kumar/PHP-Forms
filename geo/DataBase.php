<?php
require "DataBaseConfig.php";

class DataBase
{
    public $connect;
    public $data;
    private $sql;
    protected $servername;
    protected $username;
    protected $password;
    protected $databasename;

    public function __construct()
    {
        $this->connect = null;
        $this->data = null;
        $this->sql = null;
        $dbc = new DataBaseConfig();
        $this->servername = $dbc->servername;
        $this->username = $dbc->username;
        $this->password = $dbc->password;
        $this->databasename = $dbc->databasename;
    }

    function dbConnect()
    {
        $this->connect = mysqli_connect($this->servername, $this->username, $this->password, $this->databasename);
        return $this->connect;
    }

    function prepareData($data)
    {
        return mysqli_real_escape_string($this->connect, stripslashes(htmlspecialchars($data)));
    }

    function geo($table, $latitude, $longitude, $address, $locality, $country, $ImageName, $EmpDate)
    {
	$latitude = $this->prepareData($latitude);
        $longitude = $this->prepareData($longitude);
        $address = $this->prepareData($address);
        $locality = $this->prepareData($locality);
	$country = $this->prepareData($country);
	$ImageName = $this->prepareData($ImageName);
	$EmpDate = $this->prepareData($EmpDate);
	
	$this->sql = "UPDATE " . $table . " SET latitude = '" .$latitude. "', longitude = '" .$longitude. "', address = '" .$address. "', locality = '" .$locality. "', country = '" .$country. "', date_of_attd = NOW(), status = 'present' WHERE image_name = '" . $ImageName . "' ";
        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else return false;
   }

    function status($table, $image_name)
    {
        $imageName = $this->prepareData($image_name);

        $this->sql = "select * from " . $table . " where image_name = '" . $imageName . "'";
        
	$result = mysqli_query($this->connect, $this->sql);
        $row = mysqli_fetch_assoc($result);

        if (mysqli_num_rows($result) != 0) {
            $dbimgName = $row['image_name'];
            if ($dbimgName == $imageName) {
                $status = true;
            } else $status = false;
        } else $status = false;

        return $status;
   }

}

?>
