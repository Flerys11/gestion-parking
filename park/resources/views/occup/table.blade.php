<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="vehicules-table">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Longeur</th>
                <th>Largeur</th>
                <th>Lieu</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($parkings as $parking)
                <tr>
                    <td>{{ $parking->nom }}</td>
                    <td>{{ $parking->longeur }}</td>
                    <td>{{ $parking->largeur }}</td>
                    <td>{{ $parking->lieu }}</td>
                    <td  style="width: 120px">
                        <div class='btn-group'>
                            @if($parking->etat == null)
                                <a href="{{ route('add.vehicule', [$parking->id]) }}" class="btn btn-default btn-xs">
                                    <button class="btn btn-success">Stationner</button>
                                </a>
                            @endif


                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>
