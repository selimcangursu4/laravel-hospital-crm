@extends('partials.master')
@section('main')
    <div class="container-fluid p-0">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card p-3">
                    <h4>Tüm Hasta Kayıtlar</h4>
                    <p>Tüm Hasta Kayıtlarını Görüntüleyebilirsiniz.</p>
                    <a href="{{route('data.index')}}" class="btn btn-primary">Görüntüle</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3">
                    <h4>Yeni Hasta Ekle</h4>
                    <p>Sisteme Yeni Bir Hasta Kaydı Eklemek İçin Tıklayın.</p>
                    <a href="{{route('data.create')}}" class="btn btn-primary">Görüntüle</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3">
                    <h4>Günlük Hasta Analitiği</h4>
                    <p>Özet Günlük Hasta Oranlar raporlarını İnceleyin.</p>
                    <a href="{{route('data.miniReport')}}" class="btn btn-primary">Görüntüle</a>
                </div>
            </div>
        </div>
    </div>
@endsection
