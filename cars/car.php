<?php
require("../init.php");
require(INCS . "head.php");

$id = $_GET["id"];

if (!is_number($id)) {
    redirect("/cars");
}

$car = Car::findOne($id);
$lead_count = Lead::count($id);

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-2"></div>

        <div class="col-10 mt-3 position-relative">
            <div class="controls position-absolute">
                <a class="trash text-info me-2" href="/cars/edit.php?id=<?php e($car->id) ?>">Edit</a>
                <a class="trash text-danger" href="/cars/delete.php?id=<?php e($car->id) ?>">Trash</a>
            </div>
            <div class="car row border rounded p-4 mx-2">
                <div class="col-md-5">
                    <h4>image</h4>
                </div>
                <div class="seperator p-0 position-absolute d-none d-md-block"></div>
                <hr class="d-md-none my-2" />
                <div class="col-md-7">
                    <h2>
                        <?php e($car->make . " " . $car->model) ?>
                    </h2>
                    <div class="description">
                        Year: <?php e($car->year) ?>
                        <br />
                        <b class="text-primary">
                            <?php e($lead_count) ?>
                        </b> People want this car.
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<style>
    .seperator {
        height: 80%;
        width: 1px;
        border: none;
        top: 10%;
        right: 65%;
        background-color: rgb(222, 226, 230);
    }

    .controls {
        right: 40px;
        top: 8px;
    }

    .controls .trash {
        text-decoration: none;
    }
</style>
<?php require(INCS . "end.php") ?>