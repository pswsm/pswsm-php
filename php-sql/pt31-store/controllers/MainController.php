<?php

namespace proven\store\controllers;

require_once 'lib/ViewLoader.php';
require_once 'lib/Validator.php';

require_once 'model/StoreModel.php';
require_once 'model/User.php';

use proven\store\model\StoreModel as Model;
use proven\lib\ViewLoader as View;

use proven\lib\views\Validator as Validator;

/**
 * Main controller
 * @author ProvenSoft
 */
class MainController {
    /**
     * @var ViewLoader
     */
    private $view;
    /**
     * @var Model 
     */
    private $model;
    /**
     * @var string  
     */
    private $action;
    /**
     * @var string  
     */
    private $requestMethod;

    public function __construct() {
        //instantiate the view loader.
        $this->view = new View();
        //instantiate the model.
        $this->model = new Model();
    }

    /* ============== HTTP REQUEST FUNCTIONS ============== */

    /**
     * processes requests from client, regarding action command.
     */
    public function processRequest() {
        $this->action = "";
        //retrieve action command requested by client.
        if (\filter_has_var(\INPUT_POST, 'action')) {
            $this->action = \filter_input(\INPUT_POST, 'action');
        } else {
            if (\filter_has_var(\INPUT_GET, 'action')) {
                $this->action = \filter_input(\INPUT_GET, 'action');
            } else {
                $this->action = "home";
            }
        }
        //retrieve request method.
        if (\filter_has_var(\INPUT_SERVER, 'REQUEST_METHOD')) {
            $this->requestMethod = \strtolower(\filter_input(\INPUT_SERVER, 'REQUEST_METHOD'));
        }
        //process action according to request method.
        switch ($this->requestMethod) {
            case 'get':
                $this->doGet();
                break;
            case 'post':
                $this->doPost();
                break;
            default:
                $this->handleError();
                break;
        }
    }

    /**
     * processes get requests from client.
     */
    private function doGet() {
        //process action.
        switch ($this->action) {
            case 'home':
                $this->doHomePage();
                break;
            case 'user':
                $this->doUserMng();
                break;
            case 'user/edit':
                $this->doUserEditForm("edit");
                break;
            case 'category':
                $this->doCategoryMng();
                break;
            case 'product':
                $this->doProductMng();
                break;
            case 'warehouse':
                $this->doWareHouseMng();
                break;
            case 'loginform':
                $this->doLoginForm();
				break;
			case 'product/modify':
				$this->doProductEditForm('edit');
				break;
			case 'product/delete':
				$this->doConfirmProdRemove();
				break;
			case 'stocks/product':
				$this->doShowStocks('id');
				break;
			case 'stocks/warehouse':
				$this->doShowStocks('wid');
				break;
            default:  //processing default action.
                $this->handleError();
                break;
        }
    }

    /**
     * processes post requests from client.
     */
    private function doPost() {
        //process action.
        switch ($this->action) {
            case 'user/role':
                $this->doListUsersByRole();
                break;
            case 'user/form':
                $this->doUserEditForm("add");
                break;
            case 'user/add': 
                $this->doUserAdd();
                break;
            case 'user/modify': 
                $this->doUserModify();
                break;
            case 'user/remove': 
                $this->doUserRemove();
				break;
            case 'product/form':
                $this->doProductEditForm("add");
				break;
			case 'product/add':
				$this->doProductAdd();
				break;
			case 'product/modify':
				$this->doProductModify();
				break;
            case 'product/remove': 
                $this->doProductRemove();
				break;
            default:  //processing default action.
                $this->doHomePage();
                break;
        }
    }

    /* ============== NAVIGATION CONTROL METHODS ============== */

    /**
     * handles errors.
     */
    public function handleError() {
        $this->view->show("message.php", ['message' => 'Something went wrong!']);
    }

    /**
     * displays home page content.
     */
    public function doHomePage() {
        $this->view->show("home.php", []);
    }

