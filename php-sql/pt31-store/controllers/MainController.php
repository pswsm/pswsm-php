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
        $this->view->show("message.php", ['message' => 'Not implemented yet!']);
    }

    /* ============== PRODUCT MANAGEMENT CONTROL METHODS ============== */

    /**
     * displays product management page.
     */
    public function doProductMng() {
        //TODO
        $this->view->show("message.php", ['message' => 'Not implemented yet!']);
    }

    /**
     * displays product management page.
     */
    public function doWarehouseMng() {
        //TODO
        $this->view->show("message.php", ['message' => 'Not implemented yet!']);
    }
    
}
