<?php
namespace proven\lib\views;
require_once 'model/User.php';
require_once 'model/Product.php';
require_once 'model/Category.php';
require_once 'model/Warehouse.php';

use proven\store\model\User;
use proven\store\model\Product;
use proven\store\model\Category;
use proven\store\model\Warehouse;

class Validator {

    public static function validateUser(int $method) {
        $obj = null;
        $id = static::cleanAndValidate($method, 'id', FILTER_VALIDATE_INT); 
        $username = static::cleanAndValidate($method, 'username'); 
        $password = static::cleanAndValidate($method, 'password'); 
        $firstname = static::cleanAndValidate($method, 'firstname'); 
        $lastname = static::cleanAndValidate($method, 'lastname'); 
        $role = static::cleanAndValidate($method, 'role'); 
        $obj = new User($id, $username, $password, $firstname, $lastname, $role);
        return $obj;        
    }

    public static function cleanAndValidate(int $method, string $variable, int $filter=\FILTER_SANITIZE_FULL_SPECIAL_CHARS) {
        $clean = null;
        if (\filter_has_var($method, $variable)) {
            $clean = \filter_input($method, $variable, $filter); 
        }
        return $clean;
	}

    public static function validateProduct(int $method) {
        $obj = null;
        $id = static::cleanAndValidate($method, 'id', FILTER_VALIDATE_INT); 
        $code = static::cleanAndValidate($method, 'code'); 
        $price = static::cleanAndValidate($method, 'price', FILTER_VALIDATE_FLOAT); 
        $description = static::cleanAndValidate($method, 'description'); 
        $category_id = static::cleanAndValidate($method, 'category-id', FILTER_VALIDATE_INT); 
        $obj = new Product($id, $code, $description, $price, $category_id);
        return $obj;        
    }

    public static function validateCategory(int $method) {
        $obj = null;
        $id = static::cleanAndValidate($method, 'id', FILTER_VALIDATE_INT); 
        $code = static::cleanAndValidate($method, 'code'); 
        $description = static::cleanAndValidate($method, 'description'); 
        $obj = new Category($id, $code, $description);
        return $obj;        
    }

    public static function validateWarehouse(int $method) {
        $obj = null;
        $id = static::cleanAndValidate($method, 'id', FILTER_VALIDATE_INT); 
        $code = static::cleanAndValidate($method, 'code'); 
        $address = static::cleanAndValidate($method, 'address'); 
        $obj = new Warehouse($id, $code, $address);
        return $obj;        
    }
}
