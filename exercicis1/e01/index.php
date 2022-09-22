<?php
function make_table(int $table, int $max_number) { 
    echo "<table><th>Table of number ", $table, "</th>";
    for ($k = 0; $k <= $max_number; $k++) {
        echo "<tr><td>", $k, "×", $table, " = ", $k * $table, "</td></tr>";
    }
    echo "</table>";
}

for ($j = 1; $j < 11; $j++) { 
    make_table($j, 10);
}
?>
