<?php

use PHPUnit\Framework\TestCase;
use Zachete\Profiler;

final class ProfilerTest extends TestCase 
{
    public function testGetMethod() 
    {
        $profiler = new Profiler();
        $profiler->label('test');

        sleep(1);

        $this->assertEquals(
            floor($profiler->get('test')),
            1
        );
    }

    public function testLoggingFunction() {
        $actualContent = '';
        $tpl = "Profiling %s with %s seconds execution\n";
        $profiler = new Profiler([
            'logging_function' => function($labelName, $microtime) use (&$actualContent, $tpl){
                $actualContent .= sprintf($tpl, $labelName, floor($microtime));
            }
        ]);

        $profiler->label('test1');
        sleep(1);
        $profiler->label('test2');
        sleep(1);

        $expectedContent = sprintf($tpl, 'test1', floor($profiler->get('test1')));
        $expectedContent .= sprintf($tpl, 'test2', floor($profiler->get('test2')));
        
        $this->assertEquals(
            $actualContent,
            $expectedContent
        );
    }
}