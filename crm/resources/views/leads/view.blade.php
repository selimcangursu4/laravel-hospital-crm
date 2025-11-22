@extends('partials.master')
@section('main')
    <div class="container-fluid p-0">
        <div class="row g-3">
            <div class="col-md-3">
                <div class="card p-3">
                    <h4>Tüm Kayıtlar</h4>
                    <p>Tüm Lead Kayıtlarını Görüntüleyebilirsiniz.</p>
                    <a href="{{route('leads.index')}}" class="btn btn-primary">Görüntüle</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3">
                    <h4>Yeni Lead Ekle</h4>
                    <p>Sisteme Yeni Bir Lead Kaydı Eklemek İçin Tıklayın.</p>
                    <a href="{{route('leads.create')}}" class="btn btn-primary">Görüntüle</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3">
                    <h4>Günlük Lead Analitiği</h4>
                    <p>Özet Günlük Lead Oranlar raporlarını İnceleyin.</p>
                    <a href="{{route('leads.miniReport')}}" class="btn btn-primary">Görüntüle</a>
                </div>
            </div>
        </div>
    </div>
@endsection
