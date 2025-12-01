@extends('partials.master')

@section('main')
    <div class="card">
        <div class="card-header">
            <h3>Ödeme Oluşturma Formu</h3>
        </div>
        <div class="card-body">
            <form>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Müşteri Seçimi</label>
                        <select class="form-select" id="customer_id">
                            <option selected disabled>Müşteri seçiniz</option>
                            @foreach ($customers as $customer)
                                <option id="{{ $customer->id }}">{{ $customer->fullname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label d-block">Yapılacak İşlem</label>
                        <select class="form-select" id="service_id">
                            <option selected disabled>İşlem seçiniz</option>
                            @foreach ($services as $service)
                                <option data-price={{ $service->price }} value="{{ $service->id }}">{{ $service->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">İndirim Tutarı</label>
                        <div class="input-group">
                            <input type="number" class="form-control" required placeholder="İndirim tutarı giriniz">
                            <button class="btn btn-primary" id="discountCreate" type="button">İndirimi Uygula</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">İndirimli Tutar</label>
                        <input type="text" class="form-control" id="discount_amount" placeholder="İndirim sonrası tutar"
                            disabled>
                    </div>
                    <div class="col-12 mt-3">
                        <button class="btn btn-success w-100" type="button" id="save">Ödeme Bilgisi Gönder</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {

            // İndirim uygulama
            $("#discountCreate").on("click", function() {
                let servicePrice = $("#service_id option:selected").data("price");
                let discountInput = $("input[placeholder='İndirim tutarı giriniz']").val();

                if (!servicePrice) {
                    alert("Lütfen önce bir işlem seçiniz.");
                    return;
                }

                // İndirim girilmemişse
                let discount = discountInput === "" ? 0 : parseFloat(discountInput);

                if (discount < 0) {
                    alert("Geçerli bir indirim tutarı giriniz.");
                    return;
                }

                let discountedAmount = servicePrice - discount;

                if (discountedAmount < 0) discountedAmount = 0;

                $("#discount_amount").val(discountedAmount + " ₺");
            });

            $("#save").on("click", function() {

                let customerId = $("#customer_id option:selected").attr("id");
                let serviceId = $("#service_id").val();
                let discount = $("input[placeholder='İndirim tutarı giriniz']").val();
                let discountedAmount = $("#discount_amount").val();

                if (!customerId || !serviceId) {
                    alert("Lütfen müşteri ve yapılacak işlemi seçiniz.");
                    return;
                }

                $.ajax({
                    url: "{{ route('finance.sendPayment.post') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        customer_id: customerId,
                        service_id: serviceId,
                        discount: discount,
                        discounted_price: discountedAmount
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Başarılı!',
                            text: 'Ödeme başarıyla kaydedildi!',
                            confirmButtonText: 'Tamam'
                        });
                        console.log(response.message);
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Hata!',
                            text: 'Bir hata oluştu.',
                            confirmButtonText: 'Tamam'
                        });
                        console.log(xhr.responseText);
                    }

                });
            });

        });
    </script>
@endsection
