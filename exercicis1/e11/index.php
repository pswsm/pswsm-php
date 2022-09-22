<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
<?php
include "nucleotides.php";
$seq = 'ATCGACAGTCTGGGACACGCCTGGCCACG';
$compl_sequence = \pswsm\dna\complement($seq);
if ($compl_sequence != '') {
	echo "Original sequence is: $seq<br>Final sequence is: $compl_sequence";
} else {
	echo '';
}
?>
</body>
</html>
