<?php

// Backpack\CRUD: Define the resources for the entities you want to CRUD.
CRUD::resource('user', 'UserCrudController');
CRUD::resource('round', 'RoundCrudController');
CRUD::resource('question', 'QuestionCrudController');
CRUD::resource('gamer', 'GamerCrudController');
CRUD::resource('command', 'CommandCrudController');