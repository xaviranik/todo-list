<?php
require_once(__DIR__ . '/vendor/autoload.php');

//General Headers for API
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

//Creating DB Instance
$db = new Database();