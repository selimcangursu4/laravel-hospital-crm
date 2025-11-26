@extends('partials.master')
@section('main')
    <div class="container-fluid p-0">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card p-3">
                    <h4>Tüm Muayene Randevuları</h4>
                    <p>Bu Alandan Tüm Muayene Tarihleri Listelenebilir</p>
                    <a href="{{route('meeting.appointmentView')}}" class="btn btn-primary">Görüntüle</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3">
                    <h4>Takvim</h4>
                    <p>Bu Alandan Takvimi Görüntüleyebilirsiniz.</p>
                    <a href="{{route('meeting.calendarView')}}" class="btn btn-primary">Görüntüle</a>
                </div>
            </div>
             <div class="col-md-4">
                <div class="card p-3">
                    <h4>Tüm Ameliyat İşlemleri</h4>
                    <p>Bu Alandan Tüm Ameliyatlar Listelenebilir</p>
                    <a href="{{route('meeting.operationView')}}" class="btn btn-primary">Görüntüle</a>
                </div>
            </div>
        </div>
    </div>
@endsection
