<?php
require_once 'lib/Renderer.php';
require_once 'model/Warehouse.php';
use proven\store\model\Warehouse;
echo "<p>Warehouse detail page</p>";
$message = $params['message'] ?? "";
printf("<p>%s</p>", $message);
$warehouse = $params['warehouse'] ?? new Warehouse();
echo "<form method='post' action=\"index.php\">";
echo proven\lib\views\Renderer::renderWarehouseFields($warehouse);
echo "<button class='btn btn-warning' type='submit' name='action' value='warehouse/modify'>Modify</button>";
echo "</form>";
