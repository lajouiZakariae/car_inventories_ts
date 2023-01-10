<?php
require("../init.php");
require(INCS . "head.php");

?>

<div class="container">
    <h1>All Stores</h1>
    <button class="random-store btn btn-sm btn-dark mb-2">Fill with Random
        data</button>
    <div class="border p-3">
        <form id="storeForm" class="row align-items-center">
            <div class="col-9">
                <input type="text" name="name" placeholder="Name" class="form-control">
            </div>
            <div class="col-3">
                <button type="submit" class="btn btn-dark w-100">Save</button>
            </div>
            <div class="add-store-msg form-text mt-3" style="display:none;"></div>
        </form>
    </div>
    <div class="stores-listing row mt-2">

    </div>
</div>

<?php require(INCS . "end.php"); ?>