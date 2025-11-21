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
                                <option value="1">Operasyon 1</option>
                                <option value="2">Operasyon 2</option>
                                <option value="3">Operasyon 3</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Lead Kaynağı</label>
                            <select class="form-select mb-3" id="source_id">
                                <option selected>Seçiniz</option>
                                <option value="1">Kaynak 1</option>
                                <option value="2">Kaynak 2</option>
                                <option value="3">Kaynak 3</option>
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
                            <button id="save" class="btn btn-primary float-end px-4">Yeni Lead Ekle</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
