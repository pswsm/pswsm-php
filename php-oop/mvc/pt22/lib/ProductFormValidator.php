<?php
require_once 'model/Product.php';
require_once 'model/persist/ProductPersistFileDao.php';

/**
 * Description of UserFormValidation
 * Provides validation to get data from User form.
 * @author Pau Figueras
 */
class ProductFormValidation {

	public static function getFindData(): Product {
		$fileDao = new ProductPersistFileDao('files/products.txt', ';');
		if (filter_has_var(INPUT_POST, 'id')) {
			$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
		} else {
			throw new Exception("No ID provided");
		}
		$product = $fileDao->searchProdById($id);
		if (!is_null($product)) {
			return $product;
		} else {
			throw new Exception("Product not found");
		}
	}

	public static function getData(): Product {
		$id = (filter_has_var(INPUT_POST, 'id')) ? htmlspecialchars($_POST['id']) : throw new Exception("id invalid");
		$desc = (filter_has_var(INPUT_POST, 'desc')) ? htmlspecialchars($_POST['desc']) : throw new Exception("desc invalid");
		$price = (filter_has_var(INPUT_POST, 'price')) ? htmlspecialchars($_POST['price']) : throw new Exception("price invalid");
		$stock = (filter_has_var(INPUT_POST, 'stock')) ? htmlspecialchars($_POST['stock']) : throw new Exception("stock invalid");

		$updatedProd = new Product($id, $desc, $price, $stock);
		return $updatedProd;
	}
    
}
