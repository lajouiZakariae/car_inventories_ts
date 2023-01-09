<?php
require("../init.php");

$stores = Store::all();

sendJson(["stores" => $stores]);