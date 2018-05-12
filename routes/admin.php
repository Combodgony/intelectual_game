<?php

// Backpack\CRUD: Define the resources for the entities you want to CRUD.
Route::get('championship/{id}/view', 'ChampionshipCrudController@view');
Route::get('game/{id}/generate_scenario', 'GameCrudController@generate_scenario');


CRUD::resource('user', 'UserCrudController');
CRUD::resource('round', 'RoundCrudController');
CRUD::resource('question', 'QuestionCrudController');
CRUD::resource('gamer', 'GamerCrudController');
CRUD::resource('command', 'CommandCrudController');
CRUD::resource('championship', 'ChampionshipCrudController');
CRUD::resource('game', 'GameCrudController');