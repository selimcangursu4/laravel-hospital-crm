@extends('partials.master')
@section('main')
    <div class="container-fluid">
        <div class="mb-4">
            <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#smsSendModal">
                Sms Gönder
            </button>
            <button class="btn btn-info me-2">Arama Yap</button>
            <button class="btn btn-success me-2">WhatsApp'tan Ulaş</button>
            <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Bilgileri Düzenle
            </button>
            <button class="btn btn-danger me-2">Sil</button>
            <button type="button" class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#activityModal">
                Aktivite Ekle
            </button>
            <button type="button" class="btn btn-secondary me-2" data-bs-toggle="modal" data-bs-target="#userAssignModal">
                Personel Ata
            </button>
            <button type="button" class="btn btn-dark me-2" data-bs-toggle="modal" data-bs-target="#fileAttachModal">
                Dosya Eki Ekle
            </button>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Lead Bilgileri</h5>
                    </div>
                    <div class="card-body">
                        Test
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
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Lead Aktivite Geçmişi</h5>
                    </div>
                    <div class="card-body">
                        <table></table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Lead Arama Geçmişi</h5>
                    </div>
                    <div class="card-body">
                        Test
                    </div>
                </div>
            </div>
            <div class="col-md-12">
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
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                        <button type="button" class="btn btn-primary">Sms Gönder</button>
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
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                        <button type="button" class="btn btn-primary">Bilgileri Güncelle</button>
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
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                        <button type="button" class="btn btn-primary">Aktiviteyi Kaydet</button>
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
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                        <button type="button" class="btn btn-primary">Personeli Ata</button>
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
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                        <button type="button" class="btn btn-primary">Dosya Ekle</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
