<?php

function findMissandRepeat($arr)
{

    $freq = [];
    $repeating = null;
    $missing = [];


    $minVal = min($arr);
    $maxVal = max($arr);

    foreach ($arr as $num) {
        if (!isset($freq[$num])) {
            $freq[$num] = 0;
        }
        $freq[$num]++;
    }

    for ($i = $minVal; $i <= $maxVal; $i++) {
        if (!isset($freq[$i])) {
            $missing[] = $i;
        } elseif ($freq[$i] > 1) {
            $repeating = $i;
        }
    }

    return [$repeating, $missing];
}


$arr = [0, 1, 2, 2, 4, 9, 6];  // 3 and 5 are missing, 2 is repeating
list($repeating, $missing) = findMissandRepeat($arr);

echo "Repeating: " . $repeating . "\n";
echo "Missing: " . implode(', ', $missing) . "\n";




// $paing = new DateTime('20.6.2001');
// $mya = new DateTime('22.3.2001');

// if ($paing < $mya) {
//     echo "you are less than mya";
// } else {
//     echo "mya is greather than you";
// }

// $diff = $paing->diff($mya);

// echo $diff->format('Mya is %y year and %m and %d order than you');


class Car
{
    public $name;
    private $account;
    protected $familyName;


    public function driver()
    {
        echo "$this->name is dirver";
    }


    public static function dirve()
    {
        echo "Driving";
    }
    public static function testself()
    {
        self::dirve();
    }
    public static function teststatic()
    {
        static::dirve();
    }
}

class BMW extends Car
{
    public static function dirve()
    {
        echo "Smooth";
    }
}

$driver = new Car();
$driver->name = "paing";

$driver->driver();

BMW::testself();
BMW::teststatic();

//abstract class
abstract class Animal
{

    abstract public function makeSound();
    public function eat()
    {
        echo "Eating";
    }
}

final class Security
{
    public function encrypt($data)
    {
        //encrypt logic
    }
}

class Calculate
{
    private static $total = 0;

    public static function add($a, $b)
    {
        self::$total = $a + $b;
        return self::$total;
    }
    public static function getAll()
    {
        return self::$total;
    }
}

echo Calculate::add(3, 5);
echo Calculate::getAll();
echo "\n";

//magci construct
class dynamic
{
    private $result = [];

    public function __set($name, $value)
    {
        $this->result[$name] = $value;
    }

    public function __get($name)
    {
        return $this->result[$name] ?? null;
    }
}
$object = new dynamic();
$object->name = "paing";
$object->age = 24;
$object->work = "student";

echo $object->name;
echo $object->age;
echo $object->work;


// class bankAccount
// {
//     private string $owner;
//     private float $balance;

//     public function __construct(string $owner, float $balance)
//     {

//         $this->owner = $owner;
//         $this->balance = $balance;
//     }
//     public function getOwner()
//     {
//         return $this->owner;
//     }
//     public function getBalance()
//     {
//         if ($this->balance <= 0) {
//             echo "Your balance must greater 0";
//         } else {

//             return $this->balance;
//         }
//     }

//     public function deposit(float $amount)
//     {
//         if ($amount <= 0) {
//             echo "Your amount must be greater 0";
//         } else {

//             $this->balance += $amount;
//         }
//     }
//     public function withdraw(float $amount)
//     {
//         if ($amount > $this->balance) {
//             echo "you balance is insificent";
//         } else {

//             $this->balance -= $amount;
//         }
//     }
// }

// $bank = new bankAccount("paing", 2000);
// echo $bank->getOwner();
// echo $bank->getBalance();

// $bank->deposit(500);
// $bank->withdraw(300);

// echo $bank->getBalance();


class magic
{
    private $result = [];

    public function __set($name, $value)
    {
        $this->result[$name] = $value;
    }
    public function __get($name)
    {
        return $this->result[$name] ?? null;
    }
}

$mag = new magic();
$mag->age = 24;
$mag->name = ("Ko Paing");


class bankAccount
{
    public string $ownerName;
    public float $balance;

    public function __construct($ownerName, $balance)
    {
        $this->ownerName = $ownerName;
        $this->balance = $balance;
    }

    public function getOwner()
    {
        return $this->ownerName;
    }
    public function getBalance()
    {
        return $this->balance;
    }
    public function deposit($amount)
    {
        if ($amount <= 0) {
            echo "Your amount is low";
        } else {
            $this->balance += $amount;
        }
    }
    public function withdraw($amount)
    {
        if ($amount > $this->balance) {
            echo "Your main Balance is insurciffent";
        } else {
            $this->balance -= $amount;
        }
    }
}
class premium extends bankAccount
{
    private float $bonus = 0.5;

    public function addYearly()
    {
        $yearlybonus = $this->balance * $this->bonus;
        $this->balance += $yearlybonus;
    }
    public function display()
    {
        echo "$this->ownerName and $this->balance";
    }
}

$bank = new bankAccount("Kyaw", 2000);

echo $bank->getOwner();
echo $bank->getBalance();

$bank->deposit(500);
$bank->withdraw(100);
echo "\n";
$premium = new premium("kyaw", 1000);
$premium->deposit(100);
echo $premium->addYearly();
echo $premium->display();
echo "\n";
echo $bank->getBalance();
