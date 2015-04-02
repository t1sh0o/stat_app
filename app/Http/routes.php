<?php

get('/', [
    'as' => 'home',
    'uses' => 'PagesController@home'
]);

post('/generate', [
    'as' => 'generate',
    'uses' => 'ProfilesController@generate'
]);

post('get_rating', [
    'as' => 'get_rating',
    'uses' => 'ProfilesController@getRating'
]);

get('/quartile', [
    'as' => 'get_quartile_stat',
    'uses' => 'StatsController@quartile'
]);


get('/rating', [
    'as' => 'get_rating_stat',
    'uses' => 'StatsController@rating'
]);