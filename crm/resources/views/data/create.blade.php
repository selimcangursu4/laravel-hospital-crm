@extends('partials.master')
@section('main')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Yeni Hasta Ekle</h3>
            </div>

            <div class="card-body">
                <form>
                    @csrf

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label for="fullname" class="form-label">İsim Soyisim</label>
                            <input type="text" class="form-control" name="fullname" id="fullname"
                                placeholder="Örn: Ahmet Yılmaz">
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">E-Posta Adresi</label>
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="Örn: ahmet@example.com">
                        </div>

                        <div class="col-md-6">
                            <label for="phone" class="form-label">Telefon Numarası</label>
                            <input type="text" class="form-control" name="phone" id="phone"
                                placeholder="05xx xxx xx xx">
                        </div>

                        <div class="col-md-6">
                            <label for="birthdate" class="form-label">Doğum Tarihi</label>
                            <input type="date" class="form-control" name="birthdate" id="birthdate">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="gender_id">Cinsiyet</label>
                            <select class="form-select" id="gender_id" name="gender_id">
                                <option value="">Cinsiyet Seçiniz</option>
                                <option value="1">Erkek</option>
                                <option value="2">Kadın</option>
                                <option value="3">Belirtilmedi</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="country_id">Ülke</label>
                            <select class="form-select" id="country_id" name="country_id">
                                <option value="">Ülke Seçiniz</option>
                                <option value="1">Türkiye</option>
                                <option value="2">Almanya</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="city_id">Şehir</label>
                            <select class="form-select" id="city_id" name="city_id">
                                <option value="">Şehir Seçiniz</option>
                                <option value="1">İstanbul</option>
                                <option value="2">Ankara</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="address" class="form-label">Adres Bilgisi</label>
                            <textarea class="form-control" rows="3" id="address" name="address" placeholder="Adresinizi yazın"></textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="service_id">Hizmet</label>
                            <select class="form-select" id="service_id" name="service_id">
                                <option value="">Hizmet Seçiniz</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="source_id">Kaynak</label>
                            <select class="form-select" id="source_id" name="source_id">
                                <option value="">Kaynak Seçiniz</option>
                                @foreach ($sources as $source)
                                    <option value="{{ $source->id }}">{{ $source->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="blood_group_id">Kan Grubu</label>
                            <select class="form-select" id="blood_group_id" name="blood_group_id">
                                <option value="">Kan Grubu Seçiniz</option>
                                <option value="A+">A Rh+</option>
                                <option value="A-">A Rh-</option>
                                <option value="0+">0 Rh+</option>
                                <option value="0-">0 Rh-</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Boy (cm)</label>
                            <input type="number" class="form-control" name="height" id="height"
                                placeholder="Örn: 175">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Kilo (kg)</label>
                            <input type="number" class="form-control" name="weight" id="weight"
                                placeholder="Örn: 75">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Acil Durumda Aranacak Kişi Telefonu</label>
                            <input type="text" class="form-control" name="emergency_contact_phone"
                                id="emergency_contact_phone" placeholder="05xx xxx xx xx">
                        </div>

                        <div class="col-md-12 mt-3">
                            <button type="button" id="save" class="btn btn-primary float-end">Yeni Hasta
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
                let birthdate = $('#birthdate').val();
                let gender_id = $('#gender_id').val();
                let country_id = $('#country_id').val();
                let city_id = $('#city_id').val();
                let address = $('#address').val();
                let service_id = $('#service_id').val();
                let source_id = $('#source_id').val();
                let blood_group_id = $('#blood_group_id').val();
                let height = $('#height').val();
                let weight = $('#weight').val();
                let emergency_contact_phone = $('#emergency_contact_phone').val();

                $.ajax({
                    type: "POST",
                    url: "{{ route('data.store') }}",
                    data: {
                        fullname: fullname,
                        email: email,
                        phone: phone,
                        birthdate: birthdate,
                        gender_id: gender_id,
                        country_id: country_id,
                        city_id: city_id,
                        address: address,
                        service_id: service_id,
                        source_id: source_id,
                        blood_group_id: blood_group_id,
                        height: height,
                        weight: weight,
                        emergency_contact_phone: emergency_contact_phone,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Başarılı!',
                            text: response.message,
                            confirmButtonColor: '#3085d6',
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Hata!',
                            text: xhr.responseJSON?.message ??
                                "Bir hata meydana geldi.",
                            confirmButtonColor: '#d33',
                        });
                    },
                })
            })
        })
    </script>
@endsection
