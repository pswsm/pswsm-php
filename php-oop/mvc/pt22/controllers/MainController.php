<?php
require_once 'lib/ViewLoader.php';
require_once 'model/Model.php';

/*
 * Controller class
 */
class MainController {
	/*
	 * @var $view private ViewLoader
	 */
	private ViewLoader $view;

	/*
	 * @var $model private Model
	 */
	private Model $model;

	/*
	 * @var $action private string
	 */
	private string $action;

	/*
	 * MainController contructor
	 */
	public function __construct() {
		$this->view = new ViewLoader();
		$this->model = new Model();
	}

	public function processRequest() {
		# echo "Process request...";
		$reqMethod = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
		switch ($reqMethod) {
			case 'GET':
			case 'get':
				$this->processGet();
				break;

			case 'POST':
			case 'post':
				echo "Request method is 'post'";
				break;
			
			default:
				echo "Request method is not 'post' nor 'get'";
				break;
		}
	}

	/*
	 * Handles GET requests
	 */
	private function processGet() {
		$this->action = '';
		if (filter_has_var(INPUT_GET, 'action')) {
			$this->action = htmlspecialchars($_GET['action']);
		}
		switch ($this->action) {
			case 'home':
				$this->loadHome();
				break;

			case 'product/listAll':
				$this->view->show('listProducts.php');
				break;
			
			default:
				$this->view->show('home.php');
				break;
		}
	}

	private function loadHome() {
		$this->view->show('home.php');
	}

	private function loadProducts() {

	}
}
?>
