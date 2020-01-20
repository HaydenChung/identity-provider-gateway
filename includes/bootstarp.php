<?php
// Load Configs and classes
$files=array(
  'autoload'  =>'/../vendor/autoload.php',
);
foreach($files as $fileKey => $file){
    if(file_exists (__DIR__ . $file )){
      try {
        include_once(__DIR__ . $file);
      } catch(Exception $err) {
      }
    } else {
  }
}

// use IPG\Config\DevConfig;

// $devConfig = new DevConfig;
// Config::getInstance($devConfig);