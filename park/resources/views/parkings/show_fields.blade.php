<!-- Nom Field -->
<div class="col-sm-12">
    {!! Form::label('nom', 'Nom:') !!}
    <p>{{ $parking->nom }}</p>
</div>

<!-- Longeur Field -->
<div class="col-sm-12">
    {!! Form::label('longeur', 'Longeur:') !!}
    <p>{{ $parking->longeur }}</p>
</div>

<!-- Largeur Field -->
<div class="col-sm-12">
    {!! Form::label('largeur', 'Largeur:') !!}
    <p>{{ $parking->largeur }}</p>
</div>

<!-- Lieu Field -->
<div class="col-sm-12">
    {!! Form::label('lieu', 'Lieu:') !!}
    <p>{{ $parking->lieu }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $parking->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $parking->updated_at }}</p>
</div>

