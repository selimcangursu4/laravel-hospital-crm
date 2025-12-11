@extends('partials.master')
@section('main')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3>Yeni Kullanıcı Ekle</h3>
        </div>
        <div class="card-body">
            <form id="userAddForm">
                @csrf
                <div class="col-md-12 mb-3">
                    <label>Ad Soyad</label>
                    <input type="text" class="form-control" name="name" required>
                </div>

                <div class="col-md-12 mb-3">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>

                <div class="col-md-12 mb-3">
                    <label>Şifre</label>
                    <input type="password" class="form-control" name="password" required>
                </div>

                <button class="btn btn-primary" type="submit">Kaydet</button>
            </form>
        </div>
    </div>
</div>
<script>
    $("#userAddForm").on("submit", function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('users.store') }}",
            method: "POST",
            data: $(this).serialize(),

            success: function(res) {
                Swal.fire({
                    icon: 'success',
                    title: 'Başarılı!',
                    text: res.message,
                    confirmButtonText: 'Tamam'
                });

                $("#userAddForm")[0].reset();
            },

            error: function(xhr) {
                let errorMessage = "Bir hata oluştu!";
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    errorMessage = Object.values(xhr.responseJSON.errors)
                        .map(err => err.join(", "))
                        .join("\n");
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Hata!',
                    text: errorMessage,
                    confirmButtonText: 'Tamam'
                });
            }
        });
    });
</script>
@endsection
