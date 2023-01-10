<?php
require("../init.php");

use App\Models\Store;

$stores = Store::allWithCount();

sendJson(["stores" => $stores]);