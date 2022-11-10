<?php
// CSci 130 - Web Programming

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

// Class for the person, student, and faculty
abstract class Person {
	
	private $first_name;
	private $last_name;
	protected $dob;
	public $address;

	public function GetFirstName() {
		return $this->first_name; 
	}

	public function GetLastName() {
		return $this->last_name;
	}

	public function SetFirstName($fn) {
		$this->first_name=$fn;
	}

	public function SetLastName($ln) {
		$this->last_name=$ln;
	}
		
	public function GetDOB() {
		return $this->dob;
	}

	public function SetDOB($d) {
		$this->dob=$d;
	}
	
	public function GetAge() {
		$bday=date_parse($this->dob);
		$today = getdate();
		//$interval = date_diff($today,$bday);
		$b_y = $bday['year'];
		$b_m = $bday['month'];
		$b_d = $bday['day'];		
		$t_y = $today['year'];
		$t_m = $today['month'];
		$t_d = $today['mday']; // day in the month
		if (($b_d<$t_d) && ($b_m<=$t_m) && ($t_y==$b_y) ) 
			return $t_y-$b_y-1;
		else
			return $t_y-$b_y;
		// In PHP.ini , for Apache 
		// change to date.timezone=America/Los_Angeles
		// then restart the server !
	}
	abstract public function Display();
	// no need to create get/set functions for address as it is public
}

class Student extends Person implements JsonSerializable {
	private $id;
	private $current_gpa;
	public $current_units;
	
	public function __construct() { // the constructor has an input
	/*   
    $this->SetFirstName("unknown");
	$this->SetLastName("unknown");
	$this->address="Shaw Ave, Fresno, CA 93740";
	$this->dob="1952-03-21"; // Use this format to avoid issues to compute the date
    $this ->id = 0;
	$this ->current_gpa =3;
	$this ->current_units =20;
	*/
	
	$this->SetFirstName(generateRandomString());
	$this->SetLastName(generateRandomString());
	$this->address=generateRandomString(20);
	$this->dob="19". strval(rand(50,99)) ."-". strval(rand(1,12)) ."-". strval(rand(1,28))  ; // Use this format to avoid issues to compute the date
    $this ->id = 10000+strval(rand(0,500));
	$this ->current_gpa =strval(rand(1,4));
	$this ->current_units =strval(rand(3,60));
   }
	
	public function GetID() {
		return $this->id;
	}
	public function SetID($id) {
		$this->id=$id;
	}
	
	public function GetGPA() {
		return $this->current_gpa;
	}
	
	public function SetGPA($gpa) {
		if ($gpa<0)
			$this->current_gpa=0;
		else if ($gpa>4)
			$this->current_gpa=4;
		else
			$this->current_gpa=$gpa;
	}
	
	// Object to String
	public function jsonSerialize() {
        return [
            'first_name' => $this->GetFirstName(),
			'last_name' => $this->GetLastName(),
            'dob' => $this->dob,
			'address' => $this->address,
			'id' => $this->id,
 			'current_gpa' => $this->current_gpa,
			'current_units' => $this->current_units
            ];
    }
	
	// Std Object -> Student Object
	public function Set($json)
	{
		$s1=$json['first_name'];
		$s2=$json['last_name'];
		$s3=$json['dob'];
		$s4=$json['address'];
		$s5=$json['id'];
		$s6=$json['current_units'];
		$s7=$json['current_gpa'];
		
		//echo $s1 .'   '. $s2;
		$this->SetFirstName($s1);
		$this->SetLastName($s2);
		$this->SetDOB($s3);
		$this->address=$s4;
		$this->SetID($s5);
		$this->current_units=$s6;
		$this->SetGPA($s7);
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