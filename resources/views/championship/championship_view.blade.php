@extends('championship.championship')
@section('content')
    <style>
        .card{
            margin-left: 25px;
            /*border-left: 1px solid red;*/
        }
        .card-header {
            width: 100%;
            height: 30px;
            /*background-color: #0b2e13;*/
        }
        .content-box{
            padding: 15px;
        }
        .card-body{
            margin-left: 25px;
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