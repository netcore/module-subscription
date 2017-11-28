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
                    trans_model($currency, $language, 'name'),
                    [
                        'class' => 'form-control'
                    ]) !!}
                </div>
            </div>

        </div>

    @endforeach
</div>

<hr />

<div class="form-group{{ $errors->has('symbol') ? ' has-error' : '' }}">
    <label class="col-md-2 control-label">Symbol</label>
    <div class="col-md-8">

        {!! Form::text('symbol', null, [
            'class' =>  'form-control'
        ]) !!}

    </div>
</div>