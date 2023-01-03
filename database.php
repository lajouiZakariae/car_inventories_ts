<?php

$conn = null;
try {
    $stm = "mysql:host=" . HOST . ";dbname=" . DBNAME . ";";
    $conn = new PDO($stm, USERNAME, PASSWORD);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch (\Throwable $th) {
    throw $th;
}