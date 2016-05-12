<?php

class Person { 
	public $initials;
	public $firstname;
	public $middlename;
	public $lastname;
	public $dateofbirth;
	
	public function __construct($initials = '', $firstName = '', $middleName = '', $lastName = '', $dob = null) 
	{
    	$this->initials = $initials;
		$this->firstname = $firstName;
		$this->middlename = $middleName;
		$this->lastname = $lastName;
		$this->dateofbirth = $dob;
	}
}

$data = [];
$data[] = new Person('p','Pieter-Argibald','','Puk', new DateTime('1989/02/01'));
$data[] = new Person('P','Petra','','Puk', new DateTime('1992/02/01'));
$data[] = new Person('da','Allie','','Hop', new DateTime('1989/01/02'));
$data[] = new Person('A','Alex','van den','Hopeloze', new DateTime('1980/04/02'));
$data[] = new Person('','Alexandra','van der','Merwe', new DateTime('1990/04/02'));
$data[] = new Person('PA','Pietje','','Puk', new DateTime('1999/09/05'));
$data[] = new Person('A','Annet','van','Meer', new DateTime('1993/11/22'));

/* 
  We willen een *NETJES GEFORMATTEERD* overzicht afdrukken van de records in $data 
  
  Vereisten aan het overzicht:
     - het overzicht is gesorteerd op Achternaam, Voornaam, Voorletters
	 - Er dienen kolomkoppen te worden afgedrukt ( en een scheidingsregel hieronder )
	 - de kolommen zijn voldoende groot, en alle data is rechts uitgelijnd
	 	- Initialen 	=> Kolombreedte 12 tekens, elke letter gevolgd door een . en in hoofdletters
	 	- Voornaam  	=> Kolombreedte 22 tekens
		- Tussenvoegsel => Kolombreedte 14 tekens
		- Achternaam	=> Kolombreedte 17 tekens
		- Geboortedatum => Kolombreedte 14 tekens, formaat dd-mm-yyyy
	- de kolommen hebben een spatie aan het begin en het eind van de kolom (deze zijn meegerekend in de kolombreedte)
	

hint: 
	- (s)printf
	- strtoupper
	- preg_replace of str_split / join [ Let op de werking van join ]

hint 2: 
	Bij interpunctie van initialen, rekening houden met het feit dat alle initialen een punt moeten krijgen. 
	Als er geen initialen zijn, dan mag er ook geen punt staan.

Success!

*/

