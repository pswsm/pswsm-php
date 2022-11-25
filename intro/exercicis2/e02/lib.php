<?php namespace pswsm\tapwater {
/**
 * calculates the volume of a cylinder with the given radius and height
 * @param float $radius the radius of the cylinder
 * @param float $height the height of the cylinder
 * @return float the volume of the cylinder
 */
function cylinderVolume(float $radius, float $height): float {
    return \M_PI * $radius * $radius * $height;
}

/**
 * calculates time to fill given volume at given ratio
 * @param float $volume the volume of the recipient in m3
 * @param float $rate the filling rate in m3/h
 * @return float the time to fill in hours
 * @throws \Exception if rate is zero
 */
function fillingTime(float $volume, float $rate): float {
    if ($rate == 0.0) {
        throw new \Exception("rate is zero");
    }
    return $volume / $rate;
}
}?>
