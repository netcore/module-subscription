@extends('admin::layouts.master')

@section('content')
    @include('admin::_partials._messages')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">

                <div class="panel-heading">
                    <h4 class="panel-title">Plans</h4>
                </div>

                <div class="panel-body">
                    <div class="table-primary">
                        <table class="table table-bordered datatable">
                            <thead>

                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Is featured?</th>
                                <th width="15%" class="text-center">Actions</th>
                            </tr>

                            </thead>
                            <tbody>

                                @foreach ($plans as $plan)
                                    <tr>
                                        <td>
                                            @foreach(\Netcore\Translator\Helpers\TransHelper::getAllLanguages() as $language)

                                                <strong>
                                                    {{ strtoupper($language->iso_code) }}:
                                                </strong>
                                                {{ trans_model($plan, $language, 'name') }}
                                                <br />

                                            @endforeach
                                        </td>

                                        <td>
                                            @foreach(\Netcore\Translator\Helpers\TransHelper::getAllLanguages() as $language)

                                                <strong>
                                                    {{ strtoupper($language->iso_code) }}:
                                                </strong>
                                                {{ str_limit(trans_model($plan, $language, 'description')) }}
                                                <br />

                                            @endforeach
                                        </td>

                                        <td>
                                            @if ($plan->is_featured)
                                                <div class="label label-success">
                                                    Yes
                                                </div>
                                            @else
                                                <div class="label label-danger">
                                                    No
                                                </div>
                                            @endif
                                        </td>

                                        <td width="15%" class="text-center">
                                            <a href="{{ route('admin::subscriptions.plans.edit', $plan) }}"
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