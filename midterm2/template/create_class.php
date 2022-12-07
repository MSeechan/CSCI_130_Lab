<?php
function generateRandomString($length = 10) {
	// list of characters that can be present in the string
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

class NewClass implements JsonSerializable{
    // the movie id is set to the pkey from mysql
    public $col1;
    public $col2;
    public $col3;
    public $id;
  

    public function __construct(){
        $this->col1 = generateRandomString();
        $this->col2 = strval(10); 
        $this->col3 = strval(30); //int or str
        $this->id = strval(10); 
    }

    // obj to str
    public function jsonSerialize() {
        return [
            'col1' => $this->col1,
            'col2' => $this->col2,
            'col3' => $this->col3,
            'id' => $this->id,
            ];
    }
    
    // std obj -> movie Object
    public function Set($json){
        $this->col1=$json['col1'];
        $this->col2=$json['col2'];
        $this->col3=$json['col3'];
        $this->id=$json['id'];
    }

    public function Display() {
        $v=json_encode($this);
        echo $v;
    }
    
    public function GetString() {
        return json_encode($this);
    }
}
?>