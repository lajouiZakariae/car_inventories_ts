<?php
require("../init.php");
require(INCS . "head.php");

$id = $_GET["id"];

if (!is_number($id))
    redirect("/products");


$destroyed = Product::destroy($id);

if (!$destroyed)
    redirect("/products");
?>

<div class="container mt-3">

    <div class="alert alert-success">
        <h5>Product is Deleted Successfully</h5>
        <a href="/products" class="link-success">Back to listing</a>
    </div>

</div>