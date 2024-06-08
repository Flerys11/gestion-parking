<!-- Heure Field -->
<div class="form-group col-sm-6">
    {!! Form::label('heure', 'Heure:') !!}
    {!! Form::time('heure', null, ['class' => 'form-control', 'required', 'max' => 100]) !!}
</div>

<!-- Prix Field -->
<div class="form-group col-sm-6">
    {!! Form::label('prix', 'Prix:') !!}
    {!! Form::number('prix', null, ['class' => 'form-control', 'required', 'max' => 10000000, 'step' => 'any']) !!}
</div>
