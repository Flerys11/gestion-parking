<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="monnaieusers-table">
            <thead>
            <tr>
                <th>Votre Argent</th>
            </tr>
            </thead>
            <tbody>
            @foreach($monnaieusers as $monnaieuser)
                <tr>
                    <td>{{ $monnaieuser->reste }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>
