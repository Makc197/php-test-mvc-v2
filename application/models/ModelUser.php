<?php

namespace models;

use core\Model;
use classes\Paginator;

class ModelUser extends Model {

    private $id = 0;
    private $forename; //Имя
    private $surname;  //Фамилия
    private $username; //Login
    private $password; //Password
    private $token; //Password Token
    private $role; //role = []

    //конструктор класса User

    public function __construct($forename = null, $surname = null, $username = null, $password = null, $token = null, $role = null) {
        $this->forename = $forename;
        $this->surname = $surname;   //присвоили атрибутам класса значения взятые из конструктора класса
        $this->username = $username;
        $this->password = $password;
        $this->token = $token;
        $this->role = $role;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getForeName() {
        return $this->forename;
    }

    public function setForeName($forename) {
        $this->forename = $forename;
    }

    public function getSurName() {
        return $this->surname;
    }

    public function setSurName($surname) {
        $this->surname = $surname;
    }

    public function getUserName() {
        return $this->username;
    }

    public function setUserName($username) {
        $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getToken() {
        return $this->token;
    }

    public function getRoleId() {
        return $this->role['role_id'];
    }

    public function getRoleCode() {
        return $this->role['role_code'];
    }

    public function getRoleName() {
        return $this->role['role_name'];
    }

    private static function setToken($password) {
        $slt1 = "wci~23";
        $slt2 = "lfr@87";
        //var_dump(md5("$slt1$password$slt2")); die;
        $token = md5("$slt1$password$slt2");
        return $token;
    }

//Функция аутентификации
    public static function login($login, $password) {
//1 - делаем токен для $password
        $token = self::setToken($password);
//2 - проверяем  пару $login $token в таблице users и если ОК 
// прописываем данные пользователя в массив $_SESSION
        $user = self::get_user_by_login_token($login, $token);
        if ($user) {
            $_SESSION['user'] = [
                'username' => $user->getUserName(),
                'role_code' => $user->getRoleCode(),
                'role_name' => $user->getRoleName(),
            ];

            return true;
        }

        return false;
    }

    static function get_user_by_login_token($login, $token) {

        $row = self::getMySQLDb()->query("SELECT u.*, "
                        . "ur.role_code, ur.role_name "
                        . "FROM users u "
                        . "JOIN user_roles ur"
                        . " ON ur.id=u.role_id "
                        . "WHERE `username` = '{$login}' "
                        . "AND `token`= '{$token}' LIMIT 1")->fetch();

        if ($row) {
            $user = new self($row['forename'], $row['surname'], $row['username'], $row['password'], $row['token'], ['role_id' => $row['role_id'], 'role_code' => $row['role_code'], 'role_name' => $row['role_name']]);
            $user->setID($row['id']);
            return $user;
        }

        return NULL;
    }

    static function get_user_by_id($id) {
        //var_dump($id);die;
        $row = self::getMySQLDb()->query("SELECT u.*, "
                        . "ur.role_code, ur.role_name "
                        . "FROM users u "
                        . "JOIN user_roles ur"
                        . " ON ur.id=u.role_id "
                        . "WHERE u.id = {$id}")->fetch();

        if ($row) {
            $user = new self($row['forename'], $row['surname'], $row['username'], $row['password'], $row['token'], ['role_id' => $row['role_id'], 'role_code' => $row['role_code'], 'role_name' => $row['role_name']]);
            $user->setID($row['id']);
            return $user;
        }

        return NULL;
    }

    static function get_user_by_username($login) {

        $row = self::getMySQLDb()->query("SELECT u.*, "
                        . "ur.role_code, ur.role_name "
                        . "FROM users u "
                        . "JOIN user_roles ur"
                        . " ON ur.id=u.role_id "
                        . "WHERE u.username = {$login}")->fetch();

        if ($row) {
            $user = new self($row['forename'], $row['surname'], $row['username'], $row['password'], $row['token'], ['role_id' => $row['role_id'], 'role_code' => $row['role_code'], 'role_name' => $row['role_name']]);
            $user->setID($row['id']);
            return $user;
        }

        return NULL;
    }

    public static function getCountOfRows() {
        $query = "SELECT COUNT(id) c FROM users;";
        $result = self::getMySQLDb()->query($query)->fetch();
        if (isset($result['c']))
            return $result['c'];
        return false;
    }

    static function get_data(Paginator $paginator = null) {
        $data = [];

        $query = "SELECT u.*, "
                . "ur.role_code, ur.role_name "
                . "FROM users u "
                . "JOIN user_roles ur"
                . " ON ur.id=u.role_id ";

        if ($paginator) {
            $query .= " LIMIT {$paginator->offset},{$paginator->limit}";
        }

        $result = self::getMySQLDb()->query($query)->fetchAll();

        if ($result)
            foreach ($result as $row) {
                $user = new self($row['forename'], $row['surname'], $row['username'], $row['password'], $row['token'], ['role_id' => $row['role_id'], 'role_code' => $row['role_code'], 'role_name' => $row['role_name']]);
                $user->setID($row['id']);
                $data[] = $user;
            }

        return $data;
    }

    public static function create_user($row) {
        //Создаем объект  User на основании данных массива $_POST
        $token = self::setToken($row['password']);
        //var_dump($token); die;
        $user = new self(
                $row['forename'], $row['surname'], $row['username'], $row['password'], $token, [
            'role_id' => isset($row['role_id']) ? $row['role_id'] : null,
            'role_code' => isset($row['role_code']) ? $row['role_code'] : null,
            'role_name' => isset($row['role_name']) ? $row['role_name'] : null
        ]);
        $user->setID($row['id']);
        //var_dump($user); die;
        return $user;
    }

    /**
     *
     * @return boolean
     */
    public function save() { //Если id есть - UPDATE
        // update or insert
        $id = $this->getId();
        if ($id) {

            /*
              //Подготовленные запросы в PDO
              //INSERT
              $stmt = $dbh->prepare("INSERT INTO REGISTRY (name, value) VALUES (:name, :value)");
              $stmt->bindParam(':name', $name);
              $stmt->bindParam(':value', $value);

              //Вставим одну строку
              $name = 'one';
              $value = 1;
              $stmt->execute();

              //Используем хелпер pdoSet - см self::pdoSet
              //Код для вставки:
              $allowed = array("name","surname","email"); // allowed fields
              $sql = "INSERT INTO users SET ".pdoSet($allowed,$values);
              $stm = $dbh->prepare($sql);
              $stm->execute($values);

              //А для апдейта - такой:
              $allowed = array("name","surname","email","password"); // allowed fields
              $_POST['password'] = MD5($_POST['login'].$_POST['password']);
              $sql = "UPDATE users SET ".pdoSet($allowed,$values)." WHERE id = :id";
              $stm = $dbh->prepare($sql);
              $values["id"] = $_POST['id'];
              $stm->execute($values);
             */

            /* Было
              $sql = "UPDATE `users` SET "
              . " `forename`='" . $this->getForename() . "',"
              . " `surname`='" . $this->getSurname() . "',"
              . " `username`='" . $this->getUsername() . "',"
              . " `password`='" . $this->getPassword() . "',"
              . " `token`='" . $this->getToken() . "',"
              . " `role_id`='" . $this->getRoleId() . "'"
              . " WHERE `id`=" . $id;

              self::getMySQLDb()->query($sql);
             */

            //Стало
            $allowed = array("forename", "surname", "username", "password", "token", "role_id");
            $_POST['token'] = $this->getToken();
            $sql = "UPDATE `users` SET " . self::pdoSet($allowed, $values) . " WHERE id = :id";
            $stm = self::getMySQLDb()->prepare($sql);
            $values['id'] = $_POST['id'];
            $stm->execute($values);
        } else { //Если id нет - INSERT
            /* Было
              $sql = "INSERT INTO `users` "
              . "(`forename`, `surname`, `username`, `password`, `token` , `role_id` )"
              . "VALUES ("
              . "'" . $this->getForename() . "', "
              . "'" . $this->getSurname() . "', "
              . "'" . $this->getUsername() . "', "
              . "'" . $this->getPassword() . "', "
              . "'" . $this->getToken() . "', "
              . "'" . $this->getRoleId() . "')";
              self::getMySQLDb()->query($sql);
             */

            //Стало
            $allowed = array("forename", "surname", "username", "password", "token", "role_id"); //allowed fields
            $_POST['token'] = $this->getToken();
            $sql = "INSERT INTO `users` SET " . self::pdoSet($allowed, $values);
            $stm = self::getMySQLDb()->prepare($sql);
            $stm->execute($values);
            //echo $sql . '</br>';
            //print_r($values);
            //die;
        }

        return true;
    }

    static function delete_user_by_id($id) {

        $sql = "DELETE FROM `users` WHERE (`id`='" . $id . "')";
        self::getMySQLDb()->query($sql);

        header('Location: /usermanagement');
    }

    public function validate() {
        $errors = [];
        if (!preg_match('/[0-9a-zA-Z]*/', $this->username))
            $errors[] = 'Ошибка в Login. Поле Login может содержать буквы на латинице и цифры.';
        //проверка
        return $errors;
    }

}
