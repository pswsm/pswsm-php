<?php
	// entry point to web service
	require_once 'controllers/WebServiceController.php';
	use proven\store\controllers\WebServiceController;
	(new WebServiceController())->processRequest();
?>
