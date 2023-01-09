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
<?php class Product {

    public static function all() {
        global $conn;
        $query = $conn->query("SELECT * FROM products;");
        return $query->fetchAll();
    }

    public static function findOne($id) {
        global $conn;
        $query = $conn->prepare("SELECT * FROM products WHERE id = ? LIMIT 1;", [$id]);
        $query->execute([$id]);
        return $query->fetch();
    }
    public static function destroy($id) {
        global $conn;
        $query = $conn->prepare("DELETE FROM products WHERE id = ?;", [$id]);
        $query->execute([$id]);
        return (bool) $query->rowCount();
    }

    public static function update($car) {
        global $conn;

        $stm = "UPDATE products SET ";
        $keys = [];
        $values = [];

        foreach ($car as $key => $value) {
            $keys[] = $key;
            $values[] = $value;
        }

        foreach ($keys as $key) {
            $stm .= "$key = :$key, ";
        }

        // $stm = str_;

        dd($stm);

        $stm .= " WHERE id = :id;";
    }

}

class Category {
    public static function all() {
        global $conn;
        $query = $conn->query("SELECT id,name FROM categories;");
        return $query->fetchAll();
    }

    public static function findOne($id) {
        global $conn;
        $query = $conn->prepare("SELECT * FROM categories WHERE id = ? LIMIT 1;", [$id]);
        $query->execute([$id]);
        return $query->fetch();
    }
    public static function destroy($id) {
        global $conn;
        $query = $conn->prepare("DELETE FROM categories WHERE id = ?;", [$id]);
        $query->execute([$id]);
        return $query->fetch();
    }

    public static function update($car) {
        global $conn;

        $stm = "UPDATE categories SET ";
        $keys = [];
        $values = [];

        foreach ($car as $key => $value) {
            $keys[] = $key;
            $values[] = $value;
        }

        foreach ($keys as $key) {
            $stm .= "$key = :$key, ";
        }

        // $stm = str_;

        dd($stm);

        $stm .= " WHERE id = :id;";
    }

}
class Store {
    public static function count() {
        // global $conn;
        // $stm = "SELECT COUNT(id) as lead_count FROM stores where wanted_car = ? ;";
        // $query = $conn->prepare($stm);
        // $query->execute();
        // return $query->fetch()->lead_count;
    }

    public static function all() {
        global $conn;
        $query = $conn->query("SELECT id, name FROM stores;");
        return $query->fetchAll();
    }

    public static function findOne($id) {
        global $conn;
        $query = $conn->prepare("SELECT * FROM stores WHERE id = ? LIMIT 1;", [$id]);
        $query->execute([$id]);
        return $query->fetch();
    }
    public static function destroy($id) {
        global $conn;
        $query = $conn->prepare("DELETE FROM stores WHERE id = ?;", [$id]);
        $query->execute([$id]);
        return $query->fetch();
    }

    public static function update($car) {
        global $conn;

        $stm = "UPDATE stores SET ";
        $keys = [];
        $values = [];

        foreach ($car as $key => $value) {
            $keys[] = $key;
            $values[] = $value;
        }

        foreach ($keys as $key) {
            $stm .= "$key = :$key, ";
        }

        // $stm = str_;

        dd($stm);

        $stm .= " WHERE id = :id;";
    }

}