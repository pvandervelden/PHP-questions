<?php

class Person
{
    /* @var string */
    public $initials;

    /* @var string */
    public $firstname;

    /* @var string */
    public $middlename;

    /* @var string */
    public $lastname;

    /* @var DateTime */
    public $dateofbirth;

    /**
     * Person constructor.
     * @param string $initials
     * @param string $firstName
     * @param string $middleName
     * @param string $lastName
     * @param DateTime $dob
     */
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
$data[] = new Person('p', 'Pieter-Argibald', '', 'Puk', new DateTime('1989/02/01'));
$data[] = new Person('P', 'Petra', '', 'Puk', new DateTime('1992/02/01'));
$data[] = new Person('da', 'Allie', '', 'Hop', new DateTime('1989/01/02'));
$data[] = new Person('A', 'Alex', 'van den', 'Hopeloze', new DateTime('1980/04/02'));
$data[] = new Person('', 'Alexandra', 'van der', 'Merwe', new DateTime('1990/04/02'));
$data[] = new Person('PA', 'Pietje', '', 'Puk', new DateTime('1999/09/05'));
$data[] = new Person('A', 'Annet', 'van', 'Meer', new DateTime('1993/11/22'));

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


/*
 * =========
 * Oplossing
 * =========
 * 
 * Idee:
 * - array in 1x op 1 waarde sorteren, waarde gebaseerd op combinatie van achternaam, voornaam, initialen
 * - array geformatteerd afdrukken
 */

/**
 * @param Person $p
 * @return string
 */
function getSortableString(Person $p)
{
    return
        str_pad($p->lastname, 17, ' ') .
        str_pad($p->firstname, 22, ' ') .
        str_pad($p->initials, 12, ' ');
}

/**
 * @param Person $p
 * @param Person $q
 * @return int
 */
function comparePerson(Person $p, Person $q)
{
    return strcmp(getSortableString($p), getSortableString($q));
}

/**
 * @param String $s
 * @param int length
 * @return string
 */
function padLeft($s, $length) 
{
    return str_pad($s, $length, ' ', STR_PAD_LEFT);
}

/**
 * @param $s
 * @return string
 */
function formatInitials($s)
{
    return strtoupper(implode('', preg_replace('/(\w)/', '$1.', str_split($s))));
}

/**
 * @param Person $p
 * @return string
 */
function formatPerson(Person $p)
{
    $tpl = "| %s | %s | %s | %s | %s |";

    return sprintf(
        $tpl,
        padLeft(formatInitials($p->initials), 12),
        padLeft($p->firstname, 22),
        padLeft($p->middlename, 14),
        padLeft($p->lastname, 17),
        padLeft($p->dateofbirth->format('d-m-Y'), 14)
    );
}

/**
 * @param Person[] $data
 */
function printPersonData($data)
{
    $tpl = "| %s | %s | %s | %s | %s |";
    // header
    echo sprintf(
        $tpl,
        padLeft('initials', 12),
        padLeft('firstname', 22),
        padLeft('middlename', 14),
        padLeft('lastname', 17),
        padLeft('dateofbirth', 14)
    ) . PHP_EOL;
    // separator line
    echo str_repeat('-', 79+6+10) . PHP_EOL; // kolommen + scheidingstekens + spaties
    // persons
    foreach ($data as $p) {
        echo formatPerson($p) . PHP_EOL;
    }
}

// Uiteindelijke calls:

usort($data, 'comparePerson');
printPersonData($data);













