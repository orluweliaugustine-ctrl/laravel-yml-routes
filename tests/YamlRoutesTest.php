<?php

namespace Broswilli\LaravelYmlRoutes\Tests;

use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Route;
use Broswilli\LaravelYmlRoutes\LaravelYmlRoutesServiceProvider;
use Broswilli\LaravelYmlRoutes\LaravelYmlRoutesFacade;

class YamlRoutesTest extends TestCase   
{

    protected function getPackageProviders($app)
    {
        return [
            LaravelYmlRoutesServiceProvider::class,
        ];
        
    }

    protected function getPackageAliases($app)
    {
        return [
            "LaravelYmlRoutes" => LaravelYmlRoutesFacade::class,
        ];
        
    }

    public function test_it_creates_routes_from_yaml()
    {
        $this->get('/front/test')
             ->assertStatus(200);
    }

    public function test_it_creates_resource_route_from_yaml()
    {
        $this->get('front/resc')
             ->assertStatus(200);
        
        $this->get('front/resc/create')
             ->assertStatus(200);
        
        $this->get('front/resc/1',)
             ->assertStatus(200);

        $this->get('front/resc/1/edit',)
             ->assertStatus(200);
        
        $response = $this->post('front/resc', [
                        'sample'=> 'sample',
                    ]);
        $response->assertStatus(302);

        $response = $this->put('front/resc/1', [
            'sample'=> 'sample',
        ]);
        $response->assertStatus(302);

        $response = $this->delete('front/resc/1');
        $response->assertStatus(302);
    }

    public function test_it_creates_invokable_controller_route_from_yaml()
    {
        $this->get('front/invoke')
             ->assertStatus(200);
    }

    public function test_it_creates_prefixed_route_name()
    {
        $this->get(route('admin.admin-index'))
             ->assertStatus(200);
    }

    public function test_it_creates_routes_from_root_yml_file()
    {
        $this->get(route('resource_3'))
             ->assertStatus(200);

        $this->get('/root-invoke')
             ->assertStatus(200);
    }

    public function test_it_creates_api_resource_route_from_yaml()
    {
        $this->get('front/api')
             ->assertStatus(200);
        
        $this->get('front/api/1',)
             ->assertStatus(200);

        $this->get('front/api/1/edit',['Content-Type' => 'application/json'])
             ->assertStatus(404);
        
        $response = $this->post('front/api', [
                        'sample'=> 'sample',
                    ]);
        $response->assertStatus(302);

        $response = $this->put('front/api/1', [
            'sample'=> 'sample',
        ]);
        $response->assertStatus(302);

        $response = $this->delete('front/api/1');
        $response->assertStatus(302);
    }


}