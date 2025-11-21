@extends('partials.master')
@section('main')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                Lead Filtreleme
                <a href="{{ route('leads.view') }}" class="btn btn-danger btn-sm float-end">Geri Dön</a>
            </div>
            <div class="card-body">
                <form id="leadFilterForm">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Lead Numarası</label>
                            <input type="text" class="form-control" id="search_id" placeholder="Örn: 12345">
                        </div>
                        <div class="col-md-3">
                            <label for="">İsim Soyisim</label>
                            <input type="text" class="form-control" id="search_fullname" placeholder="Örn: Ahmet Yılmaz">
                        </div>
                        <div class="col-md-3">
                            <label for="">Telefon Numarası</label>
                            <input type="text" class="form-control" id="search_phone" placeholder="Örn: 0555 555 55 55">
                        </div>
                        <div class="col-md-3">
                            <label for="">Cinsiyet</label>
                            <select class="form-select mb-3" id="search_gender_id">
                                <option value="">Seçiniz</option>
                                <option value="1">Erkek</option>
                                <option value="2">Kadın</option>
                                <option value="3">Belirtilmedi</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">Hizmet</label>
                            <select class="form-select mb-3" id="search_service_id">
                                <option value="">Seçiniz</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">Kaynak</label>
                            <select class="form-select mb-3" id="search_source_id">
                                <option value="">Seçiniz</option>
                                @foreach ($sources as $source)
                                    <option value="{{ $source->id }}">{{ $source->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">Durum</label>
                            <select class="form-select mb-3" id="search_lead_status_id">
                                <option value="">Seçiniz</option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">Atanan Personel</label>
                            <select class="form-select mb-3" id="search_user_id">
                                <option value="">Seçiniz</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mt-3">
                            <button type="submit" class="btn btn-success btn-sm float-end">Detaylı Sonuçları
                                Filtrele</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">Tüm Lead Listesi</div>
            <div class="card-body">
                <table id="myTable" class="display table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>İsim Soyisim</th>
                            <th>Telefon Numarası</th>
                            <th>Cinsiyet</th>
                            <th>Hizmet</th>
                            <th>Kaynak</th>
                            <th>Durum</th>
                            <th>Personel</th>
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

            function loadLeads() {
                $.ajax({
                    url: "{{ route('leads.fetch') }}",
                    type: "GET",
                    data: {
                        search_id: $('#search_id').val(),
                        search_fullname: $('#search_fullname').val(),
                        search_phone: $('#search_phone').val(),
                        search_gender_id: $('#search_gender_id').val(),
                        search_service_id: $('#search_service_id').val(),
                        search_source_id: $('#search_source_id').val(),
                        search_lead_status_id: $('#search_lead_status_id').val(),
                        search_user_id: $('#search_user_id').val(),
                    },
                    success: function(data) {
                        table.clear();
                        data.forEach(function(lead) {
                            let genderName = lead.gender_name;
                            if (!genderName) {
                                switch (lead.gender_id) {
                                    case 1:
                                        genderName = 'Erkek';
                                        break;
                                    case 2:
                                        genderName = 'Kadın';
                                        break;
                                    case 3:
                                    default:
                                        genderName = 'Belirtilmedi';
                                        break;
                                }
                            }

                            table.row.add([
                                lead.id,
                                lead.fullname,
                                lead.phone,
                                genderName,
                                lead.service_name ?? lead.service_id,
                                lead.source_name ?? lead.source_id,
                                lead.status_name ?? lead.lead_status_id,
                                lead.user_name ?? lead.user_id,
                                `<a href="/leads/edit/${lead.id}" class="btn btn-sm btn-primary">Detay</a>`
                            ]).draw();
                        });

                    },
                    error: function(err) {
                        console.error('Hata:', err);
                    }
                });
            }

            // Sayfa yüklendiğinde tüm leadleri getir
            loadLeads();

            // Filtrelemeyi Uygula
            $('#leadFilterForm').on('submit', function(e) {
                e.preventDefault();
                loadLeads();
            });
        });
    </script>
@endsection
