<?php
namespace proven\store\model\persist;

require_once 'model/persist/StoreDb.php';
require_once 'model/persist/Product.php';

use proven\store\model\persist\StoreDb as StoreDb;
use proven\store\model\Product as Product;

/**
 * Product db persistence class.
 * @author Pau Figueras
 */
class ProductDao {
	private StoreDb $dbConnect;

	private static string $TABLE_NAME = 'products';

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
	}
}
?>
