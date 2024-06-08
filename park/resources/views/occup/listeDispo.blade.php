<div class="card-body p-0" id="cadres-container">
    <div class="btn btn" id="point1">
        <span class="nom"></span>

        <div class="tooltip" role="tooltip">
            <div class="tooltip-arrow"></div>
            <div class="tooltip-inner"></div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $.ajax({
            url: "{{ route('list.station') }}",
            method: 'GET',
            success: function (response) {
                response.forEach(function (item) {
                    var pointCadre = $('<div class="btn btn" ></div>');
                    pointCadre.attr('id', 'point-' + item.id);
                    pointCadre.attr('data-nom', item.nom);
                    var nomSpan = $('<span class="nom"></span>');

                    pointCadre.attr('data-etat', item.etat);
                    pointCadre.click(function() {

                        window.location.href = "{{ url('/voir-detail')}}" + "/" + item.id;
                    });


                    nomSpan.text(item.nom);
                    pointCadre.append(nomSpan);

                    pointCadre.css('color', 'black');
                    pointCadre.css('margin', '10px');

                    if (item.etat === null || item.etat == 0) {
                        pointCadre.css('background-color', 'green');
                    } else if (item.etat === 10) {
                        pointCadre.css('background-color', 'red');
                    }
                    $('#cadres-container').append(pointCadre);
                });

                $('.btn').tooltip({
                    title: function () {
                        var nom = $(this).data('nom');
                        var e = $(this).data('etat')
                        var check_etat = "";
                            if( e === 10){
                                check_etat = 'Occuper'
                            }else {
                                check_etat = 'Disponible'
                            }

                        return 'Détails de la station: ' + nom +  '  Etat :' + check_etat;
                    }
                });
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });

</script>
