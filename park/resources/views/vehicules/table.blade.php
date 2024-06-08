<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="vehicules-table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Marque</th>
                <th>Longeur</th>
                <th>Largeur</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($vehicules as $vehicule)
                <tr>
                    <td>{{ $vehicule->id }}</td>
                    <td>{{ $vehicule->marque }}</td>
                    <td>{{ $vehicule->longeur }}</td>
                    <td>{{ $vehicule->largeur }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['vehicules.destroy', $vehicule->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('vehicules.show', [$vehicule->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('vehicules.edit', [$vehicule->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $vehicules])
        </div>
    </div>
</div>
