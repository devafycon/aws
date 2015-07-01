<?php
require 'php/vendor/autoload.php';

use Aws\S3\S3Client;

$bucket = 'getgifsupload';
$keyname = 'AKIAI5BCDVXHSIIQ2Q3A';
// $filepath should be absolute path to a file on disk						
$filepath = 'logo.png';
						
// Instantiate the client.
$s3 = S3Client::factory();

// Upload a file.
$result = $s3->putObject(array(
    'Bucket'       => $bucket,
    'Key'          => $keyname,
    'SourceFile'   => $filepath,
    'ContentType'  => 'text/plain',
    'ACL'          => 'public-read',
    'StorageClass' => 'REDUCED_REDUNDANCY',
    'Metadata'     => array(    
        'param1' => 'value 1',
        'param2' => 'value 2'
    )
));

echo $result['ObjectURL'];