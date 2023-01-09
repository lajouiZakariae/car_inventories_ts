<?php
require("../init.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $errors = (object) [];

    $product = (object) [
        "title" => $_POST["title"],
        "description" => $_POST["description"],
        "cost" => $_POST["cost"],
        "price" => $_POST["price"],
        "ready_to_sell" => $_POST["ready_to_sell"],
        "store" => $_POST["store"],
        "category" => $_POST["category"],
    ];

    /**
     * TODO: Data Validation
     */
    foreach ($product as $key => $value) {
        if ($value === "") {
            $errors->$key = ucfirst($key) . " should not be empty";
        }
    }

    // if (!isset($errors->price) and !filter_var($product->price, FILTER_VALIDATE_FLOAT)) {
    //     $errors->price = "Provide a valid Price";
    // }

    // if (!isset($errors->cost) and !filter_var($product->cost, FILTER_VALIDATE_FLOAT)) {
    //     $errors->cost = "Provide a valid Cost";
    // }

    // if (filter_var($product->ready_to_sell, FILTER_VALIDATE_BOOLEAN)) {
    //     $errors->f;
    // }

    /**
     * TODO: File Upload Validation
     */
    // if (!!preg_match("/.(jpg)$/", $_FILES["picture"]["name"])) {
    //     $errors->picture[] = "Invalid Extention";

    // }

    // dd($errors);

    // $random = shake(10);
    // $file_name_exploded = explode(".", $_FILES["picture"]["name"]);
    // $ext = array_pop($file_name_exploded);

    // $file = $random . "/" . $product->make . "-" . $product->model . "." . $ext;

    sendJson(["errors" => $errors, "msg" => "created"]);
}