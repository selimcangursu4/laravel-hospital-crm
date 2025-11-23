@extends('partials.master')
@section('main')
<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            Hasta Filtreleme
            <a href="{{ route('data.view') }}" class="btn btn-danger btn-sm float-end">Geri Dön</a>
        </div>
        <div class="card-body">

            <form id="dataFilterForm">
                <div class="row">

                    <div class="col-md-3">
                        <label>Hasta Kayıt Numarası</label>
                        <input type="text" class="form-control" id="search_id" placeholder="Örn: 1023">
                    </div>

                    <div class="col-md-3">
                        <label>İsim Soyisim</label>
                        <input type="text" class="form-control" id="search_fullname" placeholder="Örn: Ahmet Yılmaz">
                    </div>

                    <div class="col-md-3">
                        <label>Telefon</label>
                        <input type="text" class="form-control" id="search_phone" placeholder="Örn: 0555 555 55 55">
                    </div>

                    <div class="col-md-3">
                        <label>Cinsiyet</label>
                        <select class="form-select" id="search_gender_id">
                            <option value="">Seçiniz</option>
                            <option value="1">Erkek</option>
                            <option value="2">Kadın</option>
                            <option value="3">Belirtilmedi</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label>Hizmet</label>
                        <select class="form-select" id="search_service_id">
                            <option value="">Seçiniz</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label>Kaynak</label>
                        <select class="form-select" id="search_source_id">
                            <option value="">Seçiniz</option>
                            @foreach ($sources as $source)
                                <option value="{{ $source->id }}">{{ $source->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label>Durum</label>
                        <select class="form-select" id="search_patient_status_id">
                            <option value="">Seçiniz</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label>Atanan Personel</label>
                        <select class="form-select" id="search_user_id">
                            <option value="">Seçiniz</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label>Atanan Doktor</label>
                        <select class="form-select" id="search_doctor_id">
                            <option value="">Seçiniz</option>
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 mt-3">
                        <button type="submit" class="btn btn-success btn-sm float-end">
                            Detaylı Sonuçları Filtrele
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>


    <div class="card mt-3">
        <div class="card-header">Tüm Hasta Listesi</div>

        <div class="card-body">
            <table id="myTable" class="display table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>İsim Soyisim</th>
                        <th>Telefon</th>
                        <th>Cinsiyet</th>
                        <th>Hizmet</th>
                        <th>Kaynak</th>
                        <th>Durum</th>
                        <th>Personel</th>
                        <th>Doktor</th>
                        <th>İşlem</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

</div>


<script>
$(document).ready(function() {
    let table = new DataTable('#myTable');

    function loadPatients() {
        $.ajax({
            url: "{{ route('patients.fetch') }}",
            type: "GET",
            data: {
                search_id: $('#search_id').val(),
                search_fullname: $('#search_fullname').val(),
                search_phone: $('#search_phone').val(),
                search_gender_id: $('#search_gender_id').val(),
                search_service_id: $('#search_service_id').val(),
                search_source_id: $('#search_source_id').val(),
                search_patient_status_id: $('#search_patient_status_id').val(),
                search_user_id: $('#search_user_id').val(),
                search_doctor_id: $('#search_doctor_id').val(),
            },
            success: function(data) {
                table.clear();
                data.forEach(function(patient) {

                    let genderName = patient.gender_name ?? (
                        patient.gender_id == 1 ? 'Erkek' :
                        patient.gender_id == 2 ? 'Kadın' :
                        'Belirtilmedi'
                    );

                    table.row.add([
                        patient.id,
                        patient.fullname,
                        patient.phone,
                        genderName,
                        patient.service_name ?? '-',
                        patient.source_name ?? '-',
                        patient.status_name ?? '-',
                        patient.user_name ?? '-',
                        patient.doctor_name ?? '-',
                        `<a href="/patients/edit/${patient.id}" class="btn btn-sm btn-primary">Detay</a>`
                    ]).draw();
                });
            },
            error: function(err) {
                console.error("Hata:", err);
            }
        });
    }

    loadPatients();

    $('#dataFilterForm').on('submit', function(e) {
        e.preventDefault();
        loadPatients();
    });

});
</script>

@endsection
