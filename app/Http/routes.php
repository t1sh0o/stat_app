<?php

get('/', [
    'as' => 'home',
    'uses' => 'PagesController@home'
]);

post('/generate', [
    'as' => 'generate',
    'uses' => 'ProfilesController@generate'
]);