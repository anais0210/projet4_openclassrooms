<?php
const DEFAULT_APP = 'FrontOffice';

if (!isset($_GET['app']) || !file_exists(__DIR__.'/../App/'.$_GET['app'])) $_GET['app'] = DEFAULT_APP;

require __DIR__.'/../config/SplClassLoader.php';

$Loader = new SplClassLoader('App', __DIR__.'/../config');
$Loader->register();

$appLoader = new SplClassLoader('App', __DIR__.'/..');
$appLoader->register();

$modelLoader = new SplClassLoader('Model', __DIR__.'/../vendors');
$modelLoader->register();

$entityLoader = new SplClassLoader('Entity', __DIR__.'/../vendors');
$entityLoader->register();

$formBuilderLoader = new SplClassLoader('FormBuilder', __DIR__.'/../vendors');
$formBuilderLoader->register();


$appClass = 'App\\'.$_GET['app'].'\\'.$_GET['app'].'Kernel';

$app = new $appClass;
$app->run();