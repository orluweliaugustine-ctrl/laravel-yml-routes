<?php

namespace Broswilli\LaravelYmlRoutes;

use Symfony\Component\Yaml\Yaml;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;

class LaravelYmlRoutes
{
    protected $rootYamlFile;

    public function __construct()
    {
        $this->rootYamlFile = Config::get('laravel-yml-routes.routes_dir').'root.yaml';
    }

    public function createRoutes()
    {
        $this->processYamlFileToRoute();
    }

    private function processYamlFileToRoute()
    {
        $parsed = Yaml::parseFile($this->rootYamlFile);
        $this->createRoutesFromArray($parsed);
    }

    private function createRoutesFromArray(array $yamlArray)
    {
        foreach ($yamlArray as $key => $value) {
            if (array_key_exists('file', $value) && array_key_exists('name', $value)) {
                $this->createPrefixedRouteName([$key => $value]);
            } elseif (array_key_exists('file', $value)) {
                $this->createGroupedRoutes([$key => $value]);
            } else {
                $this->createNormalRoutes([$key => $value]);
            }
        }
    }

    private function createPrefixedRouteName(array $route)
    {

        $key = key($route);
        $value = $route[$key];
        $name = $value['name'];

        Route::name($name.'.')->group(function () use ($route) {
            $this->createGroupedRoutes($route);
        });
    }

    private function createGroupedRoutes(array $route)
    {
        $key = key($route);
        $value = $route[$key];
        $yamlPath = $this->getPath($value['file']);
        $parsed = Yaml::parseFile($yamlPath);
        if (array_key_exists('prefix', $value) && array_key_exists('middleware', $value)) {
            Route::prefix($value['prefix'])->group(function () use ($parsed, $value) {
                Route::middleware($value['middleware'])->group(function () use ($parsed) {
                    $this->createRoutesFromArray($parsed);
                });
            });
        } elseif (array_key_exists('prefix', $value) && !array_key_exists('middleware', $value)) {
            Route::prefix($value['prefix'])->group(function () use ($parsed) {
                $this->createRoutesFromArray($parsed);
            });
        } elseif (array_key_exists('middleware', $value) && !array_key_exists('prefix', $value)) {
            Route::middleware($value['middleware'])->group(function () use ($parsed) {
                $this->createRoutesFromArray($parsed);
            });
        } else {
            $this->createRoutesFromArray($parsed);
        }
    }

    private function createNormalRoutes(array $route)
    {
        $name = key($route);
        $value = $route[$name];
        $path = $value['path'];
        $controller = $value['controller'];
        foreach ($value['methods'] as $method) {
            if (count($controller) > 1) {
                Route::$method($path, [$controller[0], $controller[1]])->name($name);
            } else {
                if ($method === 'resource' || $method === 'apiResource') {
                    Route::$method($path, $controller[0]);
                } else {
                    Route::name($name)->group(function () use ($path, $method, $controller) {
                        Route::$method($path, $controller[0]);
                    });
                }
            }
        }
    }

    private function getPath($file = null)
    {
        $yamlPath = '';
        $baseDir = Config::get('laravel-yml-routes.routes_dir');
        
        if ($file) {
            $yamlPath = $baseDir.$file;
        } else {
            $yamlPath = $baseDir.'root.yaml';
        }

        return $yamlPath;
    }
}
