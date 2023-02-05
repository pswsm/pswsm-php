<?php
namespace proven\store\model;

require_once 'model/persist/UserDao.php';
require_once 'model/persist/CategoryDao.php';
require_once 'model/persist/ProductDao.php';
require_once 'model/persist/WarehouseDao.php';
require_once 'model/persist/WarehouseProductDao.php';
require_once 'model/User.php';
require_once 'model/Category.php';
require_once 'model/Product.php';
require_once 'model/Warehouse.php';

use Exception;
use proven\store\model\persist\CategoryDao;
use proven\store\model\persist\ProductDao;
use proven\store\model\persist\UserDao;
use proven\store\model\persist\WarehouseDao;
use proven\store\model\persist\WarehouseProductDao;

//use proven\store\model\User;

/**
 * Service class to provide data.
 * @author ProvenSoft
 */
class StoreModel {


    public function __construct() {
    }

	/** USER METHODS **/
	/* This section contains all USER related methods */

    public function findAllUsers(): array {
        $dbHelper = new UserDao();
        return $dbHelper->selectAll();
    }
    
    public function findUsersByRole(string $role): array {
        $dbHelper = new UserDao();
        return $dbHelper->selectWhere("role", $role);
    }

    public function addUser(User $user): int {
        $dbHelper = new UserDao();
        return $dbHelper->insert($user);
    }

    public function modifyUser(User $user): int {
        $dbHelper = new UserDao();
        return $dbHelper->update($user);
    }

    public function removeUser(User $user): int {
        $dbHelper = new UserDao();
        return $dbHelper->delete($user);
    }
    
    public function findUserById(int $id): ?User {
        $dbHelper = new UserDao();
        $u = new User($id);
        return $dbHelper->select($u);
	}

	/** CATEGORIES ZONE **/

	public function findAllCategories(): array {
		$dbHelper = new CategoryDao();
		return $dbHelper->selectAll();
	}

    public function findCategoryById(int $id): ?Category {
        $dbHelper = new CategoryDao();
        $u = new Category($id);
        return $dbHelper->select($u);
	}

    public function modifyCategory(Category $category): int {
        $dbHelper = new CategoryDao();
        return $dbHelper->update($category);
    }

    public function removeCategory(Category $category): int {
        $dbHelper = new CategoryDao();
        return $dbHelper->delete($category);
    }

    public function addCategory(Category $category): int {
        $dbHelper = new CategoryDao();
        return $dbHelper->insert($category);
    }

	/** PRODUCT ZONE **/

	public function findAllProducts(): array {
		$dbHelper = new ProductDao();
		return $dbHelper->selectAll();
	}
    
    public function findProductById(int $id): ?Product {
        $dbHelper = new ProductDao();
        $u = new Product($id);
        return $dbHelper->select($u);
	}

    public function modifyProduct(Product $product): int {
        $dbHelper = new ProductDao();
        return $dbHelper->update($product);
    }

    public function removeProduct(Product $product): int {
        $dbHelper = new ProductDao();
        return $dbHelper->delete($product);
    }

    public function addProduct(Product $product): int {
        $dbHelper = new ProductDao();
        return $dbHelper->insert($product);
    }

	/** WAREHOUSE ZONE **/

	public function findAllWarehouses(): array {
		$dbHelper = new WarehouseDao();
		return $dbHelper->selectAll();
	}
    
    public function findWarehouseById(int $id): ?Warehouse {
        $dbHelper = new WarehouseDao();
        $u = new Warehouse($id);
        return $dbHelper->select($u);
	}

    public function modifyWarehouse(Warehouse $warehouse): int {
        $dbHelper = new WarehouseDao();
        return $dbHelper->update($warehouse);
    }

	/** STOCKS ZONE **/

	public function findStocksByProduct(Product $prod): array {
		$dbHelper = new WarehouseProductDao();
		try {
			$result = $dbHelper->selectByProductId($prod);
		} catch (Exception $e) {
			throw $e;
		}
		return $result;
	}

	public function findStocksByWarehouse(Warehouse $wh): array {
		$dbHelper = new WarehouseProductDao();
		try {
			$result = $dbHelper->selectByWarehouseId($wh);
		} catch (Exception $e) {
			throw $e;
		}
		return $result;
	}

    public function removeStockByProduct(Product $stock): int {
        $dbHelper = new WarehouseProductDao();
        return $dbHelper->removeByPid($stock);
    }
}

