<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
try {
    $kernel->call('migrate');
} catch (\Throwable $e) {
    file_put_contents('err.txt', $e->getMessage());
}
