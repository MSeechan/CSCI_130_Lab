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
    public $img_path;


    public function __construct(){
        $this->title = generateRandomString();
        $this->year = strval(rand(1980,2010));
        $this->length = generateRandomString();
        $this->rating = strval(rand(0, 10));
        $this ->synopsis = generateRandomString();
        $this ->recommended = TRUE;
        $this ->movie_id = strval(10);
        $this ->img_path = strval(100);
    }

    // obj to str
    public function jsonSerialize() {
        return [
            'title' => $this->title,
            'year' => $this->year,
            'length' => $this->length,
            'rating' => $this->rating,
            'synopsis' => $this->synopsis,
            'recommended' => $this->recommended,
            'movie_id' => $this->movie_id,
            'img_path' => $this->img_path
            ];
    }
    
    // std obj -> movie Object
    public function Set($json){
        $this->title=$json['title'];
        $this->year=$json['year'];
        $this->length=$json['length'];
        $this->rating=$json['rating'];
        $this->synopsis=$json['synopsis'];
        $this->recommended=$json['recommended'];
        $this->movie_id=$json['movie_id'];
        $this->img_path=$json['img_path'];
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