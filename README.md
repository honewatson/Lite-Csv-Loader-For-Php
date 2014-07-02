Lite Csv Loader For Php Hone.Csv
================================


```php
<?php

include "./autoload.php";


$csvFactory = new Hone\Csv\Loader;

// As Associative Arrays
$csv = $csvFactory->load('./example.csv');

var_dump($csv);
```

```
array(2) {
  [0]=>
  array(8) {
    ["TransactionNumber"]=>
    string(9) "100000001"
    ["Name"]=>
    string(15) "Winnie The Pooh"
    ["Add1"]=>
    string(17) "100 Cheesy Street"
    ["Add2"]=>
    string(0) ""
    ["Town"]=>
    string(6) "Sydney"
    ["Add4"]=>
    string(10) "Queensland"
    ["Postcode"]=>
    string(4) "3000"
    ["Telephone"]=>
    string(8) "95649564"
  }
  [1]=>
  array(8) {
    ["TransactionNumber"]=>
    string(9) "100000002"
    ["Name"]=>
    string(6) "Tigger"
    ["Add1"]=>
    string(14) "100 Pizza Road"
    ["Add2"]=>
    string(0) ""
    ["Town"]=>
    string(6) "Sydney"
    ["Add4"]=>
    string(10) "Queensland"
    ["Postcode"]=>
    string(4) "3000"
    ["Telephone"]=>
    string(8) "95649564"
  }
}
```

```php

// As Objects
$csvFactory->setType("asObject");

$csv = $csvFactory->load('./example.csv');

var_dump($csv);
```

```
array(2) {
  [0]=>
  object(stdClass)#4 (8) {
    ["TransactionNumber"]=>
    string(9) "100000001"
    ["Name"]=>
    string(15) "Winnie The Pooh"
    ["Add1"]=>
    string(17) "100 Cheesy Street"
    ["Add2"]=>
    string(0) ""
    ["Town"]=>
    string(6) "Sydney"
    ["Add4"]=>
    string(10) "Queensland"
    ["Postcode"]=>
    string(4) "3000"
    ["Telephone"]=>
    string(8) "95649564"
  }
  [1]=>
  object(stdClass)#5 (8) {
    ["TransactionNumber"]=>
    string(9) "100000002"
    ["Name"]=>
    string(6) "Tigger"
    ["Add1"]=>
    string(14) "100 Pizza Road"
    ["Add2"]=>
    string(0) ""
    ["Town"]=>
    string(6) "Sydney"
    ["Add4"]=>
    string(10) "Queensland"
    ["Postcode"]=>
    string(4) "3000"
    ["Telephone"]=>
    string(8) "95649564"
  }
}
```

```php

// As objects from class

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

$csvFactory->setType("Address");

$csv = $csvFactory->load('./example.csv');

foreach($csv as $address) {
    echo $address->toJson();
}
```

```
array(2) {
  [0]=>
  object(Address)#6 (8) {
    ["TransactionNumber"]=>
    string(9) "100000001"
    ["Name"]=>
    string(15) "Winnie The Pooh"
    ["Add1"]=>
    string(17) "100 Cheesy Street"
    ["Add2"]=>
    string(0) ""
    ["Town"]=>
    string(6) "Sydney"
    ["Add4"]=>
    string(10) "Queensland"
    ["Postcode"]=>
    string(4) "3000"
    ["Telephone"]=>
    string(8) "95649564"
  }
  [1]=>
  object(Address)#7 (8) {
    ["TransactionNumber"]=>
    string(9) "100000002"
    ["Name"]=>
    string(6) "Tigger"
    ["Add1"]=>
    string(14) "100 Pizza Road"
    ["Add2"]=>
    string(0) ""
    ["Town"]=>
    string(6) "Sydney"
    ["Add4"]=>
    string(10) "Queensland"
    ["Postcode"]=>
    string(4) "3000"
    ["Telephone"]=>
    string(8) "95649564"
  }
}
{"TransactionNumber":"100000001","Name":"Winnie The Pooh","Add1":"100 Cheesy Street","Add2":"","Town":"Sydney","Add4":"Queensland","Postcode":"3000","Telephone":"95649564"}{"TransactionNumber":"100000002","Name":"Tigger","Add1":"100 Pizza Road","Add2":"","Town":"Sydney","Add4":"Queensland","Postcode":"3000","Telephone":"95649564"}
```