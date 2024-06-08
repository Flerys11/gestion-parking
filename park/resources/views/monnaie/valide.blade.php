@extends('base')

    @section('content')
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table" id="monnaieusers-table">
                    <thead>
                    <tr>
                        <th>Argent</th>
                        <th>Utilisateur</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($monnaieusers as $monnaieuser)
                        <tr>
                            <td>{{ $monnaieuser->monnaie_entre }}</td>
                            <td>{{ $monnaieuser->nom }}</td>
                            <td  style="width: 120px">
                                <div class='btn-group'>
                                    <a href=" {{route('v.monnaie', [$monnaieuser->id])}}"
                                       class='btn btn-default btn-xs'>
                                        <button class="btn-success">Valider</button>
                                    </a>

                                </div>
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    @endsection
