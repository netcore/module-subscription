@include('translate::_partials._nav_tabs')

<!-- Tab panes -->
<div class="tab-content">
    @foreach(\Netcore\Translator\Helpers\TransHelper::getAllLanguages() as $language)

        <div role="tabpanel" class="tab-pane {{ $loop->first ? 'active' : '' }}"
             id="{{ $language->iso_code }}">

            <div class="form-group{{ $errors->has('translations.' . $language->iso_code . '.name') ? ' has-error' : '' }}">
                <label class="col-md-2 control-label">Name</label>
                <div class="col-md-8">
                    {!! Form::text(
                    'translations['.$language->iso_code.'][name]',
                    trans_model($plan, $language, 'name'),
                    [
                        'class' => 'form-control'
                    ]) !!}
                </div>
            </div>

            <div class="form-group{{ $errors->has('translations.' . $language->iso_code . '.text') ? ' has-error' : '' }}">
                <label class="col-md-2 control-label">Text</label>
                <div class="col-md-8">

                    {!! Form::textarea(
                    'translations['.$language->iso_code.'][description]',
                    trans_model($plan, $language, 'description'),
                    [
                        'class' => 'form-control'
                    ]) !!}

                </div>
            </div>
        </div>

    @endforeach
</div>

<hr />

<div class="form-group">
    <label class="col-md-2 control-label">Featured?</label>
    <div class="col-md-8">

        <div class="hidden-switchery" hidden>
            {!! Form::checkbox('is_featured', null, null, [
                'class' => 'switchery'
            ]) !!}
        </div>

    </div>
</div>

<div class="form-group">
    <label class="col-md-2 control-label">Prices</label>
    <div class="col-md-8">

        <table class="table">
            <thead>
                <th>Monthly price</th>
                <th>Period</th>
            </thead>
            <tbody>

                @foreach($plan->prices as $price)

                    <tr>

                        <td>

                            {!! Form::text('prices['.$price->id.'][monthly_price]', $price->monthly_price, [
                                'class'     =>  'form-control'
                            ]) !!}

                        </td>

                        <td>

                            {!! Form::text(null, $price->period->name, [
                                'class'     =>  'form-control',
                                'disabled'  =>  true
                            ]) !!}

                        </td>

                    </tr>

                @endforeach

            </tbody>
        </table>

    </div>
</div>

@section('scripts')

    <script>
        $('.switchery').each(function(i, switcher) {
            new Switchery(switcher);
            $(switcher).closest('.hidden-switchery').show();
        });
    </script>

@endsection
