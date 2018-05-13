@extends('header')
@section('content')

    <style>
        .box{
            padding: 15px;
        }
    </style>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <!-- Default box -->

            @if (count($errors)>0)
                <div class="callout callout-danger">
                    <h4>{{ trans('backpack::crud.please_fix') }}</h4>
                    <ul>
                        @foreach($errors as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="box">
                @yield('scenario')
            </div>
        </div>
    </div>

@endsection