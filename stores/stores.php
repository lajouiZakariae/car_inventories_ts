<?php
require("../init.php");

use App\Models\Store;

$stores = Store::all();

sleep(1);
sendJson(["stores" => $stores]);