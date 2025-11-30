@extends('partials.master')
@section('main')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Muayene Randevuları</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="appointments-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Hasta Adı</th>
                        <th>Tarih</th>
                        <th>Saat</th>
                        <th>Servis</th>
                        <th>Durum</th>
                        <th>İşlem</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="appointmentModal" tabindex="-1">
        <div class="modal-dialog">
            <form id="appointmentForm">
                @csrf
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Randevu İşlemleri</h5>
                        <button type="button" class="close" data-bs-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <input type="hidden" name="lead_id" id="lead_id">

                        <div class="mb-3">
                            <label>Durum</label>
                            <select class="form-select" name="status_id" id="status_id">
                                <option value="">Seçiniz</option>
                                <option value="8">Görüşme İptal Edildi</option>
                                <option value="7">Görüşme Tamamlandı</option>
                            </select>
                        </div>

                        <div>
                            <label>Not</label>
                            <textarea class="form-control" name="note" id="note" rows="5"></textarea>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                        <button type="button" id="saveUpdate" class="btn btn-primary">Kaydet</button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            let table = $('#appointments-table').DataTable({
                processing: true,
                serverSide: false,
                ajax: '{{ route('preappointment.fetch') }}',
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'patient_name'
                    },
                    {
                        data: 'appointment_datetime',
                        render: d => d ? new Date(d).toLocaleDateString() : ''
                    },
                    {
                        data: 'appointment_datetime',
                        render: d => d ? new Date(d).toLocaleTimeString([], {
                            hour: '2-digit',
                            minute: '2-digit'
                        }) : ''
                    },
                    {
                        data: 'service_name'
                    },
                    {
                        data: 'status_id',
                        render: function(data) {
                            switch (data) {
                                case 10:
                                    return 'Randevu Oluşturuldu';
                                case 8:
                                    return 'İptal Edildi';
                                case 7:
                                    return 'Tamamlandı';
                                default:
                                    return 'Bilinmiyor';
                            }
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row) {
                            return `
                        <button class="btn btn-sm btn-primary open-modal"
                                data-lead_id="${row.lead_id}"
                                data-bs-toggle="modal"
                                data-bs-target="#appointmentModal">
                            İşlem
                        </button>`;
                        }
                    }
                ]
            });
            $(document).on('click', '.open-modal', function() {
                $('#lead_id').val($(this).data('lead_id'));
            });
            $('#saveUpdate').click(function() {

                let formData = {
                    _token: $('input[name="_token"]').val(),
                    lead_id: $('#lead_id').val(),
                    note: $('#note').val(),
                    status_id: $('#status_id').val()
                };

                $.ajax({
                    url: "{{ route('preappointment.update') }}",
                    type: "POST",
                    data: formData,
                    success: function(res) {
                        if (res.success) {
                            Swal.fire({
                                title: "Başarılı!",
                                text: "İşlem başarıyla kaydedildi.",
                                icon: "success",
                                confirmButtonText: "Tamam"
                            });

                            $('#appointmentModal').modal('hide');
                            table.ajax.reload();
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: "Hata!",
                            text: xhr.responseJSON?.message ??
                                "Bilinmeyen bir hata oluştu.",
                            icon: "error",
                            confirmButtonText: "Tamam"
                        });
                    }
                });
            });
        });
    </script>
@endsection
