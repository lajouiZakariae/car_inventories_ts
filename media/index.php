<?php
require("../init.php");
require(INCS . "head.php");
?>

<div class="container mt-3">

    <form id="uploadImage" class="mt-3 position-relative">
        <input type="file" name="picture" id="imageInput" hidden>
        <button type="button" id="addImage" class="btn btn-dark">Add Image</button>
        <button type="submit" class="btn btn-outline-info">Upload</button>
        <span class="d-inline-block position-absolute loading d-none">Loading...</span>
    </form>
    <div class="images mt-3">
    </div>
    <h3>Existing:</h3>
    <div class="images mt-3">
    </div>
</div>

<?php require(INCS . "end.php") ?>