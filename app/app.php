<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/car.php";

    $app = new Silex\Application();

    $app->get("/", function() {
      return '<!DOCTYPE html>
      <html>
        <head>
          <link href="css/bootstrap.css" type="text/css" rel="stylesheet">
          <link href="css/styles.css" type="text/css" rel="stylesheet">
          <title>Car Dealer</title>
        </head>
        <body>
          <div class="container">
            <h1>Search our inventory</h1>
            <form id="userInput" action="/car">
              <div class="form-group">
                <label for="priceInput">What is your max price?</label>
                <input id="priceInput" name="priceInput" class="form-control" type="number">
              </div>
              <div class="form-group">
                <label for="milageInput">What is your max milage?</label>
                <input id="milageInput" name="milageInput" class="form-control" type="number">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-default">Show me cars!</button>
              </div>
            </form>
        </body>
      </html>';
    });
    $app->get("/car", function() {
      $first_car = new Car("2014 Porshe 911", "114220", "7622", "img/car1.jpeg");
      $second_car = new Car("2011 Ford F350", "12333", "44223", "img/car2.jpeg");
      $third_car = new Car("2013 Lexus RX 350", "44700", "20000", "img/car3.jpeg");
      $fourth_car = new Car("Mercedes Benz CLS550", "39900", "37989", "img/car4.jpeg");
      $first_car->setMakeModel("2003 Kia Sportage");
      $third_car->setPrice("10023.032456");
      $second_car->setMiles("123.734");

      $cars = array($first_car, $second_car, $third_car, $fourth_car);

      $cars_matching_search = array();
        foreach ($cars as $car) {
          if (($car->getPrice() < $_GET["priceInput"]) && ($car->getMiles() < $_GET["milageInput"])) {
            array_push($cars_matching_search, $car);
          }
        }
        if (empty($cars_matching_search)) {
            echo "<p>You're too picky about cars...</p>";
        } else {
              foreach ($cars_matching_search as $car) {
                  $miles = $car->getMiles();
                  $price = $car->getPrice();
                  $make_model = $car->getMakeModel();
                  $car_pic = $car->getCarPic();

                  echo "<li>" . $make_model . "</li><ul><li> Price:" . $price . "</li><li> Miles: " . $miles . "</li></ul><div class='row'>
                    <div class='col-md-6'>
                      <img src='" . $car_pic . "'>";
            }
          };
    });
    return $app;
?>
