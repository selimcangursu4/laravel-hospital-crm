@extends('partials.master')
@section('main')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Muayene Randevularını Filtrele
            </h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="appointments-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Hasta Adı</th>
                        <th>Doktor</th>
                        <th>Tarih</th>
                        <th>Saat</th>
                        <th>Durum</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#appointments-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '#', 
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'patient_name',
                        name: 'patient_name'
                    },
                    {
                        data: 'doctor_name',
                        name: 'doctor_name'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'time',
                        name: 'time'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    }
                ]
            });
        });
    </script>
@endsection
