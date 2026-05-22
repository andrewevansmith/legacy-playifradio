<?php 

abstract class Model {

    public $db;
    protected $encryptor;

    final public function __construct() 
    {
        $this->db = Database::get_instance();
        $this->encryptor = new Encryptor;
    }
/*
    final public function get_value($member) 
    {
        if (isset($this->$member))
           return $this->$member; 
        die("Tried to access invalid variable $member");
    }
    */

    final private function set_value($member, $value)
    {
        $this->$member = $value;
        return;
    }

}
