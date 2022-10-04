<?php

namespace pswsm\patates;

//array of drinks and prices
$preus_patata = [
    '25kg' => 1.0,
    '50kg' => 16.5,
    '75kg' => 55.0,
    '100kg' => 190.0,
    '125kg' => 300.0
];

/**
 * get all drinks
 * @global array $drinkFare the array to get keys from
 * @return array of keys with drink names
 */
function getPatates(): array {
    global $preus_patata;
    return array_keys($preus_patata);
}

/**
 * gets the price of the given drink
 * @global array $drinkFare the array to search in
 * @param string $drink the drink name to search
 * @return float the price of the drink
 * @throws \Exception if drink is not found
 */
function getPatatesPrice(string $quilos): float {
    global $preus_patata;
    $preu_final = 0.0;
    if (array_key_exists($quilos, $preus_patata)) {
        $preu_final = $preus_patata[$quilos];
    } else {
        throw new \Exception("Massa quilos", -1);
    }
    return $preus_patata[$quilos];
}
