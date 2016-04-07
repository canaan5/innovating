<?php

$router->get('/', ["Home", "index"]);

$router->get('/kesty/{name}/{id}', ["User", "single"]);

$router->get('/user/{id}', function ($id) {
    return $id;
});

$router->get('/user/{id}/{name}', function ($id, $name) {
    return $id .' and '. $name;
});

$router->group(['prefix' => 'blog', 'namespace' => "Blog"], function() use ($router) {

    $router->get('/', ['Blog', 'index']);

    $router->get('post/{id}', ['Blog', 'single']);

});

$router->group(['prefix' => 'test'], function() use ($router) {

    $router->get('', function() {
        return "testing";
    });
});
