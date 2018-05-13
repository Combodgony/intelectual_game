@extends('header')
@section('content')
    <style>
        .card{
            margin-left: 25px;
            margin-top: 10px;
            margin-bottom: 5px;
            /*border-left: 1px solid red;*/
        }
        .card-game-header {
            width: 100%;
            height: 30px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            background-color: rgba(113, 143, 66, 0.26);
            border-radius: 4px;
            padding-left: 10px;
            padding-right: 10px;
            padding-top: 3px;
        }
        .content-box{
            padding: 15px;
        }
    </style>

    <div class="row">
        <div class="col-md-12">
            @if ($crud->hasAccess('list'))
                <a href="{{ url($crud->route) }}"><i
                            class="fa fa-angle-double-left"></i> {{ trans('backpack::crud.back_to_all') }}
                    <span>{{ $crud->entity_name_plural }}</span></a><br><br>
            @endif

            @include('crud::inc.grouped_errors')

            <div class="box content-box">
                <div>
                    <h3>{{$championship->name}}</h3>
                </div>


                @include('championship.game_view', ['game'=>$championship->finalGame])

            </div>
        </div>
    </div>

@endsection