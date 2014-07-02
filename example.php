<?php

include "./autoload.php";


$csvFactory = new Hone\Csv\Loader;

// As Associative Arrays
$csv = $csvFactory->load('./example.csv');

var_dump($csv);

// As Objects
$csvFactory->setType("asObject");

$csv = $csvFactory->load('./example.csv');

var_dump($csv);

class Address
{
    public function __construct($data)
    {

        foreach($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public function toJson()
    {

        return json_encode($this);
    }

}

// As objects
$csvFactory->setType("Address");

$csv = $csvFactory->load('./example.csv');

foreach($csv as $address) {
    echo $address->toJson();
}
