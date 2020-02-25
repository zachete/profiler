<?php
require_once('vendor/autoload.php');

use Zachete\Profiler;

$profiler = new Profiler();

$profiler->label('Sleep for 1 second');
sleep(1);

$profiler->label('Sleep for 2 seconds');
sleep(3);

$profiler->get('Sleep for 1 seconds'); // return ~ 4.004
$profiler->get('Sleep for 2 seconds'); // return ~ 3.002