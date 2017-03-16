<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/car.php";

    session_start();
    if (empty($_SESSION['all_cars'])) {
      $_SESSION['all_cars'] = array();
    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'
  ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('cars.html.twig');
    });

    $app->get("/sellcar", function() use ($app) {
        return $app['twig']->render('sellcars.html.twig');
    });

    $app->post("/inventory", function() use ($app) {
        $first_car = new Car("2014 Porshe 911", "114220", "7622", "img/car1.jpeg");
        $second_car = new Car("2011 Ford F350", "12333", "44223", "img/car2.jpeg");
        $third_car = new Car("2013 Lexus RX 350", "44700", "20000", "img/car3.jpeg");
        $fourth_car = new Car("Mercedes Benz CLS550", "39900", "37989", "img/car4.jpeg");
        $fifth_car = new Car($_POST['make_model'], $_POST['price'], $_POST['miles'], $_POST['img']);
        $cars = array($first_car, $second_car, $third_car, $fourth_car, $fifth_car);

        return $app['twig']->render('inventory.html.twig', array('cars' => $cars));

    });

    $app->post("/car", function() use ($app) {
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
          if (($car->getPrice() < $_POST["priceInput"]) && ($car->getMiles() < $_POST["milageInput"])) {
            array_push($cars_matching_search, $car);
          }
        }
        return $app['twig']->render('showcars.html.twig', array('old_cars' => $cars_matching_search));

    });
    return $app;
?>
