<?php
    public function removeProduct() {
        $product = ProductFormValidation::getData();
        $result = null;
        if (is_null($product)) {
            $result = "Error reading product";
        } else {
            $numAffected = $this->model->removeProduct($product);
            if ($numAffected>0) {
                $result = "product successfully removed";
            } else {
                $result = "Error removing product";
            }
        }
        //pass data to template.
        $data['result'] = $result;
        //show the template with the given data.
        $this->view->show("productform.php", $data);          
    }

    public function modifyProduct() {
        $product = ProductFormValidation::getData();
        $result = null;
        if (is_null($product)) {
            $result = "Error reading product";
        } else {
            $numAffected = $this->model->modifyProduct($product);
            if ($numAffected>0) {
                $result = "product successfully modified";
            } else {
                $result = "Error modifying product";
            }            
        }
        //pass data to template.
        $data['result'] = $result;
        //show the template with the given data.
        $this->view->show("productform.php", $data);        
    }





    public function removeUser() {
        $user = UserFormValidation::getData();
        $result = null;
        if (is_null($user)) {
            $result = "Error reading user";
        } else {
            $numAffected = $this->model->removeUser($user);
            if ($numAffected>0) {
                $result = "user successfully removed";
            } else {
                $result = "Error removing user";
            }
        }
        //pass data to template.
        $data['result'] = $result;
        //show the template with the given data.
        $this->view->show("userform.php", $data);          
    }

    public function modifyUser() {
        $user = UserFormValidation::getData();
        $result = null;
        if (is_null($user)) {
            $result = "Error reading user";
        } else {
            $numAffected = $this->model->modifyUser($user);
            if ($numAffected>0) {
                $result = "user successfully modified";
            } else {
                $result = "Error modifying user";
            }            
        }
        //pass data to template.
        $data['result'] = $result;
        //show the template with the given data.
        $this->view->show("userform.php", $data);        
    }
