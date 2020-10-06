<?php

class Controller {
    public function view($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }
    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model;
    }
    public function encrypt($simple_string)
    {
        $options = 0;
        $ciphering = "AES-128-CTR";
        $encryption_iv = '1234567891011121';  
        $iv_length = openssl_cipher_iv_length($ciphering);
        $encryption_key = "qindfobwdjfb";
        $encryption = openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv);

        return $encryption; 
    }
    public function decrypt($encryption)
    {
        $options = 0;
        $ciphering = "AES-128-CTR";
        $decryption_iv = '1234567891011121';
        $iv_length = openssl_cipher_iv_length($ciphering);
        $decryption_key = "qindfobwdjfb";
        $decryption = openssl_decrypt ($encryption, $ciphering, $decryption_key, $options, $decryption_iv);

        return $decryption;
    }
}