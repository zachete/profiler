<?php

namespace Zachete;

class Profiler {
    protected $loggingFunction;

    public function __construct(array $config = []) 
    {
        $this->loggingFunction = $config['logging_function'] ?? null;
        $this->labels = [];
    }

    public function label(string $name) 
    {
        $this->labels[$name] = microtime(true);
    }

    public function get(string $labelName = '') 
    {
        $startMicrotime = isset($this->labels[$labelName])
            ? $this->labels[$labelName]
            : $_SERVER['REQUEST_TIME_FLOAT'];

        $microtime = microtime(true) - $startMicrotime;
        $result = round($microtime, 3);

        if ($this->loggingFunction) {
            $this->loggingFunction->call($this, $labelName, $result);
        }

        return $result;
    }

    public function setLoggingFunction($function) 
    {
        if (isset($function)) 
        {
            $this->loggingFunction = $function;
        }
    }
}