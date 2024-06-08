<!-- Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id', 'Id:') !!}
    {!! Form::text('id', null, ['class' => 'form-control', 'required', 'maxlength' => 10]) !!}
</div>

<!-- Marque Field -->
<div class="form-group col-sm-6">
    {!! Form::label('marque', 'Marque:') !!}
    {!! Form::text('marque', null, ['class' => 'form-control', 'required', 'maxlength' => 100]) !!}
</div>

<!-- Longeur Field -->
<div class="form-group col-sm-6">
    {!! Form::label('longeur', 'Longeur:') !!}
    {!! Form::number('longeur', null, ['class' => 'form-control', 'step' => 'any']) !!}
</div>

<!-- Largeur Field -->
<div class="form-group col-sm-6">
    {!! Form::label('largeur', 'Largeur:') !!}
    {!! Form::number('largeur', null, ['class' => 'form-control', 'step' => 'any']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('date_debut', 'Date debut:') !!}
    {!! Form::datetimeLocal('date_debut', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('date_fin', 'Date fin:') !!}
    {!! Form::datetimeLocal('date_fin', null, ['class' => 'form-control']) !!}
</div>


<input type="hidden" name="idp" id="" value="{{ $id_p }}">
