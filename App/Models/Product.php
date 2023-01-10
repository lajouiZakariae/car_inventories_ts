<?php
namespace App\Models;

class Product {

    public static function all() {
        global $conn;
        $query = $conn->query("SELECT * FROM products;");
        return $query->fetchAll();
    }

    public static function findOne($id) {
        global $conn;
        $query = $conn->prepare("SELECT * FROM products WHERE id = ? LIMIT 1;");
        $query->execute([$id]);
        return $query->fetch();
    }

    public static function findByStore($store) {
        global $conn;
        $stm = $conn->prepare("SELECT * FROM products WHERE store_id=?");
        $stm->execute([$store]);
        return $stm->fetchAll();
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