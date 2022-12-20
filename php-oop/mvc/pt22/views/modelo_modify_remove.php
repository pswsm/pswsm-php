<?php
public function removeProduct(Product $product): int {
        $numAffected = 0;
        if ($product != null) {
            $numAffected = $this->productDao->delete($product);
        }
        return $numAffected;
    }  


    public function modifyProduct(Product $product): int {
        $numAffected = 0;
        if ($product != null) {
            $numAffected = $this->productDao->update($product);
        }
        return $numAffected;
    }
    


    public function removeUser(User $user): int {
        $numAffected = 0;
        if ($user != null) {
            $numAffected = $this->userDao->delete($user);
        }
        return $numAffected;
    }  


    public function modifyUser(User $user): int {
        $numAffected = 0;
        if ($user != null) {
            $numAffected = $this->userDao->update($user);
        }
        return $numAffected;
    }