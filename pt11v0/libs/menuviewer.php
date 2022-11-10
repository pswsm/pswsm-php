<?php namespace practica\dom {
define('MENUFIELDS', ['id', 'category', 'name', 'price']);

/*
 * Fetches the categories
 *
 * @param $db optional Where are the categories
 * @return array The array with the categories
 */
function getCategories(string $db = "./db/categories.txt"): array {
	$allHeaders = file($db, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	return $allHeaders;
}

/*
 * Makes the DOM for the Day Menu menu
 *
 * @param $db optional Where is the Day Menu
 * @return string The DOM
 */
function mkDayMenu(string $db = "./db/daymenu.txt"): string {
	$dom = '<ul>';
	/*
	 * $appetiserDom = '<li><ul><b>Entrants</b>' ;
	 * $fcoursesDom = '<li><ul><b>Primers plats</b>';
	 * $mcoursesDom = '<li><ul><b>Segons plats</b>';
	 * $drinkDom = '<li><ul><b>Begudes</b>';
	 */
	$initiatorArray = [
		'<li><ul><b>Entrants</b>',
		'<li><ul><b>Primers plats</b>',
		'<li><ul><b>Segons plats</b>',
		'<li><ul><b>Postres</b>',
		'<li><ul><b>Begudes</b>'
	];
	$cats = getCategories();
	for ($i=0; $i < count($cats); $i++) { 
		$catsDom[$cats[$i]] = $initiatorArray[$i];
	}
	if (is_readable($db)) {
		$fh = fopen($db, "r");
		while (!feof($fh)) {
			$line = fgetcsv($fh, separator: ";");
			if ($line != false) {
				for ($i=0; $i < count($line); $i++) { 
					$line_kv[MENUFIELDS[$i]] = $line[$i];
				}
				foreach ($catsDom as $cat => $dom) {
					if ($line_kv['category'] == $cat) {
						$catsDom[$cat] = $dom . '<li>' . ucfirst($line_kv['name']) . '--' . $line_kv['price'] . '€</li>';
					}
				}
				/*switch ($line_kv['category']) {
					case 'appetiser':
						$appetiserDom = $appetiserDom . "<li>" . ucfirst($line_kv['name']) . ' -- ' . $line_kv['price'] . '€</li>';
						break;
					
					case 'firstcourse':
						$fcoursesDom = $fcoursesDom . "<li>" . ucfirst($line_kv['name']) . ' -- ' . $line_kv['price'] . '€</li>';
						break;
					
					case 'maincourse':
						$mcoursesDom = $mcoursesDom . "<li>" . ucfirst($line_kv['name']) . ' -- ' . $line_kv['price'] . '€</li>';
						break;
					
					case 'drink':
						$drinkDom = $drinkDom . "<li>" . ucfirst($line_kv['name']) . ' -- ' . $line_kv['price'] . '€</li>';
						break;
					
					default:
						break;
				}*/
			}
		}
		fclose($fh);
		/*
		$appetiserDom = $appetiserDom . '</li></ul>';
		$drinkDom = $drinkDom . '</li></ul>';
		$fcoursesDom = $fcoursesDom . '</li></ul>';
		$mcoursesDom = $mcoursesDom . '</li></ul>';
		$dom = $dom . $appetiserDom . $fcoursesDom . $mcoursesDom . $drinkDom . '</ul>';
		return $dom;*/
	}
	/*
	$appetiserDom = $appetiserDom . '</li></ul>';
	$drinkDom = $drinkDom . '</li></ul>';
	$fcoursesDom = $fcoursesDom . '</li></ul>';
	$mcoursesDom = $mcoursesDom . '</li></ul>';
	$dom = $dom . $appetiserDom . $fcoursesDom . $mcoursesDom . $drinkDom . '</ul>';
	return $dom;
	 */
	foreach ($catsDom as $cat => $catDom) {
		$catsDom[$cat] = $catDom . '</ul>';
	}
	$dom = $dom . implode('', $catsDom);
	return $dom;
}

/*
 * Makes the DOM for the View Menu menu
 *
 * @param $db optional Where is the  menu
 * @return string The DOM
 */
function mkViewMenu(string $db = "./db/menu.txt"): string {
	$dom = '<div class="container">';
	$table = '';
	$headers = '<tr>';
	foreach (MENUFIELDS as $field) {
		if ($field != "category") {
			$headers = $headers . "<th>$field</th>";
		}
	}
	$headers = $headers . '</tr>';
	foreach (getCategories() as $category) {
		$table = $table . "<h3>" . ucfirst($category) . "</h3><table class='table table-bordered table-condensed'><thead>$headers</thead><tbody>";
		if (is_readable($db)) {
			$fh = fopen($db, "r");
			while (!feof($fh)) {
				$line = fgetcsv($fh, separator: ";");
				if ($line != false) {
					for ($i=0; $i < count($line); $i++) { 
						$line_kv[MENUFIELDS[$i]] = $line[$i];
					}
					if ($line_kv['category'] == $category) {
						$table = $table . "<tr><td>" . $line_kv['id'] . "</td><td>" . $line_kv['name'] . "</td><td>" . $line_kv['price'] . "</td></tr>";
					}
				}
			}
			fclose($fh);
		}
		$table = $table . '</tbody></table>';
	}
	return $dom . $table . '</div>';
	//return '<h1>Doesn\'t work as expeceted</h1>';
}
} ?>
