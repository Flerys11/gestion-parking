<!-- Nom Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nom', 'Nom:') !!}
    {!! Form::text('nom', null, ['class' => 'form-control', 'required', 'maxlength' => 250]) !!}
</div>

<!-- Longeur Field -->
<div class="form-group col-sm-6">
    {!! Form::label('longeur', 'Longeur:') !!}
    {!! Form::number('longeur', null, ['class' => 'form-control', 'required', 'max' => 100, 'step' => 'any']) !!}
</div>

<!-- Largeur Field -->
<div class="form-group col-sm-6">
    {!! Form::label('largeur', 'Largeur:') !!}
    {!! Form::number('largeur', null, ['class' => 'form-control', 'required', 'max' => 100, 'step' => 'any']) !!}
</div>

<!-- Lieu Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lieu', 'Lieu:') !!}
    {!! Form::text('lieu', null, ['class' => 'form-control', 'required', 'maxlength' => 250]) !!}
</div>
