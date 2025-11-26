@extends('partials.master') @section('main')
    <div class="mb-4 d-flex flex-wrap gap-2">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#smsModal">
            <i class="fas fa-sms me-1"></i> SMS Gönder
        </button>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#processModal">
            <i class="fas fa-plus me-1"></i> İşlem Ekle
        </button>
        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#surgeryModal">
            <i class="fas fa-plus me-1"></i> Ameliyat Randevusu Ekle
        </button>
        <button class="btn btn-info" id="callButton">
            <i class="fas fa-phone me-1"></i> Arama Yap
        </button>
        <a href="https://wa.me/{{ $patient->phone }}" target="_blank" class="btn btn-warning">
            <i class="fab fa-whatsapp me-1"></i> WhatsApp'tan Ulaş
        </a>
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editPatientModal">
            <i class="fas fa-edit me-1"></i> Bilgileri Düzenle
        </button>
        <button class="btn btn-danger" id="deletePatient">
            <i class="fas fa-trash-alt me-1"></i> Sil </button>
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
                    <p><strong>Ad Soyad:</strong> {{ $patient->fullname ?? 'Belirtilmemiş' }}</p>
                    <p><strong>Telefon:</strong> {{ $patient->phone ?? 'Belirtilmemiş' }}</p>
                    <p><strong>Email:</strong> {{ $patient->email ?? 'Belirtilmemiş' }}</p>
                    <p><strong>Doğum Tarihi:</strong>
                        {{ $patient->birth_date ? \Carbon\Carbon::parse($patient->birth_date)->format('d.m.Y') : 'Belirtilmemiş' }}
                    </p>
                    <p><strong>Cinsiyet:</strong>
                        @if ($patient->gender_id == 1)
                            Erkek
                        @elseif($patient->gender_id == 2)
                            Kadın
                        @else
                            Belirtilmedi
                        @endif
                    </p>

                    <p><strong>Ülke:</strong> {{ $patient->country_name ?? 'Belirtilmemiş' }}</p>
                    <p><strong>Şehir:</strong> {{ $patient->city_name ?? 'Belirtilmemiş' }}</p>
                    <p><strong>Adres:</strong> {{ $patient->address ?? 'Belirtilmemiş' }}</p>
                    <p><strong>Hizmet:</strong> {{ $patient->service_name ?? 'Belirtilmemiş' }}</p>
                    <p><strong>Kaynak:</strong> {{ $patient->source_id ?? 'Belirtilmemiş' }}</p>
                    <p><strong>Sorumlu Kullanıcı:</strong> {{ $patient->user_name ?? 'Belirtilmemiş' }}</p>
                    <p><strong>Doktor:</strong> {{ $patient->doctor_name ?? 'Belirtilmemiş' }}</p>
                    <p><strong>Durum:</strong> {{ $patient->status_name ?? 'Belirtilmemiş' }}</p>
                    <p><strong>Kan Grubu:</strong> {{ $patient->blood_type ?? 'Belirtilmemiş' }}</p>
                    <p><strong>Boy:</strong> {{ $patient->height ?? '-' }} cm</p>
                    <p><strong>Kilo:</strong> {{ $patient->weight ?? '-' }} kg</p>
                    <p><strong>Acil Durum İrtibatı:</strong> {{ $patient->emergency_contact_name ?? 'Belirtilmemiş' }}</p>
                    <p><strong>Oluşturulma Tarihi:</strong>
                        {{ $patient->created_at ? \Carbon\Carbon::parse($patient->created_at)->format('d.m.Y H:i') : '-' }}
                    </p>
                    <p><strong>Güncellenme Tarihi:</strong>
                        {{ $patient->updated_at ? \Carbon\Carbon::parse($patient->updated_at)->format('d.m.Y H:i') : '-' }}
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
                        <tbody>
                            @foreach ($smsLogs as $index => $log)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $log->message ?? 'Belirtilmemiş' }}</td>
                                    <td>
                                        @if ($log->status == "pending")
                                            Beklemede
                                        @elseif($log->status == "success")
                                            Başarılı
                                        @else
                                            Bilinmiyor
                                        @endif
                                    </td>
                                    <td>{{ $log->called_by_name}}</td>
                                    <td>{{ $log->created_at ? \Carbon\Carbon::parse($log->created_at)->format('d.m.Y H:i') : '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
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
                        <tbody>
                               @foreach ($dataCallLog as $index => $log)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        @if ($log->call_type == "outgoing")
                                            Giden Çağrı
                                        @elseif($log->call_type == "incoming")
                                            Gelen Çağrı
                                        @else
                                            Bilinmiyor
                                        @endif
                                    </td>
                                      <td>{{ $log->call_duration}}</td>
                                     <td>
                                        @if ($log->call_status == "completed")
                                            Başarılı
                                        @elseif($log->call_status == "missed")
                                             Beklemede
                                             @elseif($log->call_status == "failed")
                                            Başarısız
                                        @else
                                            Bilinmiyor
                                        @endif
                                    </td>
                                     <td>{{ $log->called_by_name}}</td>
                                    <td>{{ $log->created_at ? \Carbon\Carbon::parse($log->created_at)->format('d.m.Y H:i') : '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
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
                            <input type="text" class="form-control" id="smsDataId" value="{{ $patient->id }}">
                        </div>
                        <div class="mb-3">
                            <label for="recipientPhone" class="form-label">Telefon Numarası</label>
                            <input type="text" class="form-control" id="smsPhone" value="{{ $patient->phone }}">
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
                            <input type="input" class="form-control" id="processPatientId"
                                value="{{ $patient->id }}">
                        </div>
                        <div class="mb-3">
                            <label for="processName" class="form-label">İşlem Adı</label>
                            <select class="form-select" id="processServiceId">
                                <option value="">Seçiniz</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="processDoctor" class="form-label">Doktor</label>
                            <select class="form-select" id="processDoctor">
                                <option selected="">Seçiniz</option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->fullname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="processDescription" class="form-label">Açıklama</label>
                            <textarea type="input" class="form-control" rows="10" id="processDescription" value="{{ $patient->id }}"></textarea>
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
    <div class="modal fade" id="editPatientModal" tabindex="-1" aria-labelledby="editPatientModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPatientModalLabel">
                        <i class="fas fa-edit me-1"></i> Hasta Bilgilerini Düzenle
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
                </div>
                <div class="modal-body">
                    <form>
                        @csrf
                        <input type="hidden" id="editPatientId" value="{{ $patient->id }}">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ad Soyad</label>
                                <input type="text" class="form-control" id="editPatientName"
                                    value="{{ $patient->fullname }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="editPatientEmail"
                                    value="{{ $patient->email }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Telefon</label>
                                <input type="text" class="form-control" id="editPatientPhone"
                                    value="{{ $patient->phone }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Doğum Tarihi</label>
                                <input type="date" class="form-control" id="editPatientBirth"
                                    value="{{ $patient->birth_date }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Cinsiyet</label>
                                <select class="form-select" id="editPatientGender">
                                    <option value="">Seçiniz</option>
                                    <option value="1" {{ $patient->gender_id == 1 ? 'selected' : '' }}>Erkek</option>
                                    <option value="2" {{ $patient->gender_id == 2 ? 'selected' : '' }}>Kadın</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kan Grubu</label>
                                <select class="form-select" id="editPatientBlood" name="blood_type">
                                    <option value="">Kan Grubu Seçiniz</option>

                                    <option value="A+" {{ $patient->blood_type == 'A+' ? 'selected' : '' }}>A Rh+
                                    </option>
                                    <option value="A-" {{ $patient->blood_type == 'A-' ? 'selected' : '' }}>A Rh-
                                    </option>
                                    <option value="0+" {{ $patient->blood_type == '0+' ? 'selected' : '' }}>0 Rh+
                                    </option>
                                    <option value="0-" {{ $patient->blood_type == '0-' ? 'selected' : '' }}>0 Rh-
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Boy (cm)</label>
                                <input type="text" class="form-control" id="editPatientHeight"
                                    value="{{ $patient->height }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kilo (kg)</label>
                                <input type="text" class="form-control" id="editPatientWeight"
                                    value="{{ $patient->weight }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ülke</label>
                                <select class="form-select" id="editPatientCountry">
                                    <option value="1" {{ $patient->country_id == '1' ? 'selected' : '' }}>Türkiye
                                    </option>
                                    <option value="2" {{ $patient->country_id == '2' ? 'selected' : '' }}>Amerika
                                    </option>
                                    <option value="3" {{ $patient->country_id == '3' ? 'selected' : '' }}>Almanya
                                    </option>
                                    <option value="4" {{ $patient->country_id == '4' ? 'selected' : '' }}>Fransa
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Şehir</label>
                                <select class="form-select" id="editPatientCity">
                                    <option value="1" {{ $patient->city_id == '1' ? 'selected' : '' }}>İstanbul
                                    </option>
                                    <option value="2" {{ $patient->city_id == '2' ? 'selected' : '' }}>Ankara
                                    </option>
                                    <option value="3" {{ $patient->city_id == '3' ? 'selected' : '' }}>İzmir</option>
                                    <option value="4" {{ $patient->city_id == '4' ? 'selected' : '' }}>Bursa</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Adres</label>
                                <textarea class="form-control" id="editPatientAddress" rows="2">{{ $patient->address }}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Alınan Hizmet</label>
                                <select class="form-select" id="editPatientService">
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}"
                                            {{ $service->id == $patient->service_id ? 'selected' : '' }}>
                                            {{ $service->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Doktor</label>
                                <select class="form-select" id="editPatientDoctor">
                                    @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor->id }}"
                                            {{ $doctor->id == $patient->doctor_id ? 'selected' : '' }}>
                                            {{ $doctor->fullname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Durum</label>
                                <select class="form-select" id="editPatientStatus">
                                    <option value="">Seçiniz</option>
                                    <option value="1" {{ $patient->patient_status_id == 1 ? 'selected' : '' }}>Yeni
                                        Başvuru</option>
                                    <option value="2" {{ $patient->patient_status_id == 2 ? 'selected' : '' }}>
                                        Görüşme Yapıldı</option>
                                    <option value="3" {{ $patient->patient_status_id == 3 ? 'selected' : '' }}>Tedavi
                                        Başladı</option>
                                    <option value="4" {{ $patient->patient_status_id == 4 ? 'selected' : '' }}>
                                        Tamamlandı</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Acil Durum Yakını</label>
                                <input type="text" class="form-control" id="editEmergencyName"
                                    value="{{ $patient->emergency_contact_name }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">İptal</button>
                            <button type="button" id="patientUpdateSave" class="btn btn-secondary">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Ameliyat Randevusu Ayarla Modal -->
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
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Atanan Doktor *</label>
                            <select class="form-select" id="doctor_id" required>
                                <option selected disabled>Seçiniz</option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->fullname }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ameliyat Odası *</label>
                            <select class="form-select" id="operationRoomId" required>
                                <option selected disabled>Seçiniz</option>
                                @for ($i = 1; $i <= 10; $i++)
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
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Sms Gönder
            $('#smsSendSave').click(function(e) {
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
                    success: function(response) {
                        alert(response.message);
                    },
                    error: function(xhr) {
                        alert("Hata: " + xhr.status + " " + xhr.statusText);
                    }
                });
            });
            // Servis Ekle
            $('#processSave').click(function(e) {
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
                        if (response.success) {
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
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Sunucu Hatası!',
                            text: xhr.status + ' ' + xhr.statusText
                        });
                    }
                });
            });
            // Ameliyat Randevusu Ayarla
            $('#saveSurgeryBtn').click(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{ route('operation.store') }}",
                    data: {
                        operationPatientId: $('#operationPatientId').val(),
                        scheduledAt: $('#scheduledAt').val(),
                        surgeryTypeId: $('#surgeryTypeId').val(),
                        doctor_id: $('#doctor_id').val(),
                        operationRoomId: $('#operationRoomId').val(),
                        statusId: $('#statusId').val(),
                        notes: $('#notes').val(),
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
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
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Hata!',
                            text: xhr.responseJSON?.message ?? "Sunucu hatası"
                        });
                    }
                });
            });
            // Hasta Bilgilerini Güncelle
            $('#patientUpdateSave').click(function(e) {
                e.preventDefault();

                let id = $('#editPatientId').val();
                let fullname = $('#editPatientName').val();
                let email = $('#editPatientEmail').val();
                let phone = $('#editPatientPhone').val();
                let birth_date = $('#editPatientBirth').val();
                let gender_id = $('#editPatientGender').val();
                let blood_type = $('#editPatientBlood').val();
                let height = $('#editPatientHeight').val();
                let weight = $('#editPatientWeight').val();
                let country_id = $('#editPatientCountry').val();
                let city_id = $('#editPatientCity').val();
                let address = $('#editPatientAddress').val();
                let service_id = $('#editPatientService').val();
                let doctor_id = $('#editPatientDoctor').val();
                let patient_status_id = $('#editPatientStatus').val();
                let emergency_contact_name = $('#editEmergencyName').val();
                let _token = "{{ csrf_token() }}";

                $.ajax({
                    type: "POST",
                    url: "{{ route('data.update') }}",
                    data: {
                        id: id,
                        fullname: fullname,
                        email: email,
                        phone: phone,
                        birth_date: birth_date,
                        gender_id: gender_id,
                        blood_type: blood_type,
                        height: height,
                        weight: weight,
                        country_id: country_id,
                        city_id: city_id,
                        address: address,
                        service_id: service_id,
                        doctor_id: doctor_id,
                        patient_status_id: patient_status_id,
                        emergency_contact_name: emergency_contact_name,
                        _token: _token
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Başarılı',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            });
                            $('#editPatientModal').modal('hide');
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Uyarı',
                                text: response.message,
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Hata oluştu',
                            text: xhr.responseJSON?.message ?? "Sunucu hatası"
                        });
                    }
                });
            });
            // Silme
            $('#deletePatient').click(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Emin misiniz?',
                    text: "Bu hastayı silmek istediğinize emin misiniz?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Evet, Sil',
                    cancelButtonText: 'Vazgeç',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {

                        let deleteId = "{{ $patient->id }}";
                        $.ajax({
                            type: "POST",
                            url: "{{ route('data.delete') }}",
                            data: {
                                _token: "{{ csrf_token() }}",
                                deleteId: deleteId
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Başarılı!',
                                    'Silme işlemi başarılı.',
                                    'success'
                                );
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Hata!',
                                    'İşlem sırasında bir sorun oluştu.',
                                    'error'
                                );
                            }
                        });

                    }
                });
            })
            // Arama Yap
            $(document).on('click', '#callButton', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Emin misiniz?',
                    text: "Bu hastayı aramak istediğinize emin misiniz?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Evet, Ara',
                    cancelButtonText: 'Vazgeç',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {

                        let patientId = "{{ $patient->id }}";
                        $.ajax({
                            type: "POST",
                            url: "{{ route('patient.call.log') }}",
                            data: {
                                _token: "{{ csrf_token() }}",
                                patientId: patientId
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Başarılı!',
                                    'Arama işlemi başlatıldı.',
                                    'success'
                                );
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Hata!',
                                    'İşlem sırasında bir sorun oluştu.',
                                    'error'
                                );
                            }
                        });

                    }
                });
            });


        });
    </script>
@endsection
