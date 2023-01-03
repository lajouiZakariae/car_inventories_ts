<?php

require("../init.php");
require(INCS . "head.php");

$cars = Car::all();
?>

<div class="container-fluid mt-3">
    <a class="btn btn-md btn-dark" href="/cars/create.php">Add a Car</a>
    <div class="row mt-3">
        <?php foreach ($cars as $car): ?>
            <div class='col-12 col-md-6'>
                <div class='card mb-3'>
                    <div class='card-body'>

                        <h4 class='card-title text-dark'>
                            <?php echo $car->make ?> <?php echo $car->model ?>
                        </h4>
                        <span>Year: <?php echo $car->year ?></span>
                        <br />
                        <span>Ready to Sell: <?php echo $car->ready_to_sell ? "yes" : "no" ?></span>
                        <br />
                        <span>Added in : <?php echo "" //$car->created_at ?></span>
                        <div class="div mt-2">
                            <a href="/cars/car.php?id=<?php echo $car->id ?>" class='btn btn-sm btn-dark'>
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