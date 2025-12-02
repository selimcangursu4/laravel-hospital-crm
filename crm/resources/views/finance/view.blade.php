@extends('partials.master')
@section('main')
    <div class="container-fluid p-0">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card p-3">
                    <h4>Ödeme Oluştur</h4>
                    <p>Bu Alandan Muayene Ücreti Oluşturulur</p>
                    <a href="{{route('finance.sendPayment')}}" class="btn btn-primary">Görüntüle</a>
                </div>
            </div>
             <div class="col-md-4">
                <div class="card p-3">
                    <h4>Ödeme Tamamla</h4>
                    <p>Bu Alandan Muayene Ücreti Girilebilir</p>
                    <a href="{{route('finance.createPayment')}}" class="btn btn-primary">Görüntüle</a>
                </div>
            </div>
        </div>
    </div>
@endsection
