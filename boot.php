<?php

define('ROOT_PATH', realpath(__DIR__));

define('PROJECT', 'project');
define('PROJECT_PATH', ROOT_PATH . '/src/' . PROJECT);
define('PROJECT_NS', ucfirst(strtolower(PROJECT)));


// --------------------------------------------------------
// src/laravel/bootstrap/autoload.php:
// --------------------------------------------------------
define('LARAVEL_START', microtime(true));

$autoloader = require __DIR__ . '/src/vendor/autoload.php';

$compiledPath = __DIR__ . '/src/laravel/bootstrap/cache/compiled.php';

if (file_exists($compiledPath)) {
    require $compiledPath;
}

// -----
$autoloader->addPsr4(PROJECT_NS.'\\', PROJECT_PATH);
// -----

// --------------------------------------------------------
// src/laravel/bootstrap/app.php:
// --------------------------------------------------------

$app = new Illuminate\Foundation\Application(
    realpath(__DIR__ . '/src/laravel/')
);

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);


// --------------------------------------------------------
// src/laravel/public/index.php:
// --------------------------------------------------------

if ($app->runningInConsole()) {
    // Load artisan kernel
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

    $status = $kernel->handle(
        $input = new Symfony\Component\Console\Input\ArgvInput,
        new Symfony\Component\Console\Output\ConsoleOutput
    );
    $kernel->terminate($input, $status);

    exit($status);

} else {
    // Continue with default http kernel
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

    $response = $kernel->handle(
        $request = Illuminate\Http\Request::capture()
    );

    $response->send();

    $kernel->terminate($request, $response);
}
