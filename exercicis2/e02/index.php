<?php
include "lib.php";
if (isset($_POST['submit'])) { 
    $cylRadius = \filter_input(\INPUT_POST, 'cylRadius', \FILTER_SANITIZE_NUMBER_FLOAT, \FILTER_FLAG_ALLOW_FRACTION);
    $cylRadius = \filter_var($cylRadius, \FILTER_VALIDATE_FLOAT);
    $cylHeight = \filter_input(\INPUT_POST, 'cylHeight', \FILTER_SANITIZE_NUMBER_FLOAT, \FILTER_FLAG_ALLOW_FRACTION);
    $cylHeight = \filter_var($cylHeight, \FILTER_VALIDATE_FLOAT);
    $tapRate = \filter_input(\INPUT_POST, 'tapRate', \FILTER_SANITIZE_NUMBER_FLOAT, \FILTER_FLAG_ALLOW_FRACTION);
    $tapRate = \filter_var($tapRate, \FILTER_VALIDATE_FLOAT);
    $validData = !(($cylRadius === false) || ($cylHeight === false) || ($tapRate === false));
    if ($validData !== false) {
        $cylVolume = \pswsm\tapwater\cylinderVolume($cylRadius, $cylHeight);
        try {
            $timeLapseToCloseTap = \pswsm\tapwater\fillingTime($cylVolume, $tapRate);
            $timeLapseToCloseTapInSeconds = \intval($timeLapseToCloseTap * 60 * 60);
            $timeToCloseTap = new \DateTime("now");
            $dateInterval = new \DateInterval("PT{$timeLapseToCloseTapInSeconds}S");
            $timeToCloseTap->add($dateInterval);
            $formattedTimetoCloseTap = $timeToCloseTap->format("Y-m-d H:i:s");
        } catch (\Exception $ex) {
            $message = "Rate should not be zero";
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cylinder and tap</title>
        <style>
            div.labelinput {display: block; clear: both;}
            label {display: inline; float: left; min-width: 15em;}
            input, span {display: inline; float: left}
            span {margin-left: 1em;}
            .error {display: inline; color: darkred; font-style: italic;}
            span.hidden {display: none;}
        </style>
    </head>
    <body>
        <h2>Cylinder filling calculations</h2>
        <form action="<?php echo \htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <fieldset>
                <legend>Cylinder and tap data</legend>
                <div class="labelinput">
                    <label for="cylRadius">Cylinder radius (in meters): </label> 
                    <input type="text" name="cylRadius" value="<?php echo $cylRadius ?? ""; ?>" placeholder="input radius of the cylinder" required autofocus />
                    <span class="<?php echo ($cylRadius === false) ? 'error' : 'hidden'; ?>">Invalid value</span>
                </div> 
                <div class="labelinput">
                    <label for="cylHeight">Cylinder height (in meters): </label>
                    <input type="text" name="cylHeight" value="<?php echo $cylHeight ?? ""; ?>" placeholder="input height of the cylinder" required />
                    <span class="<?php echo ($cylHeight === false) ? 'error' : 'hidden'; ?>">Invalid value</span>
                </div> 
                <div class="labelinput">
                    <label for="tapRate">Tap output rate (in m<sup>3</sup>/h): </label>
                    <input type="text" name="tapRate" value="<?php echo $tapRate ?? ""; ?>" placeholder="input rate of the tap" required />
                    <span class="<?php echo ($tapRate === false) ? 'error' : 'hidden'; ?>">Invalid value</span>
                </div> 
                <div class="labelinput">
                    <button type="submit" name="submit" value="sent">Submit</button>
                </div>
            </fieldset>
            <fieldset>
                <legend>Results</legend>
                <div class="labelinput">
                    <label for="timeLapseToCloseTap">Time until cylinder is full (in hours): </label>
                    <input type="text" name="timeLapseToCloseTap" readonly value="<?php echo $timeLapseToCloseTap ?? ""; ?>" />
                </div>
                <div class="labelinput">
                    <label for="timeToCloseTap">Close tap at time (year-month-day hh/mm/ss): </label>
                    <input type="text" name="timeToCloseTap" readonly value="<?php echo $formattedTimetoCloseTap ?? ""; ?>" />
                </div>
            </fieldset>
        </form>
        <p class="error"><?php echo $message ?? "" ?></p>
    </body>
</html>
