@extends('partials.master')

@section('main')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ödeme Listesi</h3>
        </div>
        <div class="card-body">

            <table id="paymentTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Müşteri</th>
                        <th>Hizmet</th>
                        <th>Hizmet Ücreti</th>
                        <th>İndirim</th>
                        <th>Son Fiyat</th>
                        <th>Durum</th>
                        <th>Oluşturulma</th>
                        <th>İşlem</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="modal fade" id="statusModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ödeme Durumu Güncelle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="payment_id">
                    <label>Durum Seç:</label>
                    <select id="payment_status" class="form-control">
                        <option value="Beklemede">Beklemede</option>
                        <option value="Ödeme Tamamlandı">Ödeme Tamamlandı</option>
                        <option value="İptal Edildi">İptal Edildi</option>
                        <option value="İade Edildi">İade Edildi</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                    <button class="btn btn-success" id="saveStatusBtn">Kaydet</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function() {

            var table = $('#paymentTable').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                ajax: "{{ route('payment.fetch') }}",
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'patient_name'
                    },
                    {
                        data: 'service_name'
                    },
                    {
                        data: 'service_price'
                    },
                    {
                        data: 'discount'
                    },
                    {
                        data: 'final_price'
                    },
                    {
                        data: 'payment_status'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            //  Modal Açma 
            $(document).on("click", ".editStatusBtn", function() {
                $("#payment_id").val($(this).data("id"));
                $("#payment_status").val($(this).data("status"));
                $("#statusModal").modal("show");
            });
            // Durum Güncelle
            $("#saveStatusBtn").click(function() {

                let id = $("#payment_id").val();
                let status = $("#payment_status").val();

                $.ajax({
                    url: "{{ route('payment.status.update') }}",
                    type: "POST",
                    data: {
                        payment_id: id,
                        payment_status: status,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            $("#statusModal").modal("hide");
                            $('#paymentTable').DataTable().ajax.reload(null, false);

                            Swal.fire({
                                icon: 'success',
                                title: 'Başarılı',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            });
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Uyarı',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Hata',
                            text: "Bir hata oluştu: " + xhr.responseText
                        });
                    }

                });

            });

        });
    </script>
@endsection
