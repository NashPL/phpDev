<?php
include_once(dirname(__DIR__) . '/app/Lib/QuoteParser.php');

use Lib\QuoteParser;

$subscription = $_POST['subscription'];
$goods = $_POST['goods'];
$services = array();
foreach ($_POST['service']['name'] as $key0 => $value0) {
    $services[$key0] = array();
    $services[$key0]['name'] = $value0;

    foreach($_POST['service']['date'] as $key1 => $value1) {
        $services[$key0]['date'][$key1] = $value1[$key0];
        
    }
}

foreach ($services as $key0 => $value0) {

    if ($_POST['service']['date']['time']['from'][$key0] >= $_POST['service']['date']['time']['till'][$key0] && $_POST['service']['name'][0] != 0){
        echo("<h1>Your start time can not be same or lower than your end time.</h1>");
        echo('<a href="/quote.php?email='.$_POST['email'].'">Go Back</a>');
        return;
    }
    $services[$key0]['date']['time']['from'] = $_POST['service']['date']['time']['from'][$key0];
    $services[$key0]['date']['time']['till'] = $_POST['service']['date']['time']['till'][$key0];
}

$quoteParser = new QuoteParser($subscription, $services, $goods, $_POST['email']);
$result = $quoteParser->saveQuote();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="resources/node_modules/air-datepicker/dist/css/datepicker.min.css" />

    <title>phpDev!</title>
</head>

<body>
    <div class="container">
            <div class="form-group row">
                <h3>Your Quoute is Ready:  
                    <?php echo($result['user']->getName()); ?>
                </h3>
                <h3>Your Quote Reference Number is : 
                    <?php echo($result['UUID']); ?>
                </h3>
                <h3>Your Total Amount is: £
                    <?php echo($result['subtotal']); ?>
                </h3>
            </div>
            <div class="form-group row">
                <div class="col">
                    <?php 
                        echo('<h5>Subscription package: ' . $result['subscription']['name'] . '</h5>');
                        echo('<p>Price Per Day: '.$result['subscription']['price_per_day'].'</p>');
                        echo('<p>Date Chosen: '.$result['subscription']['date'].'</p>');
                        echo('<p>Number of Days: '.$result['subscription']['days'].'</p>');
                        echo('<p>Total: £'.$result['subscription']['total'].'</p>');
                    ?>
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <div class="col">
                    <?php 
                        foreach ($result['goods'] as $good) {
                            echo('<h5>Goods: ' . $good['name'] . '</h5>');
                            echo('<p>Price Per Item: '.$good['price_per_item'].'</p>');
                            echo('<p>Quantity: '.$good['quantity'].'</p>');
                            echo('<p>Total: £'.$good['total'].'</p>');
                        }
                    ?>
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <div class="col">
                    <?php 
                        foreach ($result['services'] as $ser) {
                            echo('<h5>Services: ' . $ser['name'] . '</h5>');
                            echo('<p>Price Per Hour: '.$ser['price_per_hour'].'</p>');
                            echo('<p>Hours: '.$ser['hours'].'</p>');
                            echo('<p>Chosen Times: Every '.$ser['data']['date']['day'].' From: '.$ser['data']['date']['time']['from'].' Till: '.$ser['data']['date']['time']['till'].' For: ' .$ser['data']['date']['recurring']. ' Weeks</p>');
                            echo('<p>Total: £'.$ser['total'].'</p>');
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</html>