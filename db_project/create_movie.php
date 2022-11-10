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


class Movie implements JsonSerializable{
    public $title;
    public $year;
    public $length;
    public $rating;
    public $synopsis;
    public $recommended;
    public $movie_id;

    public function __construct(){
        $this->title = generateRandomString();
        $this->year = generateRandomString();
        $this->length = generateRandomString();
        $this->rating = generateRandomString();
        $this ->synopsis = generateRandomString();
        $this ->recommended = generateRandomString();
        $this ->movie_id = generateRandomString();
        // $this->title = generateRandomString();
        // $this->year = strval(rand(1990,2007));
        // $this->length = generateRandomString();
        // $this->rating =  10000+strval(rand(0,500));
        // $this ->synopsis = generateRandomString();
        // $this ->recommended = True;
        // $this ->movie_id = strval(rand(1,6));
     
    }

    public function jsonSerialize() {
        return [
            'title' => $this->title,
            'year' => $this->year,
            'length' => $this->length,
            'rating' => $this->rating,
            'synopsis' => $this->synopsis,
            'recommended' => $this->recommended,
            'movie_id' => $this->movie_id
            ];
    }
    
    // Std Object -> Student Object
    public function Set($json)
    {
        $this->title=$json['title'];
        $this->year=$json['year'];
        $this->length=$json['length'];
        $this->rating=$json['rating'];
        $this->synopsis=$json['synopsis'];
        $this->recommended=$json['recommended'];
        $this->movie_id=$json['movie_id'];
        
        // //echo $s1 .'   '. $s2;
        // $this->SetTitle($this->title);
        // $this->SetYear($this->year);
        // $this->SetLength($this->length);
        // $this->SetRating($this->rating);
        // $this->SetSynopsis($this->synopsis);
        // $this->SetRecommended($this->recommended)
        // $this->setMovie_id($this->movie_id);
      
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