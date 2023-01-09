<?php

require("../init.php");
require(INCS . "head.php");

$products = Product::all();
?>

<div class="container-fluid mt-3">
    <a class="btn btn-md btn-dark" href="/products/create.php">Add a Product</a>
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
                            <button class='btn btn-sm text-danger'>
                                Delete
                            </button>
                            &nbsp;
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>

<?php require(INCS . "end.php");