    /* ============== SESSION CONTROL METHODS ============== */

    /**
     * displays login form page.
     */
    public function doLoginForm() {
        $this->view->show("login/loginform.php", []);  //initial prototype version;
    }

    /* ============== USER MANAGEMENT CONTROL METHODS ============== */

    /**
     * displays user management page.
     */
    public function doUserMng() {
        //get all users.
        $result = $this->model->findAllUsers();
        //pass list to view and show.
        $this->view->show("user/usermanage.php", ['list' => $result]);        
        //$this->view->show("user/user.php", [])  //initial prototype version;
    }

    public function doListUsersByRole() {
        //get role sent from client to search.
        $roletoSearch = \filter_input(INPUT_POST, "search");
        if ($roletoSearch !== false) {
            //get users with that role.
            $result = $this->model->findUsersByRole($roletoSearch);
            //pass list to view and show.
            $this->view->show("user/usermanage.php", ['list' => $result]);   
        }  else {
            //pass information message to view and show.
            $this->view->show("user/usermanage.php", ['message' => "No data found"]);   
        }
    }

    public function doUserEditForm(string $mode) {
        $data = array();
        if ($mode != 'user/add') {
            //fetch data for selected user
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            if (($id !== false) && (!is_null($id))) {
                $user = $this->model->findUserById($id);
                if (!is_null($user)) {
                    $data['user'] = $user;
                }
             }
             $data['mode'] = $mode;
        }
        $this->view->show("user/userdetail.php", $data);  //initial prototype version.
    }

    public function doUserAdd() {
        //get user data from form and validate
        $user = Validator::validateUser(INPUT_POST);
        //add user to database
        if (!is_null($user)) {
            $result = $this->model->addUser($user);
            $message = ($result > 0) ? "Successfully added":"Error adding";
            $this->view->show("user/userdetail.php", ['mode' => 'add', 'message' => $message]);
        } else {
            $message = "Invalid data";
            $this->view->show("user/userdetail.php", ['mode' => 'add', 'message' => $message]);
        }
    }
    
    public function doUserModify() {
        //get user data from form and validate
        $user = Validator::validateUser(INPUT_POST);
        //add user to database
        if (!is_null($user)) {
            $result = $this->model->modifyUser($user);
            $message = ($result > 0) ? "Successfully modified":"Error modifying";
            $this->view->show("user/userdetail.php", ['mode' => 'add', 'message' => $message]);
        } else {
            $message = "Invalid data";
            $this->view->show("user/userdetail.php", ['mode' => 'add', 'message' => $message]);
        }
    }    

    public function doUserRemove() {
        //get user data from form and validate
        $user = Validator::validateUser(INPUT_POST);
        //add user to database
        if (!is_null($user)) {
            $result = $this->model->removeUser($user);
            $message = ($result > 0) ? "Successfully removed":"Error removing";
            $this->view->show("user/userdetail.php", ['mode' => 'add', 'message' => $message]);
        } else {
            $message = "Invalid data";
            $this->view->show("user/userdetail.php", ['mode' => 'add', 'message' => $message]);
        }
    } 
    
    /* ============== CATEGORY MANAGEMENT CONTROL METHODS ============== */

    /**
     * displays category management page.
     */
    public function doCategoryMng() {
		//TODO
        $result = $this->model->findAllCategories();
        $this->view->show("category/categorymanage.php", ['list' => $result]);
    }

    /* ============== PRODUCT MANAGEMENT CONTROL METHODS ============== */

    /**
     * displays product management page.
     */
    public function doProductMng() {
        $result = $this->model->findAllProducts();
        $this->view->show("product/productmanage.php", ['list' => $result]);
    }

    public function doProductEditForm(string $mode) {
        $data = array();
        if ($mode != 'product/add') {
            //fetch data for selected user
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            if (($id !== false) && (!is_null($id))) {
                $product = $this->model->findProductById($id);
                if (!is_null($product)) {
                    $data['product'] = $product;
                }
             }
             $data['mode'] = $mode;
        }
        $this->view->show("product/productedit.php", $data);  //initial prototype version.
    }

