<?php

Route::post('/pages', 'CrawlerController@fetch');
Route::get('/pages/{id}', 'CrawlerController@show');