<?php

namespace App\Http\Controllers\Admin;

use App\Models\Game;
use App\Models\GameQuestion;
use App\Models\Question;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\GameRequest as StoreRequest;
use App\Http\Requests\GameRequest as UpdateRequest;
use Illuminate\Http\Request;

class GameCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Game');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/game');
        $this->crud->setEntityNameStrings('game', 'games');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        $this->crud->setFromDb();

        // ------ CRUD FIELDS
        $this->crud->addField([
            'name' => 'status',
            'label' => "Status",
            'type' => 'text',
            'options' => Game::getStatusList(),
            'allows_null' => false,
            'attribute' => 'status',
            'attributes' => [
                'readonly' => 'readonly'
            ],
            'default' => Game::STATUS_NEW
        ]);
        $this->crud->addField([
            'label' => "Tour",
            'type' => 'select',
            'attribute' => 'number', // foreign key attribute that is shown to user
            'name' => 'tur_id', // the method that defines the relationship in your Model
            'entity' => 'tur', // the method that defines the relationship in your Model
            'model' => "App\\Models\\Tur", // foreign key model
        ]);
        $this->crud->addField([   // Select2Multiple = n-n relationship (with pivot table)
            'label' => "Rounds",
            'type' => 'select2_multiple',
            'name' => 'rounds', // the method that defines the relationship in your Model
            'entity' => 'rounds', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\\Models\\Round", // foreign key model
            'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
        ]);

        $this->crud->addField([   // Select2Multiple = n-n relationship (with pivot table)
            'label' => "Participants",
            'type' => 'select2_multiple',
            'name' => 'participants', // the method that defines the relationship in your Model
            'entity' => 'participants', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\\Models\\Command", // foreign key model
            'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
        ]);


        $this->crud->addField([   // Select2Multiple = n-n relationship (with pivot table)
            'label' => "Jury",
            'type' => 'select2_multiple',
            'name' => 'jury', // the method that defines the relationship in your Model
            'entity' => 'jury', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\\User", // foreign key model
            'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
        ]);
        // $this->crud->addField($options, 'update/create/both');
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
//         $this->crud->removeField('tur_id', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');

        // ------ CRUD COLUMNS
        $this->crud->addColumn([
            'label' => "Championship", // Table column heading
            'type' => "select",
            'name' => 'championship_id', // the column that contains the ID of that connected entity;
            'entity' => 'tur.championship', // the method that defines the relationship in your Model
            'attribute' => "name", // foreign key attribute that is shown to user
            'model' => "App\\Models\\Championship", // foreign key model
        ]);
        $this->crud->addColumn([
            'label' => "Tour", // Table column heading
            'type' => "select",
            'name' => 'tur_id', // the column that contains the ID of that connected entity;
            'entity' => 'tur', // the method that defines the relationship in your Model
            'attribute' => "number", // foreign key attribute that is shown to user
            'sorted' => 'number',
            'model' => "App\\Models\\Tur", // foreign key model
        ]);

        // $this->crud->addColumn(); // add a single column, at the end of the stack
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);

        // ------ CRUD BUTTONS
        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        // $this->crud->addButton($stack, $name, $type, $content, $position); // add a button; possible types are: view, model_function
        // $this->crud->addButtonFromModelFunction($stack, $name, $model_function_name, $position); // add a button whose HTML is returned by a method in the CRUD model
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
        // $this->crud->removeButton($name);
        // $this->crud->removeButtonFromStack($name, $stack);
        // $this->crud->removeAllButtons();
        // $this->crud->removeAllButtonsFromStack('line');

        // ------ CRUD ACCESS
        // $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete']);
        // $this->crud->denyAccess(['list', 'create', 'update', 'reorder', 'delete']);

        // ------ CRUD REORDER
        // $this->crud->enableReorder('label_name', MAX_TREE_LEVEL);
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('reorder');

        // ------ CRUD DETAILS ROW
        // $this->crud->enableDetailsRow();
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('details_row');
        // NOTE: you also need to do overwrite the showDetailsRow($id) method in your EntityCrudController to show whatever you'd like in the details row OR overwrite the views/backpack/crud/details_row.blade.php

        // ------ REVISIONS
        // You also need to use \Venturecraft\Revisionable\RevisionableTrait;
        // Please check out: https://laravel-backpack.readme.io/docs/crud#revisions
        // $this->crud->allowAccess('revisions');

        // ------ AJAX TABLE VIEW
        // Please note the drawbacks of this though:
        // - 1-n and n-n columns are not searchable
        // - date and datetime columns won't be sortable anymore
        // $this->crud->enableAjaxTable();

        // ------ DATATABLE EXPORT BUTTONS
        // Show export to PDF, CSV, XLS and Print buttons on the table view.
        // Does not work well with AJAX datatables.
        // $this->crud->enableExportButtons();

        // ------ ADVANCED QUERIES
        // $this->crud->addClause('active');
        // $this->crud->addClause('type', 'car');
        // $this->crud->addClause('where', 'name', '==', 'car');
        // $this->crud->addClause('whereName', 'car');
        // $this->crud->addClause('whereHas', 'posts', function($query) {
        //     $query->activePosts();
        // });
        // $this->crud->addClause('withoutGlobalScopes');
        // $this->crud->addClause('withoutGlobalScope', VisibleScope::class);
        // $this->crud->with(); // eager load relationships
        // $this->crud->orderBy();
        // $this->crud->groupBy();
        // $this->crud->limit();
    }


    public function generate_scenario(Request $request, $id)
    {

        $errors = [];

        $game = Game::find($id);

        $championat = $game->tur->championship;

        $rounds = $game->rounds;

        $questions = [];


        for ($i = 0; $i < count($rounds); $i++) {
            $questions[$i] = Question::leftJoin('question_of_game', 'questions.id', '=', 'question_of_game.question_id')
                ->where('round_id', '=', $rounds[$i]->id)
                ->where(function ($q) use ($championat) {
                    $q->where('question_of_game.championship_id', '<>', $championat->id)
                        ->orWhere(function ($q1) {
                            $q1->whereNull('question_of_game.championship_id');
                        });
                })->select('questions.*')->get();
            if (count($questions[$i]) < ($rounds[$i]->count_questions * 4)) {
                $count = $rounds[$i]->count_questions * 4;
                $errors[count($errors)] = "Не хватает " . ($count - count($questions[$i]))
                    . " вопросов для раунда: " . $rounds[$i]->name;
            }
        }

        if (count($errors) == 0) {
            for ($i = 0; $i < count($rounds); $i++) {
                foreach ($game->gameParticipants as $gp) {
                    for ($j = 0; $j < $rounds[$i]->count_questions; $j++) {
                        $gameQuestion = new GameQuestion();
                        $gameQuestion->championship_id = $championat->id;
                        $gameQuestion->game_id = $game->id;
                        $gameQuestion->participant_of_game_id = $gp->id;
                        $index = rand(0,count($questions[$i])-1);

                        $gameQuestion->question_id = ($questions[$i][$index])->id;
                        $gameQuestion->save();
                        for($k=$index; $k<count($questions[$i])-1; $k++){
                            $questions[$i][$k]=$questions[$i][$k+1];
                        }
                        if(count($questions[$i])==0){
                            dd($questions[$i]);
                        }
                        unset($questions[$i][count($questions[$i])-1]);
                    }
                }
            }
            $game->status=Game::STATUS_GENERATED;
            $game->save();
        }

        $this->crud->entity_name_plural = "Scenario";
        $this->crud->entity_name = "scenario";
        $this->data['crud'] = $this->crud;
        $this->data['title'] = 'View ' . $this->crud->entity_name;
        $this->data['action'] = 'View';
        $this->data['errors'] = $errors;


        return view('scenarion.generate', $this->data);
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);

        if (count($this->crud->entry->participants) == 4) {
            if ($this->crud->entry->status == Game::STATUS_NEW) {
                $this->crud->entry->status = Game::STATUS_PlAN;
                $this->crud->entry->save();
            }
        }

        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
