@extends('admin::layouts.master')

@section('content')
    @include('admin::_partials._messages')


    <div class="row">

        <div class="col-md-12">
            <div class="panel panel-inverse">

                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="{{ route('admin::subscriptions.options.index') }}" class="btn btn-xs btn-primary">
                            <i class="fa fa-undo"></i> Back to the list
                        </a>
                    </div>
                    <h4 class="panel-title">Edit option</h4>
                </div>

                <div class="panel-body">
                    {!! Form::model($option, [
                        'route'     => ['admin::subscriptions.options.update', $option],
                        'method'    => 'PUT',
                        'class'     => 'form-horizontal'
                    ]) !!}


                    @include('subscription::admin.options._form')


                    <button type="submit" class="btn btn-success pull-right">
                        <i class="fa fa-save"></i>
                        Save
                    </button>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>

@endsection