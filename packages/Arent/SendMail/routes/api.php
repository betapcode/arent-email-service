<?php

use Illuminate\Routing\Router;

/** @var Router $router */

Route::group(['prefix' => '/v1/arent', 'namespace' => 'Arent\SendMail\Http\Controllers\Api'], function (Router $router) {
    $router->post('sendmail', [
        'as' => 'api.arent.sendmail',
        'uses' => 'SendMailApiController@sendMailProcess',
    ]);
});
