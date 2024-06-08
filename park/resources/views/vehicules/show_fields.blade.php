<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $vehicule->id }}</p>
</div>

<!-- Marque Field -->
<div class="col-sm-12">
    {!! Form::label('marque', 'Marque:') !!}
    <p>{{ $vehicule->marque }}</p>
</div>

<!-- Longeur Field -->
<div class="col-sm-12">
    {!! Form::label('longeur', 'Longeur:') !!}
    <p>{{ $vehicule->longeur }}</p>
</div>

<!-- Largeur Field -->
<div class="col-sm-12">
    {!! Form::label('largeur', 'Largeur:') !!}
    <p>{{ $vehicule->largeur }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $vehicule->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $vehicule->updated_at }}</p>
</div>

