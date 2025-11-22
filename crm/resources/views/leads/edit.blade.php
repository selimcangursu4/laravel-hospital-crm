@extends('partials.master')
@section('main')
    <div class="container-fluid">
        <div class="mb-4">
            <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#smsSendModal">
                <i data-feather="message-square" class="me-1"></i> Sms Gönder
            </button>
            <button id="makeCallButton" class="btn btn-info me-2">
                <i data-feather="phone" class="me-1"></i> Arama Yap
            </button>
            <a href="https://wa.me/{{ $lead->phone }}?text=Merhaba Amerikan Estetik Hastanesinden Sizlere Ulaşıyorum"
                target="_blank" class="btn btn-success me-2">
                <i data-feather="smartphone" class="me-1"></i> WhatsApp'tan Ulaş
            </a>
            <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <i data-feather="edit" class="me-1"></i> Bilgileri Düzenle
            </button>
            <button id="deleteLeadButton" class="btn btn-danger me-2" data-lead-id="{{ $lead->id }}">
                <i data-feather="trash-2" class="me-1"></i> Sil
            </button>
            <button type="button" class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#activityModal">
                <i data-feather="plus-circle" class="me-1"></i> Aktivite Ekle
            </button>
            <button type="button" class="btn btn-secondary me-2" data-bs-toggle="modal" data-bs-target="#userAssignModal">
                <i data-feather="user-plus" class="me-1"></i> Personel Ata
            </button>
            <button type="button" class="btn btn-dark me-2" data-bs-toggle="modal" data-bs-target="#fileAttachModal">
                <i data-feather="paperclip" class="me-1"></i> Dosya Eki Ekle
            </button>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Lead Bilgileri</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Ad Soyad</th>
                                    <td>{{ $lead->fullname }}</td>
                                </tr>
                                <tr>
                                    <th>E-posta</th>
                                    <td>{{ $lead->email }}</td>
                                </tr>
                                <tr>
                                    <th>Telefon</th>
                                    <td>{{ $lead->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Doğum Tarihi</th>
                                    <td>{{ $lead->birth_date ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Cinsiyet</th>
                                    <td>
                                        @if ($lead->gender_id == 1)
                                            Erkek
                                        @elseif($lead->gender_id == 2)
                                            Kadın
                                        @elseif($lead->gender_id == 3)
                                            Belirtilmedi
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Ülke</th>
                                    <td>{{ $lead->country_id ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Şehir</th>
                                    <td>{{ $lead->city_id ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Hizmet</th>
                                    <td>{{ $lead->service_name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Kaynak</th>
                                    <td>{{ $lead->source_name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Not</th>
                                    <td>{{ $lead->note ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Sorumlu Kullanıcı</th>
                                    <td>{{ $lead->user_name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Lead Durumu</th>
                                    <td>{{ $lead->status_name ?? '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Lead Aktivite Geçmişi</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Durum</th>
                                    <th>Açıklama</th>
                                    <th>Kullanıcı</th>
                                    <th>Tarih</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activities as $index => $activity)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $activity->status_name }}</td>
                                        <td>{{ $activity->description }}</td>
                                        <td>{{ $activity->user_name }}</td>
                                        <td>{{ $activity->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Lead Arama Geçmişi</h5>
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
                                @forelse($callLogs as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            @if ($item->call_type == 'incoming')
                                                Gelen
                                            @else
                                                Giden
                                            @endif
                                        </td>
                                        <td>{{ $item->call_duration ?? '-' }}</td>
                                        <td>
                                            @switch($item->call_status)
                                                @case('completed')
                                                    Tamamlandı
                                                @break

                                                @case('missed')
                                                    Kaçırıldı
                                                @break

                                                @case('failed')
                                                    Başarısız
                                                @break

                                                @default
                                                    -
                                            @endswitch
                                        </td>
                                        <td>{{ $item->called_by_name ?? '-' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d H:i') }}</td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Arama geçmişi bulunamadı.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Lead Sms Geçmişi</h5>
                        </div>
                        <div class="card-body">
                            Test
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Lead Dosya Ekleri</h5>
                        </div>
                        <div class="card-body">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Dosya Adı</th>
                                        <th>Yükleme Tarihi</th>
                                        <th>Yükleyen</th>
                                        <th>İşlemler</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>ornek_dosya.pdf</td>
                                        <td>2024-06-15</td>
                                        <td>Ahmet Yılmaz</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary">İndir</button>
                                            <button class="btn btn-sm btn-danger">Sil</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sms Gönder Modal -->
            <div class="modal fade" id="smsSendModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Sms Gönder</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                @csrf
                                <div class="mb-3" hidden>
                                    <label for="sms_lead_id">Lead Id</label>
                                    <input type="text" id="sms_lead_id" class="form-control" value="{{ $lead->id }}" />
                                </div>
                                <div class="mb-3">
                                    <label for="sms_phone">Telefom Numarası</label>
                                    <input type="text" id="sms_phone" class="form-control"
                                        value="{{ $lead->phone }}" />
                                </div>
                                <div class="mb-3">
                                    <label for="sms_message">Mesajınız</label>
                                    <textarea class="form-control" rows="5" id="sms_message" placeholder="Mesajınızı Giriniz..."></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                                    <button type="button" id="sendSmsButton" class="btn btn-primary">Sms Gönder</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bilgileri Düzenle Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Lead Düzenle</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                @csrf
                                <div class="mb-3" hidden>
                                    <label for="update_lead_id">Lead Id</label>
                                    <input type="text" id="update_lead_id" class="form-control"
                                        value="{{ $lead->id }}" />
                                </div>
                                <div class="mb-3">
                                    <label for="update_lead_fullname">İsim Soyisim</label>
                                    <input type="text" id="update_lead_fullname" class="form-control"
                                        value="{{ $lead->fullname }}" />
                                </div>
                                <div class="mb-3">
                                    <label for="update_lead_email">E-Posta Adresi</label>
                                    <input type="text" id="update_lead_email" class="form-control"
                                        value="{{ $lead->email }}" />
                                </div>
                                <div class="mb-3">
                                    <label for="update_lead_phone">Telefon Numarası</label>
                                    <input type="text" id="update_lead_phone" class="form-control"
                                        value="{{ $lead->phone }}" />
                                </div>
                                <div class="mb-3">
                                    <label for="update_lead_birth_date">Doğum Tarihi</label>
                                    <input type="date" id="update_lead_birth_date" class="form-control"
                                        value="{{ $lead->birth_date }}" />
                                </div>
                                <div class="mb-3">
                                    <label for="update_gender_id">Cinsiyet</label>
                                    <select class="form-select mb-3" id="update_gender_id">
                                        <option value="" disabled>Seçiniz</option>
                                        <option value="1" {{ $lead->gender_id == 1 ? 'selected' : '' }}>Erkek</option>
                                        <option value="2" {{ $lead->gender_id == 2 ? 'selected' : '' }}>Kadın</option>
                                        <option value="3" {{ $lead->gender_id == 3 ? 'selected' : '' }}>Belirtilmedi
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="update_country_id">Ülke</label>
                                    <select class="form-select mb-3" id="update_country_id">
                                        <option value="" disabled>Seçiniz</option>
                                        <option value="1" {{ $lead->country_id == 1 ? 'selected' : '' }}>Türkiye</option>
                                        <option value="2" {{ $lead->country_id == 2 ? 'selected' : '' }}>Almanya</option>
                                        <option value="3" {{ $lead->country_id == 3 ? 'selected' : '' }}>Belirtilmedi
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="update_city_id">Şehir</label>
                                    <select class="form-select mb-3" id="update_city_id">
                                        <option value="" disabled>Seçiniz</option>
                                        <option value="1" {{ $lead->city_id == 1 ? 'selected' : '' }}>İstanbul</option>
                                        <option value="2" {{ $lead->city_id == 2 ? 'selected' : '' }}>Münih</option>
                                        <option value="3" {{ $lead->city_id == 3 ? 'selected' : '' }}>Belirtilmedi
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="update_service_id">İlgilendiği Hizmet</label>
                                    <select class="form-select mb-3" id="update_service_id">
                                        <option value="" disabled>Seçiniz</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}"
                                                {{ $lead->service_id == $service->id ? 'selected' : '' }}>
                                                {{ $service->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="update_source_id">Lead Kaynağı</label>
                                    <select class="form-select mb-3" id="update_source_id">
                                        <option value="" disabled>Seçiniz</option>
                                        @foreach ($sources as $source)
                                            <option value="{{ $source->id }}"
                                                {{ $lead->source_id == $source->id ? 'selected' : '' }}>
                                                {{ $source->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                                    <button type="button" id="updateLeadButton" class="btn btn-primary">Bilgileri
                                        Güncelle</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Aktivite Ekle Modal -->
            <div class="modal fade" id="activityModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Lead Aktivite Ekle</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                @csrf
                                <div class="mb-3" hidden>
                                    <label for="activity_lead_id">Lead Id</label>
                                    <input type="text" id="activity_lead_id" class="form-control"
                                        value="{{ $lead->id }}" />
                                </div>
                                <div class="mb-3">
                                    <label for="activity_lead_status">Lead Durumu Seçiniz</label>
                                    <select class="form-select mb-3" id="activity_lead_status_id">
                                        <option selected>Seçiniz...</option>
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="activity_lead_description">Konuşma Detayı</label>
                                    <textarea class="form-control" id="activity_lead_description" rows="5"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                                    <button type="button" id="saveActivityLead" class="btn btn-primary">Aktiviteyi
                                        Kaydet</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Personel Ata Modal -->
            <div class="modal fade" id="userAssignModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Lead Personel Ata</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                @csrf
                                <div class="mb-3" hidden>
                                    <label for="update_user_lead_id">Lead Id</label>
                                    <input type="text" id="update_user_lead_id" class="form-control"
                                        value="{{ $lead->id }}" />
                                </div>
                                <div class="mb-3">
                                    <label for="update_user_id">Personel Seçiniz</label>
                                    <select class="form-select mb-3" id="update_user_id">
                                        <option selected>Seçiniz...</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="update_user_description">Açıklama</label>
                                    <textarea class="form-control" id="update_user_description" rows="5"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                                    <button type="button" id="updateLeadUserButton" class="btn btn-primary">Personeli
                                        Ata</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Dosya Eki Ekle Modal -->
            <div class="modal fade" id="fileAttachModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Lead Dosya Eki Ekleme</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                @csrf
                                <div class="mb-3" hidden>
                                    <label for="insert_file_lead_id">Lead Id</label>
                                    <input type="text" id="insert_file_lead_id" class="form-control"
                                        value="{{ $lead->id }}" />
                                </div>
                                <div class="mb-3">
                                    <label for="insert_file_lead_id">Eklenecek Dosya</label>
                                    <input type="file" id="insert_file_lead" class="form-control" />
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                                    <button type="button" id="saveFileButton" class="btn btn-primary">Dosya Ekle</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                // Sms Gönderme İşlemi
                $('#sendSmsButton').click(function(e) {
                    e.preventDefault();

                    let phone = $('#sms_phone').val();
                    let lead_id = $('#sms_lead_id').val();
                    let message = $('#sms_message').val();

                    $.ajax({
                        type: "POST",
                        url: "{{ route('sms.store') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            phone: phone,
                            lead_id: lead_id,
                            message: message
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Başarılı!',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            });

                            $('#smsSendModal').modal('hide');
                        },

                        error: function(error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Hata!',
                                text: error.responseJSON?.message ??
                                    'SMS gönderilirken bir sorun oluştu.',
                            });

                            console.log(error);
                        }

                    })
                })
                // Lead Güncelleme İşlemi
                $('#updateLeadButton').click(function(e) {
                    e.preventDefault();

                    let lead_id = $('#update_lead_id').val();
                    let fullname = $('#update_lead_fullname').val();
                    let email = $('#update_lead_email').val();
                    let phone = $('#update_lead_phone').val();
                    let birth_date = $('#update_lead_birth_date').val();
                    let gender_id = $('#update_gender_id').val();
                    let country_id = $('#update_country_id').val();
                    let city_id = $('#update_city_id').val();
                    let service_id = $('#update_service_id').val();
                    let source_id = $('#update_source_id').val();

                    $.ajax({
                        type: "POST",
                        url: "{{ route('leads.update') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            lead_id: lead_id,
                            fullname: fullname,
                            email: email,
                            phone: phone,
                            birth_date: birth_date,
                            gender_id: gender_id,
                            country_id: country_id,
                            city_id: city_id,
                            service_id: service_id,
                            source_id: source_id
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Başarılı!',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            });
                            $('#staticBackdrop').modal('hide');
                        },
                        error: function(error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Hata!',
                                text: error.responseJSON?.message ??
                                    'Lead güncellenirken bir sorun oluştu.',
                            });

                            console.log(error);
                        }
                    })
                })
                // Lead Aktivite Ekleme İşlemi
                $('#saveActivityLead').click(function(e) {
                    e.preventDefault();

                    let lead_id = $('#activity_lead_id').val();
                    let status_id = $('#activity_lead_status_id').val();
                    let description = $('#activity_lead_description').val();

                    $.ajax({
                        type: "POST",
                        url: "{{ route('lead.activity.store') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            lead_id: lead_id,
                            status_id: status_id,
                            description: description
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Başarılı!',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            });
                            $('#activityModal').modal('hide');
                        },
                        error: function(error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Hata!',
                                text: error.responseJSON?.message ??
                                    'Lead aktivite eklenirken bir sorun oluştu.',
                            });

                            console.log(error);
                        }
                    })
                })
                // Lead Atanan Personeli Güncelle
                $('#updateLeadUserButton').click(function(e) {
                    e.preventDefault();

                    let lead_id = $('#update_user_lead_id').val();
                    let user_id = $('#update_user_id').val();
                    let description = $('#update_user_description').val();

                    $.ajax({
                        type: "POST",
                        url: "{{ route('lead.assign.user') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            lead_id: lead_id,
                            user_id: user_id,
                            description: description
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Başarılı!',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            });
                            $('#userAssignModal').modal('hide');
                        },
                        error: function(error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Hata!',
                                text: error.responseJSON?.message ??
                                    'Lead personel atama işlemi sırasında bir sorun oluştu.',
                            });

                            console.log(error);
                        }
                    })


                })
                // Dosya Eki Ekle
                $('#saveFileButton').click(function(e) {
                    e.preventDefault();

                    let lead_id = $('#insert_file_lead_id').val();
                    let file_data = $('#insert_file_lead').prop('files')[0];
                    let formData = new FormData();
                    formData.append('_token', "{{ csrf_token() }}");
                    formData.append('lead_id', lead_id);
                    formData.append('file', file_data);

                    $.ajax({
                        type: "POST",
                        url: "{{ route('leads.file.upload') }}",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Başarılı!',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            });
                            $('#fileAttachModal').modal('hide');
                        },
                        error: function(error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Hata!',
                                text: error.responseJSON?.message ??
                                    'Dosya eklenirken bir sorun oluştu.',
                            });

                            console.log(error);
                        }
                    })
                })
                // Arama Yap Log Kaydı
                $('#makeCallButton').click(function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Arama yapmak istediğinize emin misiniz?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Evet',
                        cancelButtonText: 'Hayır'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let lead_id = {{ $lead->id }};

                            $.ajax({
                                type: 'POST',
                                url: '{{ route('lead.call.log') }}',
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    lead_id: lead_id,
                                },
                                success: function(response) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Başarılı!',
                                        text: response.message,
                                        timer: 2000,
                                        showConfirmButton: false
                                    });
                                },
                                error: function(error) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Hata!',
                                        text: error.responseJSON?.message ??
                                            'Arama logu kaydedilemedi.',
                                    });
                                    console.log(error);
                                }
                            });
                        }
                    });
                });
                // Lead Silme İşlemi
                $('#deleteLeadButton').click(function(e) {
                    e.preventDefault();

                    let lead_id = $(this).data('lead-id');

                    Swal.fire({
                        title: 'Silmek istediğinize emin misiniz?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Evet',
                        cancelButtonText: 'Hayır'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: 'POST',
                                url: '{{ route('lead.delete') }}',
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    lead_id: lead_id
                                },
                                success: function(response) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Başarılı!',
                                        text: response.message,
                                        timer: 2000,
                                        showConfirmButton: false
                                    }).then(() => {
                                        window.location.href = '/leads/index';
                                    });
                                },

                                error: function(error) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Hata!',
                                        text: error.responseJSON?.message ??
                                            'Lead silinemedi.'
                                    });
                                    console.log(error);
                                }
                            });
                        }
                    });
                });
            })
        </script>
    @endsection
