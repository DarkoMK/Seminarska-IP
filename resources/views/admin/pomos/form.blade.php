<div class="form-group {{ $errors->has('naslov') ? 'has-error' : ''}}">
    {!! Form::label('naslov', 'Наслов', ['class' => 'col-md-4 control-label']) !!}
    <div class="input-field col s12">
        {!! Form::text('naslov', null, ['class' => 'form-control']) !!}
        {!! $errors->first('naslov', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('objasnuvanje') ? 'has-error' : ''}}">
    {!! Form::label('objasnuvanje', 'Објаснување', ['class' => 'col-md-4 control-label']) !!}
    <div class="input-field col s12">
        {!! Form::textarea('objasnuvanje', null, ['class' => 'materialize-textarea']) !!}
        {!! $errors->first('objasnuvanje', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="row">
    <div class="col s12">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Додај', ['class' => 'waves-effect waves-light btn brown darken-4']) !!}
        </div>
</div>