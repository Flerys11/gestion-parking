<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ticke</title>
</head>
<body>
    <div style="text-align: center">
        <h3>STREETED</h3>
        <h3>NOTICE D'INFORMATION</h3>
        <h3>FORFAIT DE POST STATIONNEMENT</h3>
    </div>
    <br>
    <p>Immatriculatio : {{$immatriculation}}</p>
    <p>Marque : {{ $marque }} </p>
    <p>Date Sortie: {{ $date }} </p>
    <p>Lieu : {{ $lieu }}</p>
    <p>Montant : {{ $prix_simple }}</p>
    <p>Amende : {{ $amende }}</p>
    <br>
    <p class="text-gray">Total : {{ $total }} </p>
</body>
</html>
