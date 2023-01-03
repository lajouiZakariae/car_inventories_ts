<?php

require("../init.php");
require(INCS . "head.php");

$errors = (object) [];

/**
 * @method POST
 */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $car = (object) [
        "make" => $_POST["make"],
        "model" => $_POST["model"],
        "year" => $_POST["year"],
        "price" => $_POST["price"],
        "inventory" => $_POST["inventory"],
        "category" => $_POST["category"],
        "ready_to_sell" => $_POST["ready_to_sell"] ?? false,
    ];

    /**
     * TODO: Data Validation
     */
    foreach ($car as $key => $value) {
        if ($value === "") {
            $errors->$key = ucfirst($key) . " should not be empty";
        }
    }

    if (!isset($errors->year) and !filter_var($car->year, FILTER_VALIDATE_INT)) {
        $errors->year = "Provide a valid year";
    }

    if (!isset($errors->price) and !filter_var($car->price, FILTER_VALIDATE_FLOAT)) {
        $errors->price = "Provide a valid Price";
    }

    /**
     * TODO: File Upload Validation
     */
    // if (!!preg_match("/.(jpg)$/", $_FILES["picture"]["name"])) {
    //     $errors->picture[] = "Invalid Extention";

    // }

    // dd($errors);

    // $random = shake(10);
    // $file_name_exploded = explode(".", $_FILES["picture"]["name"]);
    // $ext = array_pop($file_name_exploded);

    // $file = $random . "/" . $car->make . "-" . $car->model . "." . $ext;
}

$categories = Category::all();
$inventories = Inventory::all();

?>

<form class='mx-auto my-3 create-form' action="<?php e($_SERVER["PHP_SELF"]) ?>" method="POST"
    enctype="multipart/form-data">
    <div class="row mb-1">

        <div class="col-md-3">
            <!-- !Allow Changing the image -->
            <div id="picturePlaceholder"
                class="border rounded shadow-sm d-flex align-items-center justify-content-center fs-5 fs-md-3 text-black-50">
                Add Picture
            </div><img src="" class="d-none border rounded" id="picturePreview">
            <input type="file" name="picture" id="pictureInput" hidden>
        </div>

        <div class="col-md-9">
            <div class="row ps-1">

                <div class='form-group mb-2 col-sm-6 pe-1'>
                    <input type='text' name='make' value="<?php if (isset($car->make))
                    e($car->make); ?>" placeholder='Make' class='form-control' />
                </div>
                <div class='form-group mb-2 col-sm-6 ps-1'>
                    <input type='text' name='model' value="<?php if (isset($car->model))
                    e($car->model); ?>" placeholder='Model' class='form-control' />
                </div>
                <div class='form-group mb-2 col-sm-6 pe-1'>
                    <input type='text' name='year' value="<?php if (isset($car->year))
                    e($car->year); ?>" placeholder='Year' class='form-control' />
                </div>
                <div class='form-group mb-2 col-sm-6 ps-1'>
                    <input type='text' name='price' value="<?php if (isset($car->price))
                    e($car->price); ?>" placeholder='Price' class='form-control' />
                </div>

                <div class='form-group mb-2'>
                    <select name='inventory' class='form-select' id='inventory'>
                        <?php foreach ($inventories as $inventory): ?>
                            <option value='<?php e($inventory->id) ?>'>
                                <?php e($inventory->name) ?>
                            </option>
                            <?php endforeach ?>
                    </select>
                </div>
                <div class='form-group mb-2'>
                    <select name='category' class='form-select' id='category'>
                        <?php foreach ($categories as $category): ?>
                            <option value='<?php e($category->id) ?>'>
                                <?php e($category->name) ?>
                            </option>
                            <?php endforeach ?>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($errors->make) or isset($errors->model) or isset($errors->year) or isset($errors->price) or isset($errors->picture)): ?>
        <div class="form-group my-2 alert alert-danger">
            <?php display_errors($errors) ?>
        </div>
        <?php endif; ?>

    <!-- <div class='form-group my-3 ms-1'>
        <input type='checkbox' name='ready_to_sell' />
        &nbsp;Ready to Sell
    </div> -->
    <button class='btn btn-dark w-100 mt-1' type='submit'>
        Save
    </button>
</form>

<?php require(INCS . "end.php");