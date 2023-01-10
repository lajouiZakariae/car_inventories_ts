<?php
require("../init.php");

use App\Models\Store;

$stores = Store::all();

sendJson(["stores" => $stores]);