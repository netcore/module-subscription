@extends('admin::layouts.master')

@section('content')
    @include('admin::_partials._messages')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">

                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="{{ route('admin::subscriptions.options.create') }}" class="btn btn-xs btn-success">
                            <i class="fa fa-plus"></i> Create a new option
                        </a>
                    </div>
                    <h4 class="panel-title">Options</h4>
                </div>

                <div class="panel-body">
                    <div class="table-primary">
                        <table class="table table-bordered datatable">
                            <thead>

                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th width="15%" class="text-center">Actions</th>
                            </tr>

                            </thead>
                            <tbody>

                                @foreach ($options as $option)
                                    <tr>
                                        <td>
                                            @foreach(\Netcore\Translator\Helpers\TransHelper::getAllLanguages() as $language)

                                                <strong>
                                                    {{ strtoupper($language->iso_code) }}:
                                                </strong>
                                                {{ trans_model($option, $language, 'name') }}
                                                <br />

                                            @endforeach
                                        </td>

                                        <td>

                                            <div class="label label-info">
                                                {{ ucfirst($option->type) }}
                                            </div>

                                        </td>

                                        <td width="15%" class="text-center">
                                            <a href="{{ route('admin::subscriptions.options.edit', $option) }}"
                                               class="btn btn-xs btn-primary">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>

                                            {!! Form::open([
                                                'route'     =>  ['admin::subscriptions.options.destroy', $option],
                                                'method'    =>  'DELETE',
                                                'style'     =>  'display: inline-block;'
                                            ]) !!}

                                                <button type="submit" class="btn btn-xs btn-danger">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>

                                            {!! Form::close() !!}

                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection