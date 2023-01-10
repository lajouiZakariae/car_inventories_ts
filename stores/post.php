<?php
use App\Models\Store;

require("../init.php");

$to_kebab = fn(string $string): string =>
    implode("-", array_map(fn($word) => strtolower($word), explode(" ", $string)));


$store = (object) [
    "name" => $_POST["name"],
    "slug" => $to_kebab($_POST["name"]),
];

$response = Store::save($store);

sendJson(["msg" => $response]);