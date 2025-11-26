@extends('partials.master')
@section('main')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Hasta Özet Mini Rapor</h4>
            </div>
            <div class="card-body">
                <div class="row g-3 mb-3">
                    <div class="col-md-3">
                        <div class="card border-primary shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <i data-feather="user-plus" class="me-2 text-primary" width="24" height="24"></i>
                                <div>
                                    <h6 class="mb-0">Bugün Eklenen Yeni Hasta</h6>
                                   <h3 class="mb-0">{{ $newPatientsToday }} Adet</h3>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card border-success shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <i data-feather="refresh-ccw" class="me-2 text-success" width="24" height="24"></i>
                                <div>
                                    <h6 class="mb-0">Bugün Güncellenen Hasta</h6>
                                  <h3 class="mb-0">{{ $updatedPatientsToday }} Adet</h3>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card border-info shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <i data-feather="phone" class="me-2 text-info" width="24" height="24"></i>
                                <div>
                                    <h6 class="mb-0">Günlük Yapılan Hasta Araması</h6>
                                 <h3 class="mb-0">{{ $dailyCalls }} Adet</h3>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card border-secondary shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <i data-feather="message-square" class="me-2 text-secondary" width="24" height="24"></i>
                                <div>
                                    <h6 class="mb-0">Günlük Gönderilen Hasta SMS'i</h6>
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
                                <i data-feather="file-text" class="me-2 text-secondary" width="24" height="24"></i>
                                <div>
                                    <h6 class="mb-0">Bugün Oluşturulan Süreç Logu</h6>
                                  <h3 class="mb-0">{{ $dailyProcessLogs }} Adet</h3>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card border-danger shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <i data-feather="x-circle" class="me-2 text-danger" width="24" height="24"></i>
                                <div>
                                    <h6 class="mb-0">Bugün Başarısız Süreç</h6>
                                    <h3 class="mb-0">{{ $failedProcesses }} Adet</h3>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card border-primary shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <i data-feather="activity" class="me-2 text-primary" width="24" height="24"></i>
                                <div>
                                    <h6 class="mb-0">Toplam Aktif Hasta</h6>
                                  <h3 class="mb-0">{{ $activePatients }} Adet</h3>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card border-danger shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <i data-feather="slash" class="me-2 text-danger" width="24" height="24"></i>
                                <div>
                                    <h6 class="mb-0">Günlük Cevapsız Arama</h6>
                                <h3 class="mb-0">{{ $dailyMissedCalls }} Adet</h3>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Hasta Ai Rapor</h4>
                <p>
                    Bu bölüm, yapay zekâ ile dünkü hasta aktiviteleri karşılaştırılarak trendler,
                    süreç yoğunluğu ve iletişim kalitesi analiz edilmektedir.
                </p>
            </div>
            <div class="card-body">

            </div>
        </div>
    </div>

    <script>
        feather.replace()
    </script>
@endsection
