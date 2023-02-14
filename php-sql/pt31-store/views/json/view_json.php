<?php
require_once 'model/User.php';
use proven\store\model\User;

$data = $params['data'];

echo json_encode($data, JSON_FORCE_OBJECT);
