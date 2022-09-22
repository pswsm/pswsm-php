<?php namespace pswsm\ages {
/**
 * return what a person whould be doing with given age
 * @param $age integer holding the age
 */
function age_match(int $age): string {
    $result = "";
    if ($age > 60) {
        $result = "retired";
    } else if ($age > 18) {
        $result = "worker";
    } else if ($age < 18) {
        $result = "student";
    };
    return $result;
}
}?>
