<?php

class ModelBook extends ModelProduct{

    private $author;
    private $numPages = 0;

    //Конструктор класса BookProduct
    public function __construct($type = null, $title = null, $description = null, $price = null, $author = null, $numPages = null) {
        parent::__construct('book', $title, $description, $price, $author, $numPages);
        $this->numPages = $numPages;
        $this->author = $author;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getNumberOfPages() {
        return $this->numPages;
    }  

    static function get_data() {
        $data = [];
        $result = self::getMySQLDb()->query("SELECT * FROM books b WHERE b.type='book' ORDER BY id");

        if ($result)
            foreach ($result as $row) {
                $product = new self('book', $row['title'], $row['description'], $row['price'], $row['author'], $row['numpages']);
                $product->setID($row['id']);
                $data[] = $product; //Массив объектов
            }

        //print_r($data);
        //die();
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

    public function save() {
        // update or insert
        $id = $this->getId();
        
        if ($id) {
            //если id есть - update
            $sql = "UPDATE `books` SET "
                    . " `title`='" .  $this->getTitle(). "',"
                    . " `description`='" . $this->getDescription() . "',"
                    . " `price`='" . $this->getPrice() . "',"
                    . " `author`='" . $this->getAuthor() . "',"
                    . " `numpages`='" . $this->getNumberOfPages() . "'"
                    . " WHERE `id`=" . $id;            
            self::getMySQLDb()->query($sql);
        } else {
            //если id нет - insert
            $sql = "INSERT INTO `books` "
                    . "(`type`, `title`, "
                    . "`description`, `price`, "
                    . "`author`, `numpages`) "
                    . "VALUES ('book', "
                    . "'" . $this->getType() . "', "
                    . "'" . $this->getDescription(). "', "
                    . "'" . $this->getPrice() . "', "
                    . "'" . $this->getAuthor(). "', "
                    . "'" . $this->getNumberOfPages() . "')";
            self::getMySQLDb()->query($sql);
        }
        return true;
    }

    public static function getTableName()
    {
        return 'books';
    }

}