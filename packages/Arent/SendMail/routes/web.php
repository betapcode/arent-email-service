<?php

use Illuminate\Routing\Router;

Route::group([
    'prefix' => 'arent',
    'namespace' => 'Arent\SendMail\Http\Controllers'
], function (Router $router) {
        $router->get('/sendmail', [
            'uses' => 'SendEmailController@index',
        ])->name('arent.sendmail.index');

        $router->post('/sendmail', [
            'uses' => 'SendEmailController@sendMailProcess',
        ])->name('arent.sendmail.sendmail');
    }
);

