@extends('partials.master') @section('main') <div class="mb-4 d-flex flex-wrap gap-2">
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#smsModal">
    <i class="fas fa-sms me-1"></i> SMS Gönder
  </button>
  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#processModal">
    <i class="fas fa-plus me-1"></i> İşlem Ekle
  </button>
<button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#surgeryModal">
    <i class="fas fa-plus me-1"></i> Ameliyat Randevusu Ekle
</button>
  <button class="btn btn-info">
    <i class="fas fa-phone me-1"></i> Arama Yap </button>
<a href="https://wa.me/{{$patient->phone}}" target="_blank" class="btn btn-warning">
  <i class="fab fa-whatsapp me-1"></i> WhatsApp'tan Ulaş
</a>
<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editPatientModal">
    <i class="fas fa-edit me-1"></i> Bilgileri Düzenle
</button>
  <button class="btn btn-danger">
    <i class="fas fa-trash-alt me-1"></i> Sil </button>
<button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#assignDoctorModal">
    <i class="fas fa-user-md me-1"></i> Doktor Ata
</button>
</div>
<div class="row">
  <div class="col-md-4 mb-3">
    <div class="card shadow-sm">
      <div class="card-header">
        <h5 class="card-title mb-0">
          <i class="fas fa-user me-1"></i> Hasta Bilgileri
        </h5>
      </div>
      <div class="card-body">
        <p>
          <strong>Ad Soyad:</strong> Selim Can Gürsu
        </p>
        <p>
          <strong>Telefon:</strong> 0555 123 45 67
        </p>
        <p>
          <strong>Email:</strong> selim.gursu@example.com
        </p>
        <p>
          <strong>Doğum Tarihi:</strong> 12.03.1990
        </p>
        <p>
          <strong>Durum:</strong> Tedavi Devam Ediyor
        </p>
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="card mb-3 shadow-sm">
      <div class="card-header">
        <h5 class="card-title mb-0">
          <i class="fas fa-file-medical-alt me-1"></i> Hasta İşlem Geçmişi
        </h5>
      </div>
      <div class="card-body">
        <table class="table table-bordered mb-0">
          <thead class="table-light">
            <tr>
              <th>Tarih</th>
              <th>İşlem</th>
              <th>Doktor</th>
              <th>Durum</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>2025-11-20</td>
              <td>Lipoliz Uygulaması</td>
              <td>Dr. Ahmet Yılmaz</td>
              <td>
                <span class="badge bg-success">Tamamlandı</span>
              </td>
            </tr>
            <tr>
              <td>2025-11-22</td>
              <td>Botoks Uygulaması</td>
              <td>Dr. Merve Şimşek</td>
              <td>
                <span class="badge bg-warning">Beklemede</span>
              </td>
            </tr>
            <tr>
              <td>2025-11-24</td>
              <td>PRP Tedavisi</td>
              <td>Dr. Selim Can Gürsu</td>
              <td>
                <span class="badge bg-info">Planlandı</span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="card mb-3 shadow-sm">
      <div class="card-header ">
        <h5 class="card-title mb-0">
          <i class="fas fa-sms me-1"></i> Hasta SMS Geçmişi
        </h5>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Mesaj</th>
              <th>Durum</th>
              <th>Kullanıcı</th>
              <th>Tarih</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
    <div class="card mb-3 shadow-sm">
      <div class="card-header">
        <h5 class="card-title mb-0">
          <i class="fas fa-phone me-1"></i> Hasta Arama Geçmişi
        </h5>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Arama Türü</th>
              <th>Süre (sn)</th>
              <th>Durum</th>
              <th>Arayan Kullanıcı</th>
              <th>Tarih</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
    <div class="card mb-3 shadow-sm">
      <div class="card-header ">
        <h5 class="card-title mb-0">
          <i class="fas fa-credit-card me-1"></i> Hasta Ödeme Geçmişi
        </h5>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead class="table-light">
            <tr>
              <th>Tarih</th>
              <th>Tutar</th>
              <th>Ödeme Yöntemi</th>
              <th>Durum</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>20.11.2025</td>
              <td>4.500 TL</td>
              <td>Kredi Kartı</td>
              <td>
                <span class="badge bg-success">Ödendi</span>
              </td>
            </tr>
            <tr>
              <td>22.11.2025</td>
              <td>3.500 TL</td>
              <td>Nakit</td>
              <td>
                <span class="badge bg-warning">Beklemede</span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div> 
