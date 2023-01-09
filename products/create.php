<?php

require("../init.php");
require(INCS . "head.php");

$errors = (object) [];

$categories = Category::all();
$stores = Store::all();

?>

<form class='mx-auto my-3 create-form' enctype="multipart/form-data" id="addProduct">
    <div class="mb-2"><button type="button" class="btn btn-sm btn-dark random">Fill With Random Data</button></div>
    <div class="mb-1">

        <div class="">
            <div class="image-error-msg" style="display: none;"></div>
            <!-- !Allow Changing the image -->
            <div class="position-relative d-inline-block d-none">
                <div class="controls position-absolute">
                    <span class="delete-image text-danger">delete</span>
                    <span class="edit-image text-info">Edit</span>
                </div>
                <img id="picturePreview" class="rounded shadow-sm">
            </div>
            <div id="picturePlaceholder"
                class="border rounded shadow-sm d-flex align-items-center justify-content-center fs-6 fs-md-4 text-black-50">
                <span>Add Picture</span>
            </div>
            <input type="file" name="picture" id="pictureInput" hidden>
        </div>

        <div class="mt-3">
            <div class="row ps-1">

                <div class='form-group mb-2 col-sm-6 pe-sm-1'>
                    <input type='text' name='title' placeholder='Title' class='form-control' />
                </div>
                <div class='form-group mb-2 col-sm-6 ps-sm-1'>
                    <input type='text' name='description' placeholder='Description' class='form-control' />
                </div>
                <div class='form-group mb-2 col-sm-6 pe-sm-1'>
                    <input type='text' name='price' placeholder='Price' class='form-control' />
                </div>
                <div class='form-group mb-2 col-sm-6 ps-sm-1'>
                    <input type='text' name='cost' placeholder='Cost' class='form-control' />
                </div>

                <div class='form-group mb-2'>
                    <select name='store' class='form-select' id='store'>
                        <?php foreach ($stores as $store): ?>
                            <option value='<?php e($store->id) ?>'>
                                <?php e($store->name) ?>
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
                <div class="form-group mb-2">
                </div>
            </div>
        </div>
    </div>
    <div class="error-box alert alert-danger" style="display: none;">

    </div>
    <div class="success-box alert alert-success" style="display: none;">

    </div>

    <!-- <a href="" download="">Download</a> -->
    <div class='form-group my-3 ms-1'>
        <input type='checkbox' name='ready_to_sell' />
        &nbsp;Ready to Sell
    </div>
    <button class='btn btn-dark w-100 mt-1' type='submit'>
        Save
    </button>
</form>

<?php require(INCS . "end.php");