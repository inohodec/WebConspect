<?php
class Vehicle {
    public $color;
    public $speed;
    public $bramd;
    public $distance;

    public function tripTime($distance)
    {
        $this->distance = $distance;
        $time = $this->distance / $this->speed;
        return $time;
    }
}

class Car extends Vehicle {
    public $fuel;
    public $color = "Scarlet";

    public function consumption()
    {
        $result = $this->fuel * $this->distance / 100;
        return $result;
    }
}

class Bicycle extends Vehicle {
    public $color = "Yellow/Red";
    public $type;
    const CALORIES_PER_HOUR = 500;

    public function tripTime($distance)
    {
        $time = parent::tripTime($distance) * 1.2;
        return $time;
    }

    public function caloriesBurned()
    {
        return $this->distance * self::CALORIES_PER_HOUR;

    }
}

class Skate extends Vehicle {

}

$car1 = new Car();
$car1->speed = 56;
$car1->fuel = 12;

$car2 = new Car();
$car2->speed = 75;
$car2->fuel = 8;

$bike = new Bicycle();
$bike->speed = 20;

echo "First car will arrive in ".$car1->tripTime(250)." hours<br>";
echo "and consume ".$car1->consumption()."L<hr>";


echo "Second car will arrive in ".$car2->tripTime(250)." hours<br>";
echo "and consume ".$car2->consumption()."L<hr>";


echo "Bike will arrive in ".$bike->tripTime(250)." hours<br> and you burn: ".$bike->caloriesBurned()." cal";

