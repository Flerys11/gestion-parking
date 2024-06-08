<div class="form-group col-sm-6">
    {!! Form::label('choix', 'Choix:')!!}
    {!! Form::select('choix', $simple_list, ['class' => 'form-control', 'required'])!!}
    {!! Form::submit('valider', ['class' => 'btn btn-secondary'])!!}
</div>