	public function doProductModify() {
		$product = Validator::validateProduct(INPUT_POST);
        //add product to database
		if (!is_null($product)) {
			try {
				$result = $this->model->modifyProduct($product);
				$message = ($result > 0) ? "Successfully modified":"Error modifying";
			} catch (\PDOException $e) {
				$message = $e->getMessage();
			}
            $this->view->show("product/productedit.php", ['mode' => 'add', 'message' => $message]);
        } else {
            $message = "Invalid data";
            $this->view->show("product/productedit.php", ['mode' => 'add', 'message' => $message]);
        }
	}

    public function doProductAdd() {
        //get product data from form and validate
        $product = Validator::validateProduct(INPUT_POST);
        //add product to database
		if (!is_null($product)) {
			try {
				$result = $this->model->addProduct($product);
				$message = ($result > 0) ? "Successfully added":"Error adding";
			} catch (\PDOException $e) {
				$errcode = $e->getCode();
				switch ($errcode) {
					case 2300:
						$message = 'Category ID out of range.';
						break;
					default:
						$message = "Error adding";
						break;
				}
			}
            $this->view->show("product/productedit.php", ['mode' => 'add', 'message' => $message]);
        } else {
            $message = "Invalid data";
            $this->view->show("product/productedit.php", ['mode' => 'add', 'message' => $message]);
        }
    }

	public function doConfirmProdRemove() {
        $data = array();
		//fetch data for selected user
		$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
		if (($id !== false) && (!is_null($id))) {
			$product = $this->model->findProductById($id);
			if (!is_null($product)) {
				$data['product'] = $product;
			}
		}
        $this->view->show("product/proddelconfirm.php", $data);
	}

    public function doProductRemove() {
        //get product data from form and validate
        $product = Validator::validateProduct(INPUT_POST);
        //add product to database
        if (!is_null($product)) {
            $result = $this->model->removeProduct($product);
            $message = ($result > 0) ? "Successfully removed":"Error removing";
			$prodList = $this->model->findAllProducts();
            $this->view->show("product/productmanage.php", ['message' => $message, 'list' => $prodList]);
        } else {
            $message = "Invalid data";
			$prodList = $this->model->findAllProducts();
            $this->view->show("product/productmanage.php", ['message' => $message, 'list' => $prodList]);
        }
    } 

	/* ============== STOCK AND WAREHOUSE METHODS ============== */

    /**
     * displays warehouse management page.
     */
    public function doWarehouseMng() {
        $result = $this->model->findAllWarehouses();
        $this->view->show("warehouse/warehousemanage.php", ['list' => $result]);
	}

	/**
	 * shows stock on a specific warehouse or product
	 */
	public function doShowStocks(string $var2fetch = "id") {
		// next var gets the id of either warehouse or product
		$id = filter_input(INPUT_GET, $var2fetch, FILTER_VALIDATE_INT);
		switch ($var2fetch) {
			case 'id':
				$product = $this->model->findProductById($id);
				if (!is_null($product)) {
					$data['stocks'] = $this->model->findStocksByProduct($product);
					$data['mode'] = 'product';
					$data['product'] = $product;
				} else {
					$data['message'] = 'Product not found';
				}
				break;

			case 'wid':
				$warehouse = $this->model->findWarehouseById($id);
				if (!is_null($warehouse)) {
					$data['stocks'] = $this->model->findStocksByWarehouse($warehouse);
					$data['mode'] = 'warehouse';
					$data['warehouse'] = $warehouse;
				} else {
					$data['message'] = 'Warehouse not found';
				}
				break;
			
			default:
				$data['message'] = 'Something went wrong!';
				break;
		}
		$this->view->show('stocks/stocksmgr.php', $data);
	}
    
}
