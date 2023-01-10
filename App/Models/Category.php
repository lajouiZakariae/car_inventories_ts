<?php
namespace App\Models;

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