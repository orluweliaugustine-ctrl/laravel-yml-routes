<?php

namespace Broswilli\LaravelYmlRoutes\Tests;

use Orchestra\Testbench\TestCase;

class YamlRoutesTest extends TestCase   
{

    public function test_it_creates_routes_from_yaml()
    {
        $this->assertTrue(True);
        $this->get('/front/test')
             ->assertStatus(200);
    }

}