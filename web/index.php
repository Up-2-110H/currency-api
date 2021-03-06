<?php
require __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../config/env.php';

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', (bool) getenv('YII_DEBUG'));
defined('YII_ENV') or define('YII_ENV', getenv('YII_ENV'));

require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
