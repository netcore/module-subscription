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


            <div class="form-group">
                <label class="col-md-2 control-label">Options</label>
                <div class="col-md-8">

                    <table class="table">
                        <thead>
                        <th>Option</th>
                        <th>Value</th>
                        </thead>
                        <tbody>

                        @forelse($plan->options as $option)

                            <tr>

                                <td>

                                    {!! Form::text(null, $option->name, [
                                        'class'     =>  'form-control',
                                        'disabled'  =>  true
                                    ]) !!}

                                </td>

                                <td>

                                    @if ($option->type == 'text')

                                        {!! Form::text('options['.$option->id.']['.$language->iso_code.']', trans_model($option, $language, 'value'), [
                                            'class'     =>  'form-control',
                                        ]) !!}

                                    @elseif ($option->type == 'boolean')

                                        <div class="hidden-switchery" hidden>
                                            {!! Form::checkbox('options['.$option->id.']['.$language->iso_code.']', null, trans_model($option, $language, 'value') == 1, [
                                                'class' => 'switchery switchery-sm'
                                            ]) !!}
                                        </div>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="2">No options added</td>
                            </tr>

                        @endforelse

                        </tbody>
                    </table>

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
    <label class="col-md-2 control-label">Settings</label>
    <div class="col-md-8">

        <table class="table">
            <thead>
                <th>Setting</th>
                <th>Value</th>
            </thead>
            <tbody>

                @foreach($plan->settings as $setting)

                    <tr>
                        <td>{{ $setting->key }}</td>
                        <td>

                            <div class="form-group"
                                 style="margin: 0;">
                                {!! Form::text('settings['.$setting->id.']',
                                $setting->value, [
                                    'class'     =>  'form-control'
                                ]) !!}
                            </div>

                        </td>
                    </tr>

                @endforeach

            </tbody>
        </table>
    </div>
</div>

<div class="form-group">
    <label class="col-md-2 control-label">Prices</label>
    <div class="col-md-8">

        <table class="table">
            <thead>
                <th>Monthly price</th>
                <th>Currency</th>
                <th>Original price (main currency)</th>
            </thead>
            <tbody>

                {{--
                    @TODO: Make this list using Vue.js
                --}}

                @foreach($periods as $period)

                    <tr>
                        <td colspan="2" style="border-top: 2px solid black">
                            <label>{{ $period->name }}</label>
                        </td>
                        <td style="border-top: 2px solid black">
                            @if (config('netcore.module-payment.braintree.enabled'))
                            {!! Form::text('prices['.$period->id.'][braintree_plan_id]', null, [
                                'class'         =>  'form-control input-sm',
                                'placeholder'   =>  'Braintree plan id'
                            ]) !!}
                            @endif
                        </td>
                    </tr>

                    @foreach($currencies as $currency)

                    @php
                        $price = $plan->prices->where('currency_id', $currency->id)
                                              ->where('period_id',   $period->id)
                                              ->first();
                    @endphp

                    <tr>

                        <td>

                            <div class="form-group{{ $errors->has('prices.'.$period->id.'.'.$currency->id.'.monthly_price') ? ' has-error' : '' }}"
                                 style="margin: 0;">
                                {!! Form::text('prices['.$period->id.']['.$currency->id.'][monthly_price]',
                                $price ? $price->monthly_price : null, [
                                    'class'     =>  'form-control'
                                ]) !!}
                            </div>

                        </td>

                        <td>
                            {{ $currency->name }} ({{ $currency->symbol }})
                        </td>

                        <td>

                            <div class="form-group{{ $errors->has('prices.'.$period->id.'.'.$currency->id.'.original_price') ? ' has-error' : '' }}"
                                 style="margin: 0;">
                                {!! Form::text('prices['.$period->id.']['.$currency->id.'][original_price]',
                                $price ? $price->original_price : null, [
                                    'class'     =>  'form-control'
                                ]) !!}
                            </div>

                        </td>

                    </tr>

                    @endforeach

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
