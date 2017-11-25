@extends('admin::layouts.master')

@section('content')
    @include('admin::_partials._messages')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">

                <div class="panel-heading">
                    <h4 class="panel-title">Periods</h4>
                </div>

                <div class="panel-body">
                    <div class="table-primary">
                        <table class="table table-bordered datatable">
                            <thead>

                            <tr>
                                <th>Name</th>
                                <th>Days</th>
                                <th width="15%" class="text-center">Actions</th>
                            </tr>

                            </thead>
                            <tbody>

                                @foreach ($periods as $period)
                                    <tr>
                                        <td>
                                            @foreach(\Netcore\Translator\Helpers\TransHelper::getAllLanguages() as $language)

                                                <strong>
                                                    {{ strtoupper($language->iso_code) }}:
                                                </strong>
                                                {{ trans_model($period, $language, 'name') }}
                                                <br />

                                            @endforeach
                                        </td>

                                        <td>

                                            <div class="label label-info">
                                                {{ $period->days }}
                                            </div>

                                        </td>

                                        <td width="15%" class="text-center">
                                            <a href="{{ route('admin::subscriptions.periods.edit', $period) }}"
                                               class="btn btn-xs btn-primary">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
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