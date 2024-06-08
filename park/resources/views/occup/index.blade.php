@extends('base')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Liste Parking</h1>
                </div>

                <div class="card-body">
                    <button class="btn btn-primary" onclick="openFormPopup()">Sortie</button>
                </div>
                <div id="overlay">
                    <div id="popup">
                        <span id="closeBtn" class="bold-label" onclick="closeFormPopup()">X</span>
                        <label  class="bold-label">Sortie</label>
                        <br>
                            <div class="form-group col-12">
                                <label for="vehicule">Véhicule</label>
                                <select class="form-control" id="vehicule" name="vehicule">
                                    @foreach($vehicule as $vehicules)
                                        <option value="{{ $vehicules->id }}">{{ $vehicules->idvehicule }}</option>
                                    @endforeach
                                </select>
                                <div id="error-message" style="color: red;"></div>
                            </div>

                            <br>
                            <input type="button" class="btn btn-success" value="Valider" onclick="submitForm()">
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-8 mb-4 order-0">
                <div class="card">
                    @include('occup.listeDispo')
                </div>
            </div>
            <div class="col-lg-4 mb-4 order-0">
                <div class="card">
                    @include('occup.Stat')
                </div>
            </div>
        </div>
    </div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
    function openFormPopup() {
        document.getElementById('overlay').style.display = 'flex';
    }

    function closeFormPopup() {
        document.getElementById('overlay').style.display = 'none';
    }

    function submitForm() {
        var vehicule = document.getElementById('vehicule').value;
        console.log(vehicule);
        var formData = {
            '_token': '{{ csrf_token() }}',
            'vehicule': vehicule
        };

        var jsonData = JSON.stringify(formData);
        //console.log(jsonData);

        $.ajax({
            url: "{{ route('occupe.sortie') }}",
            type: "POST",
            data: jsonData,
            contentType: "application/json",
            dataType: "json",
            success: function (data) {
                console.log('eto')
                // if (data.message) {
                //     //console.log(data.message);
                //     closeFormPopup();
                // } else if (data.error) {
                //     //console.log(data.error);
                //     document.getElementById('error-message').innerHTML = E;
                // }
            },
            error: function (xhr, status, errorThrown) {
                console.log("Erreur : " + errorThrown);

            }
        });
    }
</script>
