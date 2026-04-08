<?php

require __DIR__ . '/vendor/autoload.php';

$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo 'TOTAL=' . App\Models\User::count() . PHP_EOL;

foreach (App\Models\User::orderBy('id')->get(['name', 'email', 'role']) as $user) {
    echo $user->name . ' | ' . $user->email . ' | ' . $user->role . PHP_EOL;
}
