<?php
namespace App\Models;

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
        $query = $conn->prepare("DELETE FROM stores WHERE id = ?;");
        $query->execute([$id]);
        return !!$query->rowCount();
    }

// public static function update($car) {
// global $conn;

// $stm = "UPDATE stores SET ";
// $keys = [];
// $values = [];

// foreach ($car as $key => $value) {
// $keys[] = $key;
// $values[] = $value;
// }

// foreach ($keys as $key) {
// $stm .= "$key = :$key, ";
// }

// // $stm = str_;

// dd($stm);

// $stm .= " WHERE id = :id;";
// }

}