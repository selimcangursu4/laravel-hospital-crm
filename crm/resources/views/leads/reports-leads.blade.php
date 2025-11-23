@extends('partials.master')
@section('main')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Lead Özet Mini Rapor</h4>
            </div>
            <div class="card-body">
                <div class="row g-3 mb-3">
                    <div class="col-md-3">
                        <div class="card border-primary shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <i data-feather="users" class="me-2 text-primary" width="24" height="24"></i>
                                <div>
                                    <h6 class="mb-0">Bugün Oluşturulan Toplam Lead</h6>
                                    <h3 class="mb-0">{{ $totalLeadsToday }} Adet</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-success shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <i data-feather="check-circle" class="me-2 text-success" width="24" height="24"></i>
                                <div>
                                    <h6 class="mb-0">Bugün Tamamlanan Lead</h6>
                                    <h3 class="mb-0">{{ $completedLeadsToday }} Adet</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-info shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <i data-feather="phone" class="me-2 text-info" width="24" height="24"></i>
                                <div>
                                    <h6 class="mb-0">Günlük Yapılan Arama</h6>
                                    <h3 class="mb-0">{{ $dailyCalls }} Adet</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-secondary shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <i data-feather="message-square" class="me-2 text-secondary" width="24"
                                    height="24"></i>
                                <div>
                                    <h6 class="mb-0">Günlük Gönderilen SMS</h6>
                                    <h3 class="mb-0">{{ $dailySms }} Adet</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-md-3">
                        <div class="card border-secondary shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <i data-feather="file" class="me-2 text-secondary" width="24" height="24"></i>
                                <div>
                                    <h6 class="mb-0">Bugün Eklenen Dosya Ek Sayısı</h6>
                                    <h3 class="mb-0">{{ $dailyFiles }} Adet</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-danger shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <i data-feather="x-circle" class="me-2 text-danger" width="24" height="24"></i>
                                <div>
                                    <h6 class="mb-0">Bugün Durumu Başarısız Seçilen Lead</h6>
                                    <h3 class="mb-0">{{ $failedLeads }} Adet</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-primary shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <i data-feather="activity" class="me-2 text-primary" width="24" height="24"></i>
                                <div>
                                    <h6 class="mb-0">Toplam Aktif Lead</h6>
                                    <h3 class="mb-0">{{ $activeLeads }} Adet</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-danger shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <i data-feather="slash" class="me-2 text-danger" width="24" height="24"></i>
                                <div>
                                    <h6 class="mb-0">Günlük Ulaşılamayan Lead</h6>
                                    <h3 class="mb-0">{{ $dailyUnreachable }} Adet</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Lead Ai Rapor</h4>
                <p>Bu bölüm, yapay zekâ destekli analizler ile dünkü performans verilerini karşılaştırarak lead akışındaki
                    ilerlemeleri, gerilemeleri ve önemli trendleri görselleştirmektedir.
                    Satış ve pazarlama stratejilerinizi optimize etmek için günlük bazda kapsamlı bir özet sunar.</p>
            </div>
            <div class="card-body">
                <table>

                </table>
            </div>
        </div>
    </div>
    <script>
        feather.replace()
    </script>
@endsection
