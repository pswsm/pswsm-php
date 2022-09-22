<?php namespace pswsm\bmi {
/**
 * calculates BMI with given weight and height, and returns an array with the BMI and the classification
 * @param $kg float with the weight
 * @param $metres float with the height in metres
 */
function bmi_calc(int $kg, float $metres): array {
    echo "<p>Weight: ", $kg, "</p><p>Height: ", $metres, "</p>";
    $bmi = $kg / $metres ** 2;
    $state = "";
    if ($bmi < 16.6) {
        $state = "severely underweight";
    } else if ($bmi < 18.6) {
        $state = "underweight";
    } else if ($bmi < 26) {
        $state = "healthy";
    } else if ($bmi < 31) {
        $state = "overweight";
    } else {
        $state = "morbid";
    };
    return [$bmi, $state];
}
}?>
