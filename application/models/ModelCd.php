<?php

namespace models;

use core\Model;
use classes\Paginator;
use core\ViewGridInterface;

class ModelCd extends ModelProduct implements ViewGridInterface {

    private $author;
    private $playLenght = 0;

    public function __construct($type = null, $title = null, $description = null, $price = null, $author = null, $playLenght = null) { // Вызываем конструктор из родительского класса и дополняем его доп атрибутами
        parent::__construct('cd', $title, $description, $price, $author, $playLenght);
        $this->author = $author;
        $this->playLenght = $playLenght;
    }

    function getAttributeLabels() {
        //Соотношение Поле в БД - Лейбл - для дальнейшей отрисовки View
        return [
            'id' => 'ID',
            'type' => 'Тип',
            'title' => 'Наименование',
            'description' => 'Описание',
            'price' => 'Цена',
            'author' => 'Автор',
            'playlenght' => 'Продолжительность'
        ];
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getPlayLenght() {
        return $this->playLenght;
    }

    public static function getCountOfRows() {
        $query = "SELECT COUNT(id) c FROM cds;";
        $result = self::getMySQLDb()->query($query)->fetch();
        if (isset($result['c']))
            return $result['c'];
        return false;
    }

    static function get_data(Paginator $paginator = null) {

        $data = [];
        $query = "SELECT * FROM cds p WHERE p.type='cd' ORDER BY id";

        if ($paginator) {
            $query .= " LIMIT {$paginator->offset},{$paginator->limit}";
        }

        $result = self::getMySQLDb()->query($query);

        $products = [];
        if ($result)
            foreach ($result as $row) {
                $product = new self('cd', $row['title'], $row['description'], $row['price'], $row['author'], $row['playlenght']);
                $product->setID($row['id']);
                $data[] = $product;
            }

        return $data;
    }

    static function get_by_id($id) {
        //var_dump($id);die;
        $row = self::getMySQLDb()->query("SELECT * FROM cds WHERE id = {$id} LIMIT 1")->fetch();

        if ($row) {
            $product = new self('cd', $row['title'], $row['description'], $row['price'], $row['author'], $row['playlenght']);
            $product->setID($row['id']);
            return $product;
        }

        return NULL;
    }

    public static function loadData($row) {
        //Создаем объект  CDProduct на основании данных массива $_POST
        $cd = new self('cd', $row['title'], $row['description'], $row['price'], $row['author'], $row['playlenght']);
        $cd->setID($row['id']);
        return $cd;
    }

    public function save() {
        // update or insert
        $id = $this->getId();

        if ($id) {
            //если id есть - update
            /* Было
              $sql = "UPDATE `cds` SET "
              . " `title`='" . $this->getTitle() . "',"
              . " `description`='" . $this->getDescription() . "',"
              . " `price`='" . $this->getPrice() . "',"
              . " `author`='" . $this->getAuthor() . "',"
              . " `playlenght`='" . $this->getPlayLenght() . "'"
              . " WHERE `id`=" . $id;
             */
            //Стало
            $allowed = array("title", "description", "price", "author", "playlenght");
            $sql = "UPDATE `cds` SET " . self::pdoSet($allowed, $values) . " WHERE id = :id";
            //var_dump($sql); 
            //die;

            $stm = self::getMySQLDb()->prepare($sql);
            $values['id'] = $_POST['id'];
            $stm->execute($values);
        } else {
            //если id нет - insert
            /* Было
              $sql = "INSERT INTO `cds` "
              . "(`type`, `title`, "
              . "`description`, `price`, "
              . "`author`, `playlenght`) "
              . "VALUES ('cd', "
              . "'" . $this->getTitle() . "', "
              . "'" . $this->getDescription() . "', "
              . "'" . $this->getPrice() . "', "
              . "'" . $this->getAuthor() . "', "
              . "'" . $this->getPlayLenght() . "')";
             */
            //Стало
            $allowed = array("type", "title", "description", "price", "author", "playlenght"); //allowed fields
            $_POST['type'] = "cd";
            $sql = "INSERT INTO `cds` SET " . self::pdoSet($allowed, $values);
            $stm = self::getMySQLDb()->prepare($sql);
            $stm->execute($values);
        }

        //die($sql);
        self::getMySQLDb()->query($sql);
        return true;
    }

    public static function getTableName() {
        return 'cds';
    }

}
