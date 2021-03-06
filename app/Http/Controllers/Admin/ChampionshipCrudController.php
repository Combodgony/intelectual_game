<?php

namespace App\Http\Controllers\Admin;

use App\Models\Championship;
use App\Models\Game;
use App\Models\Tur;
use App\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ChampionshipRequest as StoreRequest;
use App\Http\Requests\ChampionshipRequest as UpdateRequest;

class ChampionshipCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Championship');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/championship');
        $this->crud->setEntityNameStrings('championship', 'championships');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        $this->crud->setFromDb();

        // ------ CRUD FIELDS
        // $this->crud->addField($options, 'update/create/both');
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');

        // ------ CRUD COLUMNS
        // $this->crud->addColumn(); // add a single column, at the end of the stack
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);

        // ------ CRUD BUTTONS
        $this->crud->addButtonFromModelFunction('line', 'view', 'viewButton', 'beginning');


        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        // $this->crud->addButton($stack, $name, $type, $content, $position); // add a button; possible types are: view, model_function
        // $this->crud->addButtonFromModelFunction($stack, $name, $model_function_name, $position); // add a button whose HTML is returned by a method in the CRUD model
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
         $this->crud->removeButton('update');
         $this->crud->removeButton('delete');
        // $this->crud->removeButtonFromStack($name, $stack);
        // $this->crud->removeAllButtons();
        // $this->crud->removeAllButtonsFromStack('line');

        // ------ CRUD ACCESS
         $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete','view']);
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

    public function view($id){
        $this->crud->hasAccessOrFail('view');

        // prepare the fields you need to show
        $this->data['crud'] = $this->crud;
        $this->data['title'] = 'View '.$this->crud->entity_name;
        $this->data['action'] = 'View';
        $this->data['championship'] = Championship::find($id);
        $this->data['championship']->finalGame = Game::join('tur','tur.id','=','game.tur_id')
            ->join('championship','championship.id','=','tur.championship_id')
            ->whereNull('next_game_id')
            ->where('championship_id','=',$id)
            ->select('game.*')
            ->get()[0];
        return view('championship.championship_view',$this->data);
    }

    public function create()
    {

        $this->crud->hasAccessOrFail('create');

        // prepare the fields you need to show
        $this->data['crud'] = $this->crud;
        $this->data['saveAction'] = $this->getSaveAction();
        $this->data['fields'] = $this->crud->getCreateFields();
        $this->data['title'] = trans('backpack::crud.add').' '.$this->crud->entity_name;
        $this->data['action'] = 'Create';
        return view('championship.championship_create',$this->data);
//        return parent::create(); // TODO: Change the autogenerated stub
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);


        $championship = $this->data['entry'];
        $turs = [];

        for($i=0; $i<$championship->count_tur; $i++){
            $tur = new Tur();
            $tur->championship_id = $championship->id;
            $tur->number = $i+1;
            $tur->save();
            $turs[$i]=$tur;
        }
        $this->gameGenerate($turs);

        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    private function gameGenerate($turs, $turIndex=0,$next_game=null){
        if(count($turs)!=$turIndex){
            $game = new Game();
            $game->tur_id = $turs[count($turs)-1-$turIndex]->id;
            if($next_game!=null)
                $game->next_game_id=$next_game->id;
            $game->save();
            $this->gameGenerate($turs,$turIndex+1,$game); //left
            $this->gameGenerate($turs,$turIndex+1,$game); //right
        }
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
