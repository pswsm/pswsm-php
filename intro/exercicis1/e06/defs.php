<?php namespace pswsm\dates {
function get_detail_age(string $bornDate): string {
    $currentDate = new \DateTime(); //>format("Y-m-d");
    return date_diff(new \DateTime($bornDate), $currentDate)->format("%Y-%m-%d");
}
}?>
