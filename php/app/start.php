<?php


use Aws\S3\S3Client;

require 'vendor/autoload.php';

$config = require('config.php');

$php = S3Client::factory([
     'key' => $config['php']['key'],
	 'secret' => $config['php']['secret']
]);