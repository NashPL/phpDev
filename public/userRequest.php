<?php
include_once(dirname(__DIR__) . '/app/Http/Index.php');
use Http\Index;

$index = new Index($_POST);
$result = $index->processUser();
if (isset($result)) {
    header("Location: \quote.php?email=" . $result);
}
