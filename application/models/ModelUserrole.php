<?php

class ModelUserrole extends Model {

    public $id;
    public $role_code;
    public $role_name;

//конструктор класса User

    public function __construct($id=null, $role_code=null, $role_name=null) {
        $this->id = $id;
        $this->role_code = $role_code;   //присвоили атрибутам класса значения взятые из конструктора класса
        $this->role_name = $role_name;
    }

    static function findById($id) {
        $role = null;
        $row = self::getMySQLDb()->query("SELECT *"
                        . "FROM user_roles "
                        ."WHERE id = {$id} LIMIT 1")->fetch();
        if ($row) {
            $role = new self($row['id'], $row['role_code'], $row['role_name']);
        }
        return $role;
    }

    static function findAll() {
        $data = [];

        $result = self::getMySQLDb()
            ->query("SELECT * FROM user_roles")
            ->fetchAll();

        if ($result)
            foreach ($result as $row) {
                $role = new self($row['id'], $row['role_code'], $row['role_name']);
                $data[] = $role;
            }

        return $data;
    }

    /*public static function create_user($row) {
//Создаем объект  User на основании данных массива $_POST
        $token = self::setToken($row['password']);
        $user = new self($row['forename'], $row['surname'], $row['username'], $row['password'], $token, ['role_id' => $row['role_id'], 'role_code' => $row['role_code'], 'role_name' => $row['role_name']]);
        $user->setID($row['id']);
        return $user;
    }*/

    public static function save(UserRole $role) {
// update or insert
        if ($role->id) {
//если id есть - update
            $sql = "UPDATE `roles` SET "
                    . " `role_code`='" . $role->role_code . "',"
                    . " `role_name`='" . $role->role_name . "'"
                    . " WHERE `id`=" . $role->id;
            self::getMySQLDb()->query($sql);
        } else {
//если id нет - insert
            $sql = "INSERT INTO `roles` "
                    . "(`role_code`, `role_name`)"
                    . "VALUES ({$role->role_code},{$role->role_name})";
            self::getMySQLDb()->query($sql);
        }

        return true;
    }

}
