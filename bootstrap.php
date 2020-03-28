<?php
require_once(__DIR__ . '/vendor/autoload.php');
//General Headers for API
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

//Creating DB Instance
$db = new Database();