<?php
function dd($arr = null) {
    if ($arr) {
        echo "<pre>";
        var_dump($arr);
        echo "</pre>";
    }
    die();
}

function e($str) {
    echo htmlspecialchars($str);
}
function is_number(string $num) {
    return filter_var($num, FILTER_VALIDATE_INT);
}
function redirect(string $loc) {
    header("Location: $loc");
    die();
}
function shake($length = 10) {
    $chars = "abcdefghkldfonlkvc";
    $shake = "";

    for ($i = 0; $i < $length; $i++) {
        $shake .= $chars[rand(1, 15)];
    }

    return $shake;
}
function sendJson($data) {
    header("Content-Type: application/json");
    echo json_encode($data);
    die();
} ?>
<?php function display_errors($errors) { ?>
    <?php if (!empty($errors)): ?>
        <?php foreach ($errors as $error): ?>
            <p class="m-0">
                <?php echo $error ?>
            </p>
        <?php endforeach ?>
    <?php endif ?>
<?php } ?>