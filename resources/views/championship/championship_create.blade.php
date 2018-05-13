@extends('header')
@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <!-- Default box -->
            @if ($crud->hasAccess('list'))
                <a href="{{ url($crud->route) }}"><i
                            class="fa fa-angle-double-left"></i> {{ trans('backpack::crud.back_to_all') }}
                    <span>{{ $crud->entity_name_plural }}</span></a><br><br>
            @endif

            @include('crud::inc.grouped_errors')

            <form method="post"
                  action="{{ url($crud->route) }}"
                  @if ($crud->hasUploadFields('create'))
                  enctype="multipart/form-data"
                    @endif
            >
                {!! csrf_field() !!}
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('backpack::crud.add_a_new') }} {{ $crud->entity_name }}</h3>
                    </div>
                    <div class="box-body row display-flex-wrap" style="display: flex; flex-wrap: wrap;">
                        <!-- load the view from the application if it exists, otherwise load the one in the package -->
                        @if(view()->exists('vendor.backpack.crud.form_content'))
                            @include('vendor.backpack.crud.form_content', [ 'fields' => $crud->getFields('create'), 'action' => 'create' ])
                        @else
                            @include('crud::form_content', [ 'fields' => $crud->getFields('create'), 'action' => 'create' ])
                        @endif
                    </div><!-- /.box-body -->
                    <div class="box-footer">

                        {{--@include('crud::inc.form_save_buttons')--}}

                        <div id="saveActions" class="form-group">

                            <input type="hidden" name="save_action" value="{{ $saveAction['active']['value'] }}">

                            <div class="btn-group">

                                <button type="submit" class="btn btn-success">
                                    <span class="fa fa-save" role="presentation" aria-hidden="true"></span> &nbsp;
                                    <span data-value="{{ $saveAction['active']['value'] }}">{{ $saveAction['active']['label'] }}</span>
                                </button>
                            </div>

                            <a href="{{ url($crud->route) }}" class="btn btn-default"><span class="fa fa-ban"></span>
                                &nbsp;{{ trans('backpack::crud.cancel') }}</a>
                        </div>

                    </div><!-- /.box-footer-->

                </div><!-- /.box -->
            </form>
        </div>
    </div>

@endsection