<?php

class Encryptor {

    private $hash;
    private $salt;
    private $method;
    private $iv;

    function __construct()
    {
        $this->method = "AES-256-CBC";
        $this->hash = "25c6c7ff35b9979b151f2136cd13b0ff"; 
        $this->iv = "23523654";
        if (CRYPT_BLOWFISH) $this->salt = '$2a$07$usedomepialfsdxidsforsalt$';
        else $this->salt = "r1";
    }

    public function hash($str)
    {
        return crypt($str, $this->salt); 
    }

    public function encrypt($str)
    {
        return openssl_encrypt($str, $this->method, $this->has, $this->iv);
    }

    public function decrypt($str)
    {
        return openssl_decrypt($str, $this->method, $this->hash, $this->iv);
    }
}
