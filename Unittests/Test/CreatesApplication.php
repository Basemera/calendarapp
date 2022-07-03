<?php

namespace Unittests\Test;

use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        // $app = require __DIR__.'/../bootstrap/app.php';
        $app = require __DIR__.'/../../bootstrap.php';

        // $app->make(Kernel::class)->bootstrap();
        print_r($app);
        return $app;
    }
}