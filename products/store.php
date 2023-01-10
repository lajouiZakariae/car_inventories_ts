<?php
use App\Models\Product;
use App\Models\Store;

require("../init.php");
require(INCS . "head.php");

$store_id = $_GET["id"];

if (!filter_var($store_id, FILTER_VALIDATE_INT))
    redirect("/products");

$store = Store::findOne($store_id);
$products = Product::findByStore($store_id);
?>
<div class="container mt-2">
    <h2>
        <b>Store:</b>
        <?php e($store->name) ?>
    </h2>
    <div class="row mt-3">
        <?php foreach ($products as $product): ?>
            <div class='col-12 col-md-6'>
                <div class='card mb-3'>
                    <div class='card-body'>

                        <h4 class='card-title text-dark'>
                            <?php e($product->title) ?>
                        </h4>
                        <span><b>Cost</b>: <?php e($product->cost) ?> & <b>Price</b>: <?php e($product->price) ?></span>
                        <br />
                        <span>Ready to Sell: <?php e($product->ready_to_sell ? "yes" : "no") ?></span>
                        <br />
                        <span>Added in : <?php echo "" //$product->created_at ?></span>
                        <div class="div mt-2">
                            <a href="/products/single.php?id=<?php e($product->id) ?>" class='btn btn-sm btn-dark'>
                                Details
                            </a>
                            &nbsp;
                            <a href="/products/delete.php?id=<?php e($product->id) ?>" class='btn btn-sm text-danger'>
                                Delete
                            </a>
                            &nbsp;
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>

<?php require(INCS . "head.php"); ?>