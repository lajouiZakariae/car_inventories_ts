<?php
use App\Models\Store;

require("../init.php");


$store = (object) [
    "name" => $_POST["name"],
    "slug" => $to_kebab($_POST["name"]),
];

$response = Store::save($store);

sendJson(["msg" => $response]);