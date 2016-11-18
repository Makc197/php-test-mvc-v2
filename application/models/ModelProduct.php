<?php
namespace models;

use core\Model;

class ModelProduct extends Model
{

    private $id = 0;
    private $type;
    private $title; //определили атрибуты (или они же свойства или они же поля) класса как публичные - общедоступные
    private $description;
    protected $price;

    //конструктор родительского класса ShopProduct
    public function __construct($type = 'product', $title = null, $description = null, $price = null)
    {
        $this->type = $type;
        $this->title = $title;   //присвоили атрибутам класса значения взятые из конструктора класса
        $this->description = $description;
        $this->price = $price;
    }

    public function __call($method, $args)
    {
        die($method);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function validate()
    {
        $errors = [];

        if (!preg_match('/^[0-9]*[.]?[0-9]+$/', $this->price))
            $errors[] = 'Ошибка значения.Цена должна быть числом!';
        //проверка
        return $errors;
    }

    public static function getCountOfRows()
    {
        $query = "SELECT COUNT(id) c FROM products;";
        $result = self::getMySQLDb()->query($query)->fetch();
        if (isset($result['c'])) return $result['c'];
        return false;
    }

    static function get_data(Paginator $paginator = null)
    {
        $data = [];
        $query = "SELECT * FROM products p 
              WHERE p.type='product' 
              ORDER BY id";
        if ($paginator) {
            $query .= " LIMIT {$paginator->offset},{$paginator->limit}";
        }

        $result = self::getMySQLDb()->query($query);
        if ($result)
            foreach ($result as $row) {
                $product = new self('product', $row['title'], $row['description'], $row['price']);
                $product->setID($row['id']);
                $data[] = $product;
            }

        return $data;
    }

    static function get_by_id($id)
    {
        //var_dump($id);die;
        $row = self::getMySQLDb()->query("SELECT * FROM products WHERE id = {$id} LIMIT 1")->fetch();

        if ($row) {
            $product = new self('product', $row['title'], $row['description'], $row['price']);
            $product->setID($row['id']);
            return $product;
        }

        return NULL;
    }

    public static function loadData($row)
    {
        //Создаем объект  BookProduct на основании данных массива $_POST
        $product = new self('product', $row['title'], $row['description'], $row['price']);
        $product->setID($row['id']);
        return $product;
    }

    public function save()
    {
        // update or insert
        $id = $this->getId();
        if ($id) {
            //если id есть - update
            /* Было
             $sql = "UPDATE `products` SET "
                    . " `title`='" . $this->getTitle() . "',"
                    . " `description`='" . $this->getDescription() . "',"
                    . " `price`='" . $this->getPrice() . "'"
                    . " WHERE `id`=" . $id;
            self::getMySQLDb()->query($sql);
             */
            //Стало
            $allowed = array("title", "description", "price");
            $sql = "UPDATE `products` SET " . self::pdoSet($allowed, $values) . " WHERE id = :id";
            $stm = self::getMySQLDb()->prepare($sql);
            $values['id'] = $_POST['id'];
            $stm->execute($values);

        } else {
            //если id нет - insert
            /*Было
             $sql = "INSERT INTO `products` "
                    . "(`type`, `title`, "
                    . "`description`, `price`) "
                    . "VALUES ('product', "
                    . "'" . $this->getTitle() . "', "
                    . "'" . $this->getDescription() . "', "
                    . "'" . $this->getPrice() . "')";
            self::getMySQLDb()->query($sql);
            */
            //Стало
            $allowed = array("type", "title", "description", "price"); //allowed fields
            $_POST['type'] = "product";
            $sql = "INSERT INTO `products` SET " . self::pdoSet($allowed, $values);
            $stm = self::getMySQLDb()->prepare($sql);
            $stm->execute($values);

        }
        return true;
    }

    public function delete()
    {
        self::delete_by_id($this->getId());
    }

    public static function getTableName()
    {
        return 'products';
    }

    static function delete_by_id($id)
    {
        $sql = "DELETE FROM `" . static::getTableName() . "` WHERE (`id`='" . $id . "')";
        //self::getMySQLDb()->query($sql);
        $c = self::getMySQLDb()->exec($sql);

        return $c;
    }

}
