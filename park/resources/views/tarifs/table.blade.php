<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="tarifs-table">
            <thead>
            <tr>
                <th>Heure</th>
                <th>Prix</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tarifs as $tarif)
                <tr>
                    <td>{{ $tarif->heure }}</td>
                    <td>{{ $tarif->prix }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['tarifs.destroy', $tarif->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('tarifs.show', [$tarif->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye">show</i>
                            </a>
                            <a href="{{ route('tarifs.edit', [$tarif->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-edit">update</i>
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
            @include('adminlte-templates::common.paginate', ['records' => $tarifs])
        </div>
    </div>
</div>
