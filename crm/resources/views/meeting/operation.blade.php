@extends('partials.master')
@section('main')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ameliyat Listesi</h3>
        </div>

        <div class="card-body">
            <table id="surgeryTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Hasta</th>
                        <th>Doktor</th>
                        <th>Ameliyat Türü</th>
                        <th>Oda</th>
                        <th>Tarih</th>
                        <th>Durum</th>
                        <th>Not</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#surgeryTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('operations.fetch') }}',
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
                        data: 'service_name',
                        name: 'service_name'
                    },
                    {
                        data: 'room_id',
                        name: 'room_id',
                        render: function(data, type, row) {
                            if (data == 1) return 'Ameliyat Odası 1';
                            else if (data == 2) return 'Ameliyat Odası 2';
                            else if (data == 3) return 'Ameliyat Odası 3';
                            else if (data == 4) return 'Ameliyat Odası 4';
                            else if (data == 5) return 'Ameliyat Odası 5';
                            else if (data == 6) return 'Ameliyat Odası 6';
                            else if (data == 7) return 'Ameliyat Odası 7';
                            else if (data == 8) return 'Ameliyat Odası 8';
                            else if (data == 9) return 'Ameliyat Odası 9';
                            else if (data == 10) return 'Ameliyat Odası 10';
                            else return 'Bilinmiyor';
                        }
                    },
                    {
                        data: 'scheduled_at',
                        name: 'scheduled_at'
                    },
                    {
                        data: 'status_id',
                        name: 'status_id',
                        render: function(data, type, row) {
                            if (data == 1) return 'Beklemede';
                            else if (data == 2) return 'Onaylandı';
                            else if (data == 3) return 'Tamamlandı';
                            else if (data == 4) return 'İptal Edildi';
                            else return 'Bilinmiyor';
                        }
                    },
                    {
                        data: 'notes',
                        name: 'notes'
                    },
                ]
            });
        });
    </script>
@endsection
