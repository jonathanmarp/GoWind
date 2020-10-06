<?php

class VanDB {
	protected $nameFile;
	protected $myFile;
	protected $sizeFile;
	protected $arrayFile = [];

	public function __construct($nameFile)
	{
		$this->nameFile = "../app/database/" . $nameFile;
		if (!file_exists($this->nameFile))  
		{
			$this->myFile = fopen($this->nameFile, 'w') or die('Cannot open file:  ' . $this->nameFile);
			fclose($this->myFile);
		} else {
			$this->FileSize();
			if($this->sizeFile > 1)
			{
				$this->ReadData();
			}
		}
	}

	private function FileSize()
	{
		$this->sizeFile = filesize($this->nameFile);
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

	private function WriteData()
	{
		$this->myFile = fopen($this->nameFile, 'w') or die('Cannot open file:  ' . $this->nameFile);
		$data = json_encode($this->arrayFile, true);
		$data = base64_encode($data);
		$data = $this->strigToBinary($data);
		fwrite($this->myFile, $data);
		fclose($this->myFile);	
	}

	private function ReadData()
	{
		$this->myFile = fopen($this->nameFile, 'r') or die('Cannot open file:  ' . $this->nameFile);
		$dataBuffer = fread($this->myFile, filesize($this->nameFile));
		$dataBuffer = $this->binaryToString($dataBuffer);
		$dataBuffer = base64_decode($dataBuffer);
		$dataBuffer = json_decode($dataBuffer, true);

		$this->arrayFile = $dataBuffer;
		fclose($this->myFile);
	}

	private function Read()
	{
		$this->ReadData();
	}

	private function MathKey()
	{
		error_reporting(E_ERROR | E_PARSE);
		$id = 0;

		$this->myFile = fopen($this->nameFile, 'r') or die('Cannot open file:  ' . $this->nameFile);

		$dataBuffer = fread($this->myFile, filesize($this->nameFile));
		$dataBuffer = $this->binaryToString($dataBuffer);
		$dataBuffer = base64_decode($dataBuffer);
		$dataBuffer = json_decode($dataBuffer, true);

		$id = intval(count($this->arrayFile) / sizeof($this->myFile));

		fclose($this->myFile);
		error_reporting(E_ALL);

		return $id;
	}

	public function Registry($name, $title, $descrypt, $time)
	{
		// Change This { Parameter And Array }

		$arr = [
			"id" => $this->MathKey(), // Dont Remove This Part
			"name" => $name,
			"Title" => $title,
			"Descrypt" => $descrypt,
			"Time" => $time
		];
		$this->arrayFile[] = $arr;
	}


	public function Exec()
	{
		$this->WriteData();
		$this->Read();
	}

	public function Delete($id)
	{
		unset($this->arrayFile[$id]);
	}
	public function GetDataBase()
	{
		$this->Read();
		return $this->arrayFile;
	}
	public function Set($id, $name, $title, $descrypt, $time)
	{
		$arr = [
			"id" => $this->MathKey(), // Dont Remove This Part
			"name" => $name,
			"Title" => $title,
			"Descrypt" => $descrypt,
			"Time" => $time
		];
		$this->arrayFile[$id] = $arr;	
	}

}