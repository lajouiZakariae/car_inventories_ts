<?php
namespace App\Models;

class Store {
    public static function count() {
        // global $conn;
// $query = "SELECT COUNT(id) as lead_count FROM stores where wanted_car = ? ;";
// $query = $conn->prepare($query);
// $query->execute();
// return $query->fetch()->lead_count;
    }

    public static function allWithCount() {
        global $conn;
        $query = $conn->query("SELECT stores.id as store_id, stores.name as store_name ,COUNT(products.id) as product_count
        FROM stores INNER JOIN products ON stores.id = products.store_id
        GROUP BY products.store_id;");
        return $query->fetchAll();
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

    public static function save($store) {
        global $conn;
        try {
            $query = $conn->prepare("INSERT INTO stores(name,slug) VALUES(:name,:slug);");
            $query->bindParam(":name", $store->name);
            $query->bindParam(":slug", $store->slug);
            return $query->execute();
        } catch (\PDOException $th) {
            if ($th->getCode() === "23000")
                return "duplicate";
        }
    }

    public static function destroy($id) {
        global $conn;
        $query = $conn->prepare("DELETE FROM stores WHERE id = ?;");
        $query->execute([$id]);
        return !!$query->rowCount();
    }

// public static function update($car) {
// global $conn;

// $query = "UPDATE stores SET ";
// $keys = [];
// $values = [];

// foreach ($car as $key => $value) {
// $keys[] = $key;
// $values[] = $value;
// }

// foreach ($keys as $key) {
// $query .= "$key = :$key, ";
// }

// // $query = str_;

// dd($query);

// $query .= " WHERE id = :id;";
// }

}