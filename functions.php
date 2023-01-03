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
<?php class Car {

        public static function all() {
            global $conn;
            $query = $conn->query("SELECT * FROM cars;");
            return $query->fetchAll();
        }

        public static function findOne($id) {
            global $conn;
            $query = $conn->prepare("SELECT * FROM cars WHERE id = ? LIMIT 1;", [$id]);
            $query->execute([$id]);
            return $query->fetch();
        }
        public static function destroy($id) {
            global $conn;
            $query = $conn->prepare("DELETE FROM cars WHERE id = ?;", [$id]);
            $query->execute([$id]);
            return (bool) $query->rowCount();
        }

        public static function update($car) {
            global $conn;

            $stm = "UPDATE cars SET ";
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
    class Lead {
        public static function count($car_id) {
            global $conn;
            $stm = "SELECT COUNT(id) as lead_count FROM leads where wanted_car = ? ;";
            $query = $conn->prepare($stm);
            $query->execute([$car_id]);
            return $query->fetch()->lead_count;
        }

        public static function all() {
            global $conn;
            $query = $conn->query("SELECT * FROM leads;");
            return $query->fetchAll();
        }

        public static function findOne($id) {
            global $conn;
            $query = $conn->prepare("SELECT * FROM leads WHERE id = ? LIMIT 1;", [$id]);
            $query->execute([$id]);
            return $query->fetch();
        }
        public static function destroy($id) {
            global $conn;
            $query = $conn->prepare("DELETE FROM leads WHERE id = ?;", [$id]);
            $query->execute([$id]);
            return $query->fetch();
        }

        public static function update($car) {
            global $conn;

            $stm = "UPDATE leads SET ";
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
        public static function count($car_id) {
            global $conn;
            $stm = "SELECT COUNT(id) as lead_count FROM categories where wanted_car = ? ;";
            $query = $conn->prepare($stm);
            $query->execute([$car_id]);
            return $query->fetch()->lead_count;
        }

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
    class Inventory {
        public static function count($car_id) {
            global $conn;
            $stm = "SELECT COUNT(id) as lead_count FROM inventories where wanted_car = ? ;";
            $query = $conn->prepare($stm);
            $query->execute([$car_id]);
            return $query->fetch()->lead_count;
        }

        public static function all() {
            global $conn;
            $query = $conn->query("SELECT id, inventory_name as name FROM inventories;");
            return $query->fetchAll();
        }

        public static function findOne($id) {
            global $conn;
            $query = $conn->prepare("SELECT * FROM inventories WHERE id = ? LIMIT 1;", [$id]);
            $query->execute([$id]);
            return $query->fetch();
        }
        public static function destroy($id) {
            global $conn;
            $query = $conn->prepare("DELETE FROM inventories WHERE id = ?;", [$id]);
            $query->execute([$id]);
            return $query->fetch();
        }

        public static function update($car) {
            global $conn;

            $stm = "UPDATE inventories SET ";
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