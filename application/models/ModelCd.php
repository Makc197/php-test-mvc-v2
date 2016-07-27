<?php

class ModelCd extends ModelProduct {

    private $author;
    private $playLenght = 0;

    public function __construct($type = null, $title = null, $description = null, $price = null, $author = null, $playLenght = null) { // Вызываем конструктор из родительского класса и дополняем его доп атрибутами
        parent::__construct('cd', $title, $description, $price, $author, $playLenght);
        $this->author = $author;
        $this->playLength = $playLenght;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getPlayLenght() {
        return $this->playLenght;
    }

    static function get_data() {

        $result = self::getMySQLDb()->query("SELECT * FROM cds p WHERE p.type='cd' ORDER BY id");
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
            $sql = "UPDATE `cds` SET "
                    . " `title`='" . $this->getTitle() . "',"
                    . " `description`='" . $this->getDescription() . "',"
                    . " `price`='" . $this->getPrice() . "',"
                    . " `author`='" . $this->getAuthor() . "',"
                    . " `playlenght`='" . $this->getPlayLenght() . "'"
                    . " WHERE `id`=" . $id;
        } else {
            //если id нет - insert
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
        }
        //die($sql);
        self::getMySQLDb()->query($sql);
        return true;
    }

    public static function getTableName() {
        return 'cds';
    }

}
