@extends('partials.master')
@section('main')
    <div class="container-fluid p-0">
        <div class="row g-3">
            <div class="col-md-3">
                <div class="card p-3">
                    <h4>Tüm Kayıtlar</h4>
                    <p>Sistemdeki tüm lead kayıtlarını görüntüleyebilirsiniz.</p>
                    <a href="{{route('leads.index')}}" class="btn btn-primary">Görüntüle</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3">
                    <h4>Yeni Lead Ekle</h4>
                    <p>Sisteme yeni bir lead kaydı eklemek için tıklayın.</p>
                    <a href="{{route('leads.create')}}" class="btn btn-primary">Görüntüle</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3">
                    <h4>Lead Status Ekle</h4>
                    <p>Lead durumlarını yönetmek ve yeni durum eklemek</p>
                    <a href="{{route('leads.status')}}" class="btn btn-primary">Görüntüle</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3">
                    <h4>Lead Kaynakları</h3>
                    <p>Web Form gibi lead kaynaklarını inceleyin.</p>
                    <a href="{{route('leads.leadSources')}}" class="btn btn-primary">Görüntüle</a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card p-3">
                    <h4>Lead Analitiği</h4>
                    <p>Özet Lead oranlar raporlarını inceleyin.</p>
                    <a href="{{route('leads.miniReport')}}" class="btn btn-primary">Görüntüle</a>
                </div>
            </div>
        </div>
    </div>
@endsection
