<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Име', ['class' => 'col-md-4 control-label']) !!}
    <div class="input-field col s12">
        {!! Form::text('name', null, ['class' => 'input-field col s12', 'required' => 'required']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    {!! Form::label('email', 'Емаил', ['class' => 'col-md-4 control-label']) !!}
    <div class="input-field col s12">
        {!! Form::text('email', null, ['class' => 'input-field col s12', 'required' => 'required']) !!}
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@if(!$izmeni)
<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
    {!! Form::label('password', 'Лозинка', ['class' => 'col-md-4 control-label']) !!}
    <div class="input-field col s12">
        {!! Form::text('password', null, ['class' => 'input-field col s12', 'required' => 'required', 'type' => 'password']) !!}
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@endif
<div class="row">
    <div class="col s12">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Додај', ['class' => 'waves-effect waves-light btn brown darken-4']) !!}
    </div>
</div>