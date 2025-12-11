@extends('partials.master')
@section('main')
    <div class="container-fluid p-0">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card p-3">
                    <h4>Tüm Personeller</h4>
                    <p>Tüm Personel Kayıtlarını Görüntüleyebilirsiniz.</p>
                    <a href="{{route('setting.user.index')}}" class="btn btn-primary">Görüntüle</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3">
                    <h4>Yeni Personel Ekle</h4>
                    <p>Sisteme Yeni Personel Kaydı Eklemek İçin Tıklayın.</p>
                    <a href="{{route('setting.user.create')}}" class="btn btn-primary">Görüntüle</a>
                </div>
            </div>
        </div>
    </div>
@endsection
