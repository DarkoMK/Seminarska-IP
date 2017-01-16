<div class="form-group {{ $errors->has('vid_na_ured') ? 'has-error' : ''}}">
    {!! Form::label('vid_na_ured', 'Вид на уред', ['class' => 'col-md-4 control-label']) !!}
    <div class="input-field col s12">
        {!! Form::text('vid_na_ured', null, ['class' => 'input-field col s12', 'required' => 'required']) !!}
        {!! $errors->first('vid_na_ured', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('mokjnost_vati') ? 'has-error' : ''}}">
    {!! Form::label('mokjnost_vati', 'Моќност', ['class' => 'col-md-4 control-label']) !!}
    <div class="input-field col s12">
        {!! Form::number('mokjnost_vati', null, ['class' => 'input-field col s12']) !!}
        {!! $errors->first('mokjnost_vati', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="row">
    <div class="col s12">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Додај', ['class' => 'waves-effect waves-light btn brown darken-4']) !!}
    </div>
</div>