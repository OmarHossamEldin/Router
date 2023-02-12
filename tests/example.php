<?php

use Reneknox\Router\Route;

Route::get('/start', fn() => 'start');

Route::get('/home', function () {
    return 'Home';
});

Route::post('/resource', fn() => 'resource is created');

Route::get('/posts/{id}', fn() => 'route with params');

Route::get('/posts/{id}/{user}', fn() => 'route with params');

Route::get('/posts/{id}/user', fn() => 'route with params');

Route::get('/posts/{id}/date/{user}/{test}', fn() => 'route with params');