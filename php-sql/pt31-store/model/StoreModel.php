<?php
namespace proven\store\model;

require_once 'model/persist/UserDao.php';
require_once 'model/persist/CategoryDao.php';
require_once 'model/persist/ProductDao.php';
require_once 'model/persist/WarehouseDao.php';
require_once 'model/User.php';
require_once 'model/Category.php';
require_once 'model/Product.php';
require_once 'model/Warehouse.php';

use proven\store\model\persist\CategoryDao;
use proven\store\model\persist\ProductDao;
use proven\store\model\persist\UserDao;
use proven\store\model\persist\WarehouseDao;

//use proven\store\model\User;

/**
 * Service class to provide data.
 * @author ProvenSoft
 */
class StoreModel {


    public function __construct() {
    }
   
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

	public function findAllCategories(): array {
		$dbHelper = new CategoryDao();
		return $dbHelper->selectAll();
	}

	public function findAllProducts(): array {
		$dbHelper = new ProductDao();
		return $dbHelper->selectAll();
	}

	public function findAllWarehouses(): array {
		$dbHelper = new WarehouseDao();
		return $dbHelper->selectAll();
	}
}

