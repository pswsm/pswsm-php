<?php
require_once 'model/User.php';
require_once 'model/persist/UserPersistFileDao.php';

/**
 * Description of UserFormValidation
 * Provides validation to get data from User form.
 * @author ProvenSoft
 */
class UserFormValidation {
    
    /**
     * validates and gets data from User form.
     * @return User the User with the given data or null if data is not present and valid.
     */
	public static function getData() {
		$fileDao = new UserPersistFileDao('files/users.txt', ';');
        $UserObj = null;
        $id = $fileDao->getNextId() + 1;

        $username = "";
        //retrieve id sent by client.
        if (filter_has_var(INPUT_POST, 'username')) {
            $username = htmlspecialchars($_POST['username']); 
        }
        $password = "";
        //retrieve User sent by client.
        if (filter_has_var(INPUT_POST, 'password')) {
            $password = htmlspecialchars($_POST['password']); 
        }
        $name = "";
        //retrieve User sent by client.
        if (filter_has_var(INPUT_POST, 'name')) {
            $name = htmlspecialchars($_POST['name']);
        }
        $surname = "";
        //retrieve User sent by client.
        if (filter_has_var(INPUT_POST, 'surname')) {
            $surname = htmlspecialchars($_POST['surname']); 
        }
        //if (!empty($id) && !empty($password) && !empty($name)) { 
            //they exists and they are not empty
            $UserObj = new User($id, $username, $password, 'registered', $name, $surname);
        //}
        return $UserObj;
    }
    
    /**
	 * retrieves and validates the data from the login form
	 * @return array This array: [username => ..., password => ...]
     */
	public static function getLoginData() {
		$fileDao = new UserPersistFileDao('files/users.txt', ';');
        $UserObj = null;
        $id = $fileDao->getNextId() + 1;

        $username = "";
        //retrieve id sent by client.
        if (filter_has_var(INPUT_POST, 'username')) {
            $username = htmlspecialchars($_POST['username']); 
        }
        $password = "";
        //retrieve User sent by client.
        if (filter_has_var(INPUT_POST, 'password')) {
            $password = htmlspecialchars($_POST['password']); 
        }
        $name = "";
        //retrieve User sent by client.
        if (filter_has_var(INPUT_POST, 'name')) {
            $name = htmlspecialchars($_POST['name']);
        }
        $surname = "";
        //retrieve User sent by client.
        if (filter_has_var(INPUT_POST, 'surname')) {
            $surname = htmlspecialchars($_POST['surname']); 
        }
        //if (!empty($id) && !empty($password) && !empty($name)) { 
            //they exists and they are not empty
            $UserObj = new User($id, $username, $password, 'registered', $name, $surname);
        //}
        return $UserObj;
    }
    
}
