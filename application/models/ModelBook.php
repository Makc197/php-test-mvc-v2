<?php

namespace models;

use core\Model;
use classes\Paginator;
use core\ViewGridInterface;

class ModelBook extends ModelProduct implements ViewGridInterface {

    private $author;
    private $numPages = 0;

    //Конструктор класса BookProduct
    public function __construct($type = null, $title = null, $description = null, $price = null, $author = null, $numPages = null) {
        parent::__construct('book', $title, $description, $price, $author, $numPages);
        $this->numPages = $numPages;
        $this->author = $author;
    }

    function getAttributeLabels() {
        //Соотношение Поле в БД - Лейбл - для дальнейшей отрисовки View
        return [
            'id'=>'ID',
            'type'=>'Тип',
            'title'=>'Наименование',
            'description'=>'Описание',
            'price'=>'Цена',
            'author'=>'Автор',
            'numpages'=>'Кол-во страниц'
        ];
    }

    public static function getCountOfRows() {
        $query = "SELECT COUNT(id) c FROM books;";
        $result = self::getMySQLDb()->query($query)->fetch();
        if (isset($result['c']))
            return $result['c'];
        return false;
    }

    static function get_data(Paginator $paginator = null) {
        $data = [];

        $query = "SELECT * FROM books b WHERE b.type='book' ORDER BY id";

        if ($paginator) {
            $query .= " LIMIT {$paginator->offset},{$paginator->limit}";
        }

        $result = self::getMySQLDb()->query($query);

        if ($result)
            foreach ($result as $row) {
                $product = new self('book', $row['title'], $row['description'], $row['price'], $row['author'], $row['numpages']);
                $product->setID($row['id']);
                $data[] = $product; //Массив объектов
            }

        return $data;
    }

    static function get_by_id($id) {
        //var_dump($id);die;
        $row = self::getMySQLDb()->query("SELECT * FROM books WHERE id = {$id} LIMIT 1")->fetch();

        if ($row) {
            $product = new self('book', $row['title'], $row['description'], $row['price'], $row['author'], $row['numpages']);
            $product->setID($row['id']);
            return $product;
        }

        return NULL;
    }

    public static function loadData($row) {
        //Создаем объект  BookProduct на основании данных массива $_POST
        $product = new self('book', $row['title'], $row['description'], $row['price'], $row['author'], $row['numpages']);
        $product->setID($row['id']);
        return $product;
    }

    public static function getTableName() {
        return 'books';
    }

    public function save() {
        // update or insert
        $id = $this->getId();

        if ($id) { //если id есть - update
            /* Было
              $sql = "UPDATE `books` SET "
              . " `title`='" . $this->getTitle() . "',"
              . " `description`='" . $this->getDescription() . "',"
              . " `price`='" . $this->getPrice() . "',"
              . " `author`='" . $this->getAuthor() . "',"
              . " `numpages`='" . $this->getNumberOfPages() . "'"
              . " WHERE `id`=" . $id;
              self::getMySQLDb()->query($sql);
             */
            //Стало
            $allowed = array("title", "description", "price", "author", "numpages");
            $sql = "UPDATE `books` SET " . self::pdoSet($allowed, $values) . " WHERE id = :id";
            $stm = self::getMySQLDb()->prepare($sql);
            $values['id'] = $_POST['id'];
            $stm->execute($values);
        } else { //если id нет - insert
            /* Было
              $sql = "INSERT INTO `books` "
              . "(`type`, `title`, "
              . "`description`, `price`, "
              . "`author`, `numpages`) "
              . "VALUES ('book', "
              . "'" . $this->getType() . "', "
              . "'" . $this->getDescription() . "', "
              . "'" . $this->getPrice() . "', "
              . "'" . $this->getAuthor() . "', "
              . "'" . $this->getNumberOfPages() . "')";
              self::getMySQLDb()->query($sql);
             */
            //Стало
            $allowed = array("type", "title", "description", "price", "author", "numpages"); //allowed fields
            $_POST['type'] = "book";
            $sql = "INSERT INTO `books` SET " . self::pdoSet($allowed, $values);
            $stm = self::getMySQLDb()->prepare($sql);
            $stm->execute($values);
        }
        return true;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getNumberOfPages() {
        return $this->numPages;
    }

}
