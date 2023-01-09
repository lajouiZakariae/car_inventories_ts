<?php
require("../init.php");

$id = $_GET["id"];

if (!filter_var($id, FILTER_VALIDATE_INT))
    sendJson(["msg" => "Not Found"]);

// $deleted = Store::destroy($id);

sendJson(["deleted" => true]);