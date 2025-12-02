@extends('partials.master')
@section('main')
    <div class="container-fluid">
        <h3 class="mb-4">Genel Rapor ({{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }} -
            {{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }})</h3>
        {{-- KPI Kartları --}}
        <div class="row mb-5">
            @php
                $kpi = [
                    ['title' => 'Toplam Hasta', 'value' => $totalPatients, 'icon' => 'fa-user'],
                    ['title' => 'Toplam Lead', 'value' => $totalLeads, 'icon' => 'fa-users'],
                    ['title' => 'Bekleyen Ödeme', 'value' => $pendingPaymentsCount, 'icon' => 'fa-hourglass-half'],
                    ['title' => 'Yapılan Ödeme', 'value' => $completedPaymentsCount, 'icon' => 'fa-check'],
                    [
                        'title' => 'Beklenen Ödeme',
                        'value' => number_format($expectedPaymentAmount, 2) . ' ₺',
                        'icon' => 'fa-money-bill',
                    ],
                    ['title' => 'Toplam Ciro', 'value' => number_format($totalRevenue, 2) . ' ₺', 'icon' => 'fa-coins'],
                ];
            @endphp
            @foreach ($kpi as $item)
                <div class="col-md-2 mb-3">
                    <div class="card shadow-sm text-center border-light h-100">
                        <div class="card-body">
                            <i class="fa {{ $item['icon'] }} fa-2x mb-2 text-primary"></i>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $item['title'] }}</h6>
                            <h4 class="card-title">{{ $item['value'] }}</h4>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0">Hasta Analizleri</h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-3 mb-3">
                        <div class="border p-2 rounded">
                            <strong>En çok hasta cinsiyeti</strong>
                            <p class="mb-0">
                                @if ($mostPatientGender == 1)
                                    Erkek
                                @elseif($mostPatientGender == 2)
                                    Kadın
                                @else
                                    -
                                @endif
                            </p>
                        </div>

                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="border p-2 rounded">
                            <strong>En çok hasta hizmeti</strong>
                            <p class="mb-0">{{ $mostPatientService ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="border p-2 rounded">
                            <strong>En çok hasta kaynağı</strong>
                            <p class="mb-0">{{ $mostPatientSource ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="border p-2 rounded">
                            <strong>En çok veriye sahip personel</strong>
                            <p class="mb-0">{{ $topDataOwner ?? '-' }}</p>
                        </div>
                    </div>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>Durum</th>
                                <th>Adet</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patientStatuses as $status => $count)
                                <tr>
                                    <td>{{ $status }}</td>
                                    <td>{{ $count }} Adet</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0">Lead Analizleri</h5>
            </div>
            <div class="card-body">

                <div class="row text-center mb-3">
                    <div class="col-md-3 mb-2">
                        <strong>Cinsiyet dağılımı</strong>
                        <ul class="list-unstyled mt-1">
                            @foreach ($leadGenderDistribution as $gender => $count)
                                <li>
                                    @if ($gender == 1)
                                        Erkek
                                    @elseif($gender == 2)
                                        Kadın
                                    @else
                                        Bilinmiyor
                                    @endif
                                    : {{ $count }} Adet
                                </li>
                            @endforeach
                        </ul>

                    </div>
                    <div class="col-md-3 mb-2">
                        <strong>Hizmet dağılımı</strong>
                        <ul class="list-unstyled mt-1">
                            @foreach ($leadServiceDistribution as $service => $count)
                                <li>{{ $service }}: {{ $count }} Adet</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-3 mb-2">
                        <strong>Kaynak dağılımı</strong>
                        <ul class="list-unstyled mt-1">
                            @foreach ($leadSourceDistribution as $source => $count)
                                <li>{{ $source }}: {{ $count }} Adet</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-3 mb-2">
                        <strong>Durum dağılımı</strong>
                        <ul class="list-unstyled mt-1">
                            @foreach ($leadStatusDistribution as $status => $count)
                                <li>{{ $status }}: {{ $count }} Adet</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0">Personel Başarı Analizi</h5>
            </div>
            <div class="card-body text-center">
                <p>En çok lead'i hastaya dönüştüren personel:</p>
                <h4>{{ $leadToPatient ?? '-' }}</h4>
            </div>
        </div>

    </div>
@endsection
