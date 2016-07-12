<?php

Route::group([], function () {
    Route::get('/', 'WelcomeController@welcome');
    Route::controller('service', 'ImgController');
    Route::get('/file/{any}', 'ImgController@putFile');
});
