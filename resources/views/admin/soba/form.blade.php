<div class="form-group {{ $errors->has('ime') ? 'has-error' : ''}}">
    {!! Form::label('ime', 'Име', ['class' => 'col-md-4 control-label']) !!}
    <div class="input-field col s12">
        {!! Form::text('ime', null, ['class' => 'input-field col s12', 'required' => 'required']) !!}
        {!! $errors->first('ime', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="row">
    <div class="col s12">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Додај', ['class' => 'waves-effect waves-light btn brown darken-4']) !!}
    </div>
</div>