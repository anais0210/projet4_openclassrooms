<?php

const DEFAULT_APP = 'FrontOffice';

if (!isset($_GET['app']) || !file_exists(__DIR__.'/../App/'.$_GET['app'])) {
    $_GET['app'] = DEFAULT_APP;
}

require __DIR__ . '/../App/Config/SplClassLoader.php';

$Loader = new SplClassLoader('App/Config', __DIR__ . '/../App/Config');
$Loader->register();

$appLoader = new SplClassLoader('App', __DIR__.'/..');
$appLoader->register();

$repositoryLoader = new SplClassLoader('Repository', __DIR__ . '/../src/Repository');
$repositoryLoader->register();

$controllerLoader = new SplClassLoader('Controller', __DIR__ . '/../src/Controller');
$controllerLoader->register();

$serviceLoader = new SplClassLoader('Service', __DIR__ . '/../src/Service');
$serviceLoader->register();

$entityLoader = new SplClassLoader('Entity', __DIR__ . '/../src/Entity');
$entityLoader->register();

$formLoader = new SplClassLoader('Form', __DIR__ . '/../src/Form');
$formLoader->register();

$formBuilderLoader = new SplClassLoader('FormBuilder', __DIR__ . '/../src/FormBuilder');
$formBuilderLoader->register();

$appClass = 'App\\'.$_GET['app'].'\\'.$_GET['app'].'Kernel';

$app = new $appClass;
$app->run();