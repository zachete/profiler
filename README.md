# Profiler

This is a tiny PHP class, that makes easy to code profiling.

## Installation
```bash
composer require zachete/profiler
```

## Usage
```php
<?php

use Zachete\Profiler;

$profiler = new Profiler();

$profiler->label('Sleep for 1 second');
sleep(1);

$profiler->label('Sleep for 2 seconds');
sleep(3);

$profiler->get('Sleep for 1 seconds'); // return ~ 4.004
$profiler->get('Sleep for 2 seconds'); // return ~ 3.002
```

Additionally, you can provide cloure to the constructor, that will call at any time, when get method is called. It may be usefull for logging. Here is example for Laravel logging:

Bind profiler instance inside AppServiceProvider.php
```php
public function register() {
    $this->app->instance('Profiler', new Profiler([
        'logging_function' => function($labelName, $value) {
            info("Profile {$labelName} with {$value} seconds");
        }
    ]));
}
```

Use profiler inside controller
```php
// some method
public function someMethod(Profiler $profiler) {
    $profiler->label('some label');

    sleep(4);

    // The code below will also log result
    // using info() method with a provided string
    // ("Profile some label with 4.004 seconds")

    $profiler->get('some label');
}
```

