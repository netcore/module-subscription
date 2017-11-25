@extends('admin::layouts.master')

@section('scripts')
    <script>
        $('.switchery').each(function(i, switcher) {
            new Switchery(switcher);
            $(switcher).closest('.hidden-switchery').show();
        });
    </script>
@endsection

@section('content')
    @include('admin::_partials._messages')


    <div class="row">

        <div class="col-md-12">
            <div class="panel panel-inverse">

                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="{{ route('admin::subscriptions.plans.index') }}" class="btn btn-xs btn-primary">
                            <i class="fa fa-undo"></i> Back to the list
                        </a>
                    </div>
                    <h4 class="panel-title">Edit plan</h4>
                </div>

                <div class="panel-body">
                    {!! Form::model($plan, [
                        'route'     => ['admin::subscriptions.plans.update', $plan],
                        'method'    => 'PUT',
                        'class' => 'form-horizontal'
                    ]) !!}


                    @include('subscription::admin.plans._form')


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