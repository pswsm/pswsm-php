<?php
namespace proven\store\model\persist;

require_once 'model/WarehouseProduct.php';
require_once 'model/persist/StoreDb.php';
require_once 'model/Product.php';

use proven\store\model\Product as Product;
use proven\store\model\WarehouseProduct as WarehouseProduct;
use proven\store\model\persist\StoreDb as StoreDb;
use proven\store\model\Warehouse;

class WarehouseProductDao {
	private StoreDb $dbConnect;
	private static string $TABLE_NAME = 'warehousesproducts';
	private array $queries;


	public function __construct() {
		$this->dbConnect = new StoreDb;
		$this->queries = array();
		$this->initQueries();
	}

	private function initQueries() {
		$this->queries['SELECT_ALL'] = \sprintf(
			"select * from %s",
			self::$TABLE_NAME
		);
        $this->queries['SELECT_WHERE_ID'] = \sprintf(
                "select * from %s where id = :id", 
                self::$TABLE_NAME
        );
        $this->queries['SELECT_WHERE_WID'] = \sprintf(
            "select * from %s where warehouse_id = :wid", 
            self::$TABLE_NAME
        );
        $this->queries['SELECT_WHERE_PID'] = \sprintf(
            "select * from %s where product_id = :pid", 
            self::$TABLE_NAME
        );
        $this->queries['INSERT'] = \sprintf(
                "insert into %s (warehouse_id, product_id, stock) values (:wid, :pid, :stock)", 
                self::$TABLE_NAME
        );
        $this->queries['UPDATE'] = \sprintf(
                "update %s set stock = :stock where product_id = :pid and warehouse_id = :wid", 
                self::$TABLE_NAME
        );
        $this->queries['DELETE_PID'] = \sprintf(
                "delete from %s where product_id = :id", 
                self::$TABLE_NAME
		);
        $this->queries['DELETE_WID'] = \sprintf(
                "delete from %s where warehouse_id = :id", 
                self::$TABLE_NAME
		);
	}

	public function selectAll(): array {
        $data = array();
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.
            $stmt = $connection->prepare($this->queries['SELECT_ALL']);
            //query execution.
            $success = $stmt->execute(); //bool
            //Statement data recovery.
            if ($success) {
                if ($stmt->rowCount()>0) {
                   //fetch in class mode and get array with all data.                   
                    $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, WarehouseProduct::class);
                    $data = $stmt->fetchAll(); 
                    //or in one single sentence:
                    // $data = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Product::class);
                } else {
                    $data = array();
                }
            } else {
                $data = array();
            }
        } catch (\PDOException $e) {
//            print "Error Code <br>".$e->getCode();
//            print "Error Message <br>".$e->getMessage();
//            print "Stack Trace <br>".nl2br($e->getTraceAsString());
            $data = array();
        }   
        return $data;   
	}

    /**
     * selects entitites in database where field value.
     * return array of entity objects.
     */
    public function selectWhere(string $fieldname, string $fieldvalue): array {
        $data = array();
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.
            $query = sprintf("select * from %s where %s = '%s'", 
                self::$TABLE_NAME, $fieldname, $fieldvalue);
            $stmt = $connection->prepare($query);
            //query execution.
            $success = $stmt->execute(); //bool
            //Statement data recovery.
            if ($success) {
                if ($stmt->rowCount()>0) {
                    $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, WarehouseProduct::class);
                    $data = $stmt->fetchAll(); 
                    // //or in one single sentence:
                    //$data = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User');
                } else {
                    $data = array();
                }
            } else {
                $data = array();
            }
        } catch (\PDOException $e) {
//            print "Error Code <br>".$e->getCode();
//            print "Error Message <br>".$e->getMessage();
//            print "Strack Trace <br>".nl2br($e->getTraceAsString());
            $data = array();
        }   
        return $data;   
	}

    /**
     * selects entitites in database matching the given product.
     * return array of entity objects.
     */
    public function selectByProductId(Product $entity): array {
        $data = array();
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.
			$stmt = $connection->prepare($this->queries['SELECT_WHERE_PID']);
			$stmt->bindValue(':pid', $entity->getId(), \PDO::PARAM_INT);
            //query execution.
            $success = $stmt->execute(); //bool
            //Statement data recovery.
            if ($success) {
                if ($stmt->rowCount()>0) {
                    $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, WarehouseProduct::class);
                    $data = $stmt->fetchAll(); 
                    // //or in one single sentence:
                    //$data = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User');
                } else {
                    $data = array();
                }
            } else {
                $data = array();
            }
        } catch (\PDOException $e) {
			// print "Error Code <br>".$e->getCode();
            // print "Error Message <br>".$e->getMessage();
            // print "Strack Trace <br>".nl2br($e->getTraceAsString());
			throw $e;
        }   
        return $data;   
	}

    /**
     * selects entitites in database matching the given warehouse.
     * return array of entity objects.
     */
    public function selectByWarehouseId(Warehouse $entity): array {
        $data = array();
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.
			$stmt = $connection->prepare($this->queries['SELECT_WHERE_WID']);
			$stmt->bindValue(':wid', $entity->getId(), \PDO::PARAM_INT);
            //query execution.
            $success = $stmt->execute(); //bool
            //Statement data recovery.
            if ($success) {
                if ($stmt->rowCount()>0) {
                    $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, WarehouseProduct::class);
                    $data = $stmt->fetchAll(); 
                    // //or in one single sentence:
                    //$data = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User');
                } else {
                    $data = array();
                }
            } else {
                $data = array();
            }
        } catch (\PDOException $e) {
			// print "Error Code <br>".$e->getCode();
            // print "Error Message <br>".$e->getMessage();
            // print "Strack Trace <br>".nl2br($e->getTraceAsString());
			throw $e;
        }   
        return $data;   
	}
}
