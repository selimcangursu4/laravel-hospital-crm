@extends('partials.master')
@section('main')
    <div class="container-fluid p-0">
        <div class="card shadow-sm">
            <div class="card-header fw-bold">
                Yeni Lead Ekle
            </div>
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <h5 class="text-primary">Kişisel Bilgiler</h5>
                            <hr>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">İsim Soyisim</label>
                            <input type="text" class="form-control" id="fullname" placeholder="Örn: Ahmet Yılmaz">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" placeholder="example@mail.com">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Telefon Numarası</label>
                            <input type="text" class="form-control" id="phone" placeholder="+90 5xx xxx xx xx">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Doğum Tarihi</label>
                            <input type="date" class="form-control" id="birth_date">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Cinsiyet</label>
                            <select class="form-select mb-3" id="gender_id">
                                <option selected>Seçiniz</option>
                                <option value="1">Erkek</option>
                                <option value="2">Kadın</option>
                                <option value="3">Belirtilmedi</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ülke</label>
                            <select class="form-select mb-3" id="country_id">
                                <option selected>Seçiniz</option>
                                <option value="1">Türkiye</option>
                                <option value="2">Almanya</option>
                                <option value="3">Belirtilmedi</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Şehir</label>
                            <select class="form-select mb-3" id="city_id">
                                <option selected>Seçiniz</option>
                                <option value="1">İstanbul</option>
                                <option value="2">Münih</option>
                                <option value="3">Belirtilmedi</option>
                            </select>
                        </div>
                        <div class="col-12 mt-4 mb-3">
                            <h5 class="text-primary">Operasyon Bilgileri</h5>
                            <hr>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">İlgilendiği Operasyon</label>
                            <select class="form-select mb-3" id="service_id">
                                <option selected>Seçiniz</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Lead Kaynağı</label>
                            <select class="form-select mb-3" id="source_id">
                                <option selected>Seçiniz</option>
                                @foreach ($sources as $source)
                                    <option value="{{ $source->id }}">{{ $source->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 mt-4 mb-3">
                            <h5 class="text-primary">Ek Notlar</h5>
                            <hr>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Açıklama</label>
                            <textarea class="form-control" rows="4" id="note" placeholder="Lead hakkında ek bilgi yazabilirsiniz..."></textarea>
                        </div>
                        <div class="col-12 mt-3">
                            <button id="save" type="button" class="btn btn-primary float-end px-4">Yeni Lead
                                Ekle</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#save').click(function(e) {
                e.preventDefault();

                let fullname = $('#fullname').val();
                let email = $('#email').val();
                let phone = $('#phone').val();
                let birth_date = $('#birth_date').val();
                let gender_id = $('#gender_id').val();
                let country_id = $('#country_id').val();
                let city_id = $('#city_id').val();
                let service_id = $('#service_id').val();
                let source_id = $('#source_id').val();
                let note = $('#note').val();

                $.ajax({
                    type: "POST",
                    url: "{{ route('leads.store') }}",
                    data: {
                        fullname: fullname,
                        email: email,
                        phone: phone,
                        birth_date: birth_date,
                        gender_id: gender_id,
                        country_id: country_id,
                        city_id: city_id,
                        service_id: service_id,
                        source_id: source_id,
                        note: note,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        Swal.fire({
                            position: "top-center",
                            icon: "success",
                            title: response.message,
                            showConfirmButton: true,
                        });
                    },
                    error: function(xhr) {
                        alert('Lead eklenirken bir hata oluştu. Lütfen tekrar deneyiniz.');
                    }
                })
            })
        })
    </script>
@endsection