<!-- SMS Modal -->
<div class="modal fade" id="smsModal" tabindex="-1" aria-labelledby="smsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="smsModalLabel"><i class="fas fa-sms me-1"></i> SMS Gönder</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
      </div>
      <div class="modal-body">
        <form>
            @csrf
          <div class="mb-3" hidden>
            <label for="recipientPhone" class="form-label">Hasta ID</label>
            <input type="text" class="form-control" id="smsDataId" value="{{$patient->id}}">
          </div>
          <div class="mb-3">
            <label for="recipientPhone" class="form-label">Telefon Numarası</label>
            <input type="text" class="form-control" id="smsPhone" value="{{$patient->phone}}">
          </div>
          <div class="mb-3">
            <label for="smsMessage" class="form-label">Mesaj</label>
            <textarea class="form-control" id="smsMessage" rows="4" placeholder="Mesajınızı buraya yazın..."></textarea>
          </div>
             <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
        <button type="button" id="smsSendSave" class="btn btn-primary">Gönder</button>
      </div>
        </form>
      </div>
   
    </div>
  </div>
</div>
<!-- İşlem Ekle Modal -->
<div class="modal fade" id="processModal" tabindex="-1" aria-labelledby="processModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="processModalLabel"><i class="fas fa-plus me-1"></i> İşlem Ekle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
      </div>
      <div class="modal-body">
        <form>
             <div class="mb-3" hidden>
            <label for="patientId" class="form-label">Hasta Id</label>
            <input type="input" class="form-control" id="processPatientId" value="{{$patient->id}}">
          </div>
          <div class="mb-3">
            <label for="processName" class="form-label">İşlem Adı</label>
             <select class="form-select" id="processServiceId">
              <option value="">Seçiniz</option>
              @foreach($services as $service)
                 <option value="{{$service->id}}">{{$service->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="processDoctor" class="form-label">Doktor</label>
            <select class="form-select" id="processDoctor">
              <option value="">Seçiniz</option>
               @foreach($doctors as $doctor)
                 <option value="{{$doctor->id}}">{{$doctor->fullname}}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="processDescription" class="form-label">Açıklama</label>
            <textarea type="input" class="form-control" rows="10" id="processDescription" value="{{$patient->id}}"></textarea>
          </div>
          <div class="mb-3">
            <label for="processStatus" class="form-label">Durum</label>
            <select class="form-select" id="processStatus">
              <option value="1">Rutin Kontrol</option>
              <option value="2">Tamamlandı</option>
            </select>
          </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
           <button type="button" id="processSave" class="btn btn-success">Kaydet</button>
         </div>
        </form>
      </div>
  
    </div>
  </div>
</div>
<!-- Bilgileri Düzenle Modal -->
<div class="modal fade" id="editPatientModal" tabindex="-1" aria-labelledby="editPatientModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editPatientModalLabel"><i class="fas fa-edit me-1"></i> Hasta Bilgilerini Düzenle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
      </div>
      <div class="modal-body">
        <form>
            @csrf
          <div class="mb-3">
            <label for="editPatientName" class="form-label">Ad Soyad</label>
            <input type="text" class="form-control" id="editPatientName" value="Selim Can Gürsu">
          </div>
          <div class="mb-3">
            <label for="editPatientPhone" class="form-label">Telefon</label>
            <input type="text" class="form-control" id="editPatientPhone" value="0555 123 45 67">
          </div>
          <div class="mb-3">
            <label for="editPatientEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="editPatientEmail" value="selim.gursu@example.com">
          </div>
          <div class="mb-3">
            <label for="editPatientBirth" class="form-label">Doğum Tarihi</label>
            <input type="date" class="form-control" id="editPatientBirth" value="1990-03-12">
          </div>
          <div class="mb-3">
            <label for="editPatientStatus" class="form-label">Durum</label>
            <select class="form-select" id="editPatientStatus">
              <option value="yeni" selected>Yeni Hasta</option>
              <option value="tedaviBasladi">Tedavi Başladı</option>
              <option value="tedaviDevam">Tedavi Devam Ediyor</option>
              <option value="tamamlandi">Tamamlandı</option>
            </select>
          </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-light" data-bs-dismiss="modal">İptal</button>
           <button type="button" class="btn btn-secondary" onclick="updatePatient()">Kaydet</button>
         </div>
        </form>
      </div>

 
    </div>
  </div>
</div>
<!-- Doktor Ata Modal -->
<div class="modal fade" id="assignDoctorModal" tabindex="-1" aria-labelledby="assignDoctorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header ">
        <h5 class="modal-title" id="assignDoctorModalLabel"><i class="fas fa-user-md me-1"></i> Doktor Ata</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Kapat"></button>
      </div>
      <div class="modal-body">
        <form">
          <div class="mb-3">
            <label for="selectDoctor" class="form-label">Doktor Seçiniz</label>
            <select class="form-select" id="selectDoctor">
              <option value="">Seçiniz</option>
              <option>Dr. Selim Can Gürsu</option>
              <option>Dr. Ahmet Yılmaz</option>
              <option>Dr. Merve Şimşek</option>
              <option>Dr. Hüseyin Arslan</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="assignDate" class="form-label">Atama Tarihi</label>
            <input type="date" class="form-control" id="assignDate">
          </div>
          <div class="mb-3">
            <label for="notes" class="form-label">Notlar</label>
            <textarea class="form-control" id="notes" rows="3" placeholder="Opsiyonel not ekleyebilirsiniz"></textarea>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
        <button type="button" class="btn btn-dark" onclick="assignDoctor()">Ata</button>
      </div>
        </form>
      </div>      
    </div>
  </div>
</div>

<div class="modal fade" id="surgeryModal" tabindex="-1" aria-labelledby="surgeryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="surgeryModalLabel">Ameliyat Randevusu Ekle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
      </div>
      <div class="modal-body">
        <form id="surgeryForm">
          <input type="hidden" id="operationPatientId" value="{{ $patient->id }}">

          <div class="mb-3">
            <label class="form-label">Randevu Tarihi *</label>
            <input type="datetime-local" class="form-control" id="scheduledAt" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Yapılacak İşlem *</label>
            <select class="form-select" id="surgeryTypeId" required>
              <option selected disabled>Seçiniz</option>
              @foreach($services as $service)
                <option value="{{ $service->id }}">{{ $service->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Atanan Doktor *</label>
            <select class="form-select" id="doctor_id" required>
              <option selected disabled>Seçiniz</option>
              @foreach($doctors as $doctor)
                <option value="{{ $doctor->id }}">{{ $doctor->fullname }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Ameliyat Odası *</label>
            <select class="form-select" id="operationRoomId" required>
              <option selected disabled>Seçiniz</option>
              @for($i = 1; $i <= 10; $i++)
                <option value="{{ $i }}">Ameliyat Odası {{ $i }}</option>
              @endfor
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Durum *</label>
            <select class="form-select" id="statusId" required>
              <option selected disabled>Seçiniz</option>
              <option value="1">Beklemede</option>
              <option value="2">Onaylandı</option>
              <option value="3">Tamamlandı</option>
              <option value="4">İptal Edildi</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Notlar</label>
            <textarea class="form-control" id="notes" rows="3"></textarea>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
            <button type="button" class="btn btn-dark" id="saveSurgeryBtn">Kaydet</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<script>
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // Sms Gönder
    $('#smsSendSave').click(function(e){
        e.preventDefault();

        let dataId = $('#smsDataId').val();
        let smsPhone = $('#smsPhone').val();
        let smsMessage = $('#smsMessage').val();

        $.ajax({
            type: "POST",
            url: "{{ route('sms.patient.store') }}",
            data: {
                dataId: dataId,
                smsPhone: smsPhone,
                smsMessage: smsMessage
            },
            success: function(response){
                alert(response.message);
            },
            error: function(xhr){
                alert("Hata: " + xhr.status + " " + xhr.statusText);
            }
        });
    });
    // Servis Ekle
    $('#processSave').click(function(e){
        e.preventDefault();

        let processPatientId = $('#processPatientId').val();
        let processServiceId = $('#processServiceId').val();
        let processDoctor = $('#processDoctor').val();
        let processDescription = $('#processDescription').val();
        let processStatus = $('#processStatus').val();

        $.ajax({
            type: "POST",
            url: "{{ route('process.store') }}", // Laravel route
            data: {
                processPatientId: processPatientId,
                processServiceId: processServiceId,
                processDoctor: processDoctor,
                processDescription: processDescription,
                processStatus: processStatus
            },
           success: function(response) {
           if(response.success){
            Swal.fire({
            icon: 'success',
            title: 'Başarılı!',
            text: response.message,
            timer: 2000,
            showConfirmButton: false
           });
            // Formu sıfırlamak istersen
            $('#processForm')[0].reset();
           } else {
            Swal.fire({
            icon: 'error',
            title: 'Hata!',
            text: response.message
            });
          }
         },
         error: function(xhr){
          Swal.fire({
           icon: 'error',
           title: 'Sunucu Hatası!',
           text: xhr.status + ' ' + xhr.statusText
          });  
          }
        });
    });
    // Ameliyat Randevusu Ayarla
    $('#saveSurgeryBtn').click(function(e){
     e.preventDefault();

     $.ajax({
        type:"POST",
        url:"{{ route('operation.store') }}",
        data:{
            operationPatientId: $('#operationPatientId').val(),
            scheduledAt: $('#scheduledAt').val(),
            surgeryTypeId: $('#surgeryTypeId').val(),
            doctor_id: $('#doctor_id').val(),
            operationRoomId: $('#operationRoomId').val(),
            statusId: $('#statusId').val(),
            notes: $('#notes').val(),
            _token: "{{ csrf_token() }}"
        },
        success:function(response){
            if(response.success){
                Swal.fire({
                    icon: 'success',
                    title: 'Başarılı!',
                    text: response.message,
                    timer: 2000,
                    showConfirmButton: false
                });

                $('#surgeryForm')[0].reset();
                $('#surgeryModal').modal('hide');
            }
        },
        error:function(xhr){
            Swal.fire({
                icon: 'error',
                title: 'Hata!',
                text: xhr.responseJSON?.message ?? "Sunucu hatası"
            });
        }
    });
    // 
});

});


</script>
@endsection