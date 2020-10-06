<?php

namespace jonathanmarp\gowind;

session_start();

class Index {
    protected $arrayFile;
    protected $myFile;
    protected $location = "dummy/ip/get/provider/humman/Provider.bin";

    public function __construct()
    {
        $this->arrayFile = [];
        if(!file_exists($this->location))
        {
            $this->myFile = fopen($this->location, "w") or die("Unable to open file!");
            fclose($this->myFile);
        }
    }
    private function FileSize()
	{
		return filesize($this->location);
	}
    private function strigToBinary($string)
	{
	    $characters = str_split($string);
	 
	    $binary = [];
	    foreach ($characters as $character) {
	        $data = unpack('H*', $character);
	        $binary[] = base_convert($data[1], 16, 2);
	    }
	 
	    return implode(' ', $binary);    
    }
    private function binaryToString($binary)
	{
	    $binaries = explode(' ', $binary);
	 
	    $string = null;
	    foreach ($binaries as $binary) {
	        $string .= pack('H*', dechex(bindec($binary)));
	    }
	 
	    return $string;    
	}
    public function Read()
    {
        if(!$this->FileSize() == 0)
        {
            $this->myFile = fopen($this->location, "r") or die("Unable to open file!");
            $arr = fread($this->myFile, filesize($this->location));
            $arr = $this->binaryToString($arr);
            $arr = json_decode($arr, true);
            $this->arrayFile = $arr;
            fclose($this->myFile);
        }
    }
    private function GetIpAddres()
    {
        $ipaddress = getenv("REMOTE_ADDR");
        $ipaddress = base64_encode($ipaddress);
        $ipaddress = base64_encode($ipaddress);

        return $ipaddress;
    }
    public function writeToDatabase()
    {
        $ipaddress = $this->GetIpAddres();
        $ipaddress = $this->strigToBinary($ipaddress);
        $arr = [
            "ip" => $ipaddress
        ];
        $this->arrayFile[] = $arr;
        $arr = json_encode($this->arrayFile);
        $arr = $this->strigToBinary($arr);
        $this->myFile = fopen($this->location, "w") or die("Unable to open file!");
        fwrite($this->myFile, $arr);
        fclose($this->myFile);
    }
}

try {
    $mainIndex = new Index();
    $mainIndex->Read();
    $mainIndex->writeToDatabase();

    $_SESSION['GiveAccess'] = true;
  } catch(Exception $e) {
    $_SESSION['GiveAccess'] = false;
}

if(isset($_SESSION['GiveAccess']))
{
    if($_SESSION['GiveAccess'] == true)
    {
        header("Location: ./public");
    }
    if($_SESSION['GiveAccess'] == false)
    {
        header("Location: Error.php");
    }
} else {
    header("Location: Error.php");
}