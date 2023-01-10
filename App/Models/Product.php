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