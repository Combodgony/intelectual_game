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
                <div id="card-741785">
                    <div class="card">
                        <div class="card-header">
                            <a class="card-link collapsed" data-toggle="collapse" data-parent="#card-741785"
                               href="#card-element-342250">Финальная игра (финальный тур)</a>
                        </div>
                        <div id="card-element-342250" class="collapse">
                            <div class="card-body">

                                <div id="card-7417854">
                                    <div class="card">
                                        <div class="card-header">
                                            <a class="card-link collapsed" data-toggle="collapse"
                                               data-parent="#card-7417854" href="#card-element-3422503">
                                                Игра среди школ 1-5 (2 тур)
                                            </a>
                                        </div>
                                        <div id="card-element-3422503" class="collapse">
                                            <div class="card-body">
                                                Описание игры может результаты или кнопки просто
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <a class="card-link collapsed" data-toggle="collapse"
                                               data-parent="#card-7417854" href="#card-element-3422506">
                                                Игра среди школ 6-10 (2 тур)
                                            </a>
                                        </div>
                                        <div id="card-element-3422506" class="collapse">
                                            <div class="card-body">
                                                Описание игры может результаты или кнопки просто
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection