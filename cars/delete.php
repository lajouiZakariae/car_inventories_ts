<?php
require("../init.php");
require(INCS . "head.php");

$id = $_GET["id"];

if (!is_number($id))
    redirect("/cars");


$destroyed = Car::destroy($id);

if (!$destroyed)
    redirect("/cars");
?>

<div class="container mt-3">

    <div class="alert alert-success">
        <h5>Deleted Successfully</h5>
        <a href="/cars" class="link-success">Back to listing</a>
    </div>

</div>