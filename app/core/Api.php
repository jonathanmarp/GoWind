<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

class Api {
	private $arrs;

	public function Registry($arr)
	{
		$arr = json_encode($arr);
		$arr = base64_encode($arr);
		$arr = $this->encrypt($arr);
		$arr = $this->strigToBinary($arr);

		$this->arrs = $arr;
	}
	public function ShowData()
	{
		echo $this->arrs;
	}
	public function Exec()
	{
		try {
			$this->arrs = $this->binaryToString($this->arrs);
			$this->arrs = $this->decrypt($this->arrs);
			$this->arrs = base64_decode($this->arrs);

			http_response_code(200);

			echo $this->arrs;
		} catch(Execption $e) {
			http_response_code(404);
			echo json_encode(
		        array("message" => "No products found.")
		    );
		}
	}
	private function encrypt($simple_string)
    {
        $options = 0;
        $ciphering = "AES-128-CTR";
        $encryption_iv = '1234567891011121';  
        $iv_length = openssl_cipher_iv_length($ciphering);
        $encryption_key = "qindfobwdjfb";
        $encryption = openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv);

        return $encryption; 
    }
    private function decrypt($encryption)
    {
        $options = 0;
        $ciphering = "AES-128-CTR";
        $decryption_iv = '1234567891011121';
        $iv_length = openssl_cipher_iv_length($ciphering);
        $decryption_key = "qindfobwdjfb";
        $decryption = openssl_decrypt ($encryption, $ciphering, $decryption_key, $options, $decryption_iv);

        return $decryption;
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
}
