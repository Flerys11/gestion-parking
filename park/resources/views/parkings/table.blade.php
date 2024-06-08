<div class="card-body p-0">
    <div id="parkingsContainer">
        <div class="table-responsive">
            <table class="table" id="parkings-table">
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
                            {!! Form::open(['route' => ['parkings.destroy', $parking->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                <a href="{{ route('parkings.show', [$parking->id]) }}"
                                   class='btn btn-default btn-xs'>
                                    <i class="far fa-eye">show</i>
                                </a>
                                <a href="{{ route('parkings.edit', [$parking->id]) }}"
                                   class='btn btn-default btn-xs'>
                                    <i class="bx bx-upvote bx-fade-up"></i>
                                </a>
                                {!! Form::button('<i class="bx bx-trash text-danger"></i>', ['type' => 'submit','class' => 'btn btn-xs border-0', 'onclick' => "return confirm('Are you sure?')"]) !!}

                            </div>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

{{--    <div class="card-footer clearfix">--}}
{{--        <div class="float-right">--}}
{{--            @include('adminlte-templates::common.paginate', ['records' => $parkings])--}}
{{--        </div>--}}
{{--    </div>--}}



{{--    <div>--}}
{{--        @if($parkings->onFirstPage())--}}
{{--            <span class="btn btn-light">&laquo;&nbsp;&nbsp;</span>--}}
{{--        @else--}}
{{--            <a class="btn btn-secondary" href="{{ $parkings->appends(request()->input())->previousPageUrl() }}" rel="prev">&laquo;&nbsp;&nbsp;</a>--}}
{{--        @endif--}}

{{--        @foreach($parkings as $journal => $value)--}}
{{--            @if($journal != 0)--}}
{{--                @if($journal == $parkings->currentPage())--}}
{{--                    <span class="btn btn-primary">{{ $journal }}</span>--}}
{{--                @else--}}
{{--                    <a href="{{ $value }}" class="btn btn-primary">{{ $journal }}</a>--}}
{{--                @endif--}}
{{--            @endif--}}
{{--        @endforeach--}}
{{--        @if($parkings->hasMorePages())--}}
{{--            <a class="btn btn-secondary" href="{{ $parkings->appends(request()->input())->nextPageUrl() }}" rel="next">&nbsp;&nbsp;&raquo;</a>--}}
{{--        @else--}}
{{--            <span class="btn btn-light">&nbsp;&nbsp;&raquo;</span>--}}
{{--        @endif--}}


{{--    </div>--}}

    <div class="pagination justify-content-center mt-4">
        {{ $parkings->appends(request()->input())->links() }}
    </div>



</div>
