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

class House implements JsonSerializable{
    // the movie id is set to the pkey from mysql
    public $Index;
    public $LivingSpace;
    public $Beds;
    public $Baths;
    public $Zip;
    
  
    public function __construct(){
        $this->Index = strval(10);
        $this->LivingSpace = strval(10); 
        $this->Beds = strval(30); //int or str
        $this->Baths = strval(10); 
        $this->Zip = strval(10); 
    }

    // obj to str
    public function jsonSerialize() {
        return [
            'Index' => $this->Index,
            'LivingSpace' => $this->LivingSpace,
            'Beds' => $this->Beds,
            'Baths' => $this->Baths,
            'Zip' => $this->Baths
            ];
    }
    
    // std obj -> movie Object
    public function Set($json){
        $this->Index=$json['Index'];
        $this->LivingSpace=$json['LivingSpace'];
        $this->Beds=$json['Beds'];
        $this->Baths=$json['Baths'];
        $this->Baths=$json['Zip'];
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