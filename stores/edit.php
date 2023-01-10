<?php
require("../init.php");

$product = [
    "id" => filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT),
    "name" => $_POST["name"]
];

sendJson($product);