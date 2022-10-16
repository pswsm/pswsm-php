<?php
// https://www.php.net/manual/en/filter.filters.sanitize.php
// El filtre FILTER_SANITIZE_STRING s'ha deprecat en favor de la funcio htmlspecialchars()

include_once "lib.php";
use pswsm\chooseFile as cf;

if (filter_has_var(INPUT_POST, "submit")) {
	$wordsList = cf\listWords(htmlspecialchars($_POST["files"]));
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Llegir el fitxer seleccionat</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<body>
	<div class="columns">
		<div class="column"></div>
		<div class="column is-two-thirds">
			<div class="box">
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
					<p class="is-size-4 has-text-centered">Llegir el fitxer seleccionat</p><br>
					<div class="field">
						<div class="control">
							<select id="files" name="files">
							<?php echo cf\createOptions(cf\listFiles(FILES_DIR)) ?>
							</select>
						</div>
					</div>
					<div class="field is-grouped">
						<div class="control">
							<input id="submit" class="button" type="submit" name="submit">
							<input class="button" type="reset">
						</div>
					</div>
				</form>
			</div>
			<div class="container">
			<?php $dom = (isset($wordsList)) ? cf\createListing($wordsList) : "" ; echo $dom; ?>
			</div>
		</div>
		<div class="column"></div>
	</div>
</body>
</html>
