<?php
    include_once(dirname(__DIR__) . '/app/Lib/Subscription.php');
    include_once(dirname(__DIR__) . '/app/Lib/Service.php');
    include_once(dirname(__DIR__) . '/app/Lib/Goods.php');
    
    use Lib\Subscription;
    use Lib\Service;
    use Lib\Goods;

    $subscription = new Subscription();
    $subscriptionList = $subscription->getListOfSubscription();

    $service = new Service();
    $serviceList = $service->getListOfServices();

    $goods = new Goods();
    $goodsList = $goods->getListOfGoods();
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
    <form method="post" action="quoteRequest.php">
        <?php
            echo('<input class="d-none" name="email" value="'.$_GET['email'].'"/>');
        ?>
        <div class="container">
            <div class="form-group row">
                <div class="col">
                    <label class="col-6">Select Subscriptions</label>
                    <?php
                        echo('<select name="subscription[name]" class="form-control">');
                        echo('<option value="0" default>None</option>');
                        foreach ($subscriptionList as $sub) {
                            echo('<option value="'.$sub['id'].'">'.ucfirst($sub['name']) . ' £'. $sub['price_per_day'].' per day </option>');
                        }
                        echo('</select>');
                    ?>
                </div>
                <div class="col">
                    <label class="col-6">Select Date</label>
                    <input id="subDatePicker" type='text' class="form-control" name="subscription[date]" />
                </div>
            </div>
            <hr>
            <div class="form-group row" id="service">
                <div id="serviceContainer">
                    <div class="col">
                        <label class="col-6">Select Service</label>
                        <?php
                            echo('<select name="service[name][]" class="form-control">');
                            echo('<option value="0" default>None</option>');
                            foreach ($serviceList as $ser) {
                                echo('<option value="'.$ser['id'].'">'.ucfirst($ser['name']). ' £'. $ser['price_per_hour'].' per hour</option>');
                            }
                            echo('</select>');
                        ?>
                    </div>
                    <div class="col row">
                        <div class="col">
                            <label class="col">Select Day</label>
                            <select class="form-control" name="service[date][day][]">
                                <option default>Monday</option>
                                <option>Tuesday</option>
                                <option>Wednesday</option>
                                <option>Thursday</option>
                                <option>Friday</option>
                                <option>Saturday</option>
                            </select>
                        </div>
                        <div class="col">
                            <label class="col">Time From</label>
                            <input type="time" min="9:00" max="19:00" class="form-control" value="09:00"
                                name="service[date][time][from][]">
                        </div>
                        <div class="col">
                            <label class="col">Time Till</label>
                            <input type="time" min="9:00" max="19:00" class="form-control" value="09:00"
                                name="service[date][time][till][]">
                        </div>
                        <div class="col">
                            <label class="col">How Long</label>
                            <input type="number" min="1" class="form-control" name="service[date][recurring][]" value="1">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                    <button type="button" class="btn btn-sm btn-primary" id="addMore">Add More Times</button>
                </div>
            <hr>
            <div class="form-group row">
                <div class="col">
                    <label class="col">Select Goods</label>
                    <?php
                    foreach ($goodsList as $good) {
                        echo('<div class="row p-2">');
                        echo('<input class="form-control m-2 col readonly name="goods['.$good["id"].']" value="'.ucfirst($good["name"]).'">');
                        echo('<input type="number" min="0" value="0" class="form-control m-2 col" name="goods['.$good["id"].']">');
                        echo('</div>');
                    }
                ?>
                </div>
            </div>
            <div class="form-group row">
            <button class="btn btn-primary">Submit</button>
        </div>
        </div>
    </form>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="resources/node_modules/air-datepicker/dist/js/datepicker.min.js"></script>
    <script src="resources/node_modules/air-datepicker/dist/js/i18n/datepicker.en.js"></script>
</body>

</html>

<script>
    $(function () {
        $('#addMore').click(function () {
            $('#serviceContainer').clone().appendTo('#service');
        });

        let subDisabledDays = [0, 6];
        let serDisabledDays = [0];
        $('#subDatePicker').datepicker({
            language: "en",
            range: true,
            multipleDatesSeparator: " - ",
            onRenderCell: function (date, cellType) {
                if (cellType == 'day') {
                    let day = date.getDay(),
                        isDisabled = subDisabledDays.indexOf(day) != -1;
                    return {
                        disabled: isDisabled
                    }
                }
            },
        });
    })
</script>