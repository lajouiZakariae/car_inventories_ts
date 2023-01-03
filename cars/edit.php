<?php
require("../init.php");
require(INCS . "head.php");

// POST REQUEST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $car = (object) [
        "make" => $_POST["make"],
        "model" => $_POST["model"],
        "year" => $_POST["year"],
        "price" => $_POST["price"],
        "inventory" => $_POST["inventory"],
        "category" => $_POST["category"],
        "ready_to_sell" => $_POST["ready_to_sell"] ?? null,
    ];
    dd($car);
    die();
}

$id = $_GET["id"];

if (!is_number($id))
    redirect("/cars");

$car = Car::findOne($id);

if (!$car)
    redirect("/cars");


$categories = Category::all();
$inventories = Inventory::all();

?>
<form class='w-50 mx-auto mt-3' action="/cars/edit.php?id=<?php e($car->id) ?>" method="POST"
    enctype="multipart/form-data">
    <div class="form-group mb-2">
        <div class="picture-placeholder border rounded d-flex align-items-center justify-content-center fs-3">
            Add Picture
        </div>
        <input type="file" name="picture" id="picture" hidden>
    </div>
    <div class='form-group mb-2'>
        <input type='text' name='make' placeholder='Make' class='form-control' value="<?php e($car->make) ?>" />
    </div>
    <div class='form-group mb-2'>
        <input type='text' name='model' placeholder='Model' class='form-control' value="<?php e($car->model) ?>" />
    </div>
    <div class='form-group mb-2'>
        <input type='text' name='year' placeholder='Year' class='form-control' value="<?php e($car->year) ?>" />
    </div>
    <div class='form-group mb-2'>
        <input type='text' name='price' placeholder='Price' class='form-control' value="<?php e($car->price) ?>" />
    </div>
    <hr />
    <div class='form-group mb-2'>
        <select name='inventory' class='form-select' id='inventory'>
            <?php foreach ($inventories as $inventory): ?>
                <option value="<?php echo $inventory->id ?>" <?php if ($inventory->id === $car->inventory) {
                   echo "selected";
               } ?>>
                    <?php echo $inventory->name ?>
                </option>
                <?php endforeach ?>
        </select>
    </div>
    <div class='form-group mb-2'>
        <select name='category' class='form-select' id='category'>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category->id ?>" <?php if ($category->id === $car->category) {
                   echo "selected";
               } ?>>
                    <?php echo $category->name ?>
                </option>
                <?php endforeach ?>
        </select>
    </div>
    <div class='form-group mb-2'>
        <input type='checkbox' name='ready_to_sell' <?php echo $car->ready_to_sell ? "checked" : ""; ?> />
        &nbsp;Ready to Sell
    </div>
    <button class='btn btn-primary w-100' type='submit'>
        Save
    </button>
</form>
<style>
    .picture-placeholder {
        height: 150px;
        background-color: #f1f1f1;
        color: #aaa;
        cursor: pointer;
        transition: background-color 0.4s ease;
    }

    .picture-placeholder:hover {
        background-color: #e0e0e0;

    }
</style>
<?php require(INCS . "end.php");