<?php
    class Car
    {
        private $make_model;
        private $price;
        private $miles;
        private $car_pic;

        function __construct($car_make_model, $car_price, $car_miles, $car_image)
        {
            $this->make_model = $car_make_model;
            $this->price = $car_price;
            $this->miles = $car_miles;
            $this->car_pic = $car_image;
        }
        function setCarPic($new_image)
        {
          $this->car_pic = $new_image;
        }
        function getCarPic()
        {
          return $this->car_pic;
        }
        function setMakeModel($new_make_model)
        {
          $this->make_model = $new_make_model;
        }

        function getMakeModel()
        {
          return $this->make_model;
        }

        function setPrice($new_price)
        {
            $float_price = (float) $new_price;
            if ($float_price != 0) {
              $formatted_price = number_format($float_price, 2);
              $this->price = $formatted_price;
            }
        }

        function getPrice()
        {
            return $this->price;
        }

        function setMiles($new_miles)
        {
            $this->miles = $new_miles;
        }

        function getMiles()
        {
            return $this->miles;
        }

    }
?>
