<?php

// Backpack\CRUD: Define the resources for the entities you want to CRUD.
Route::get('championship/{id}/view', 'ChampionshipCrudController@view');


CRUD::resource('user', 'UserCrudController');
CRUD::resource('round', 'RoundCrudController');
CRUD::resource('question', 'QuestionCrudController');
CRUD::resource('gamer', 'GamerCrudController');
CRUD::resource('command', 'CommandCrudController');
CRUD::resource('championship', 'ChampionshipCrudController');