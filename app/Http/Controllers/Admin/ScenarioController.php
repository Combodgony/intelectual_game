<?php

namespace App\Http\Controllers\Admin;

use App\Models\Game;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScenarioController extends CrudController
{


    public function setup()
    {
        $this->crud->setModel('App\Models\Game');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/scenario');
        $this->crud->setEntityNameStrings('scenario', 'scenarios');
    }


    public function view(Request $request,$id){
        $this->crud->entity_name_plural = "Scenario";
        $this->data['crud'] = $this->crud;
        $this->data['title'] = 'View ' . $this->crud->entity_name;
        $this->data['action'] = 'View';
        $this->data['errors'] = [];
        $this->data['game'] = Game::find($id);




        return view('scenarion.view', $this->data);
    }
}
