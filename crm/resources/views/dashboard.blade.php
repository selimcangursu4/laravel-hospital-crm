@extends('partials.master')
@section('main')
<div class="container-fluid p-0">
    <h3 class="mb-4 fw-bold">Kontrol Paneli</h3>
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm p-3">
                <h6 class="text-muted">Bugün Gelen Lead</h6>
                <h2 class="fw-bold text-primary">{{ $todayLeads }}</h2>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card shadow-sm p-3">
                <h6 class="text-muted">Dönüşen Lead</h6>
                <h2 class="fw-bold text-success">{{ $convertedLeads }}</h2>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card shadow-sm p-3">
                <h6 class="text-muted">Bugünkü Aramalar</h6>
                <h2 class="fw-bold text-warning">{{ $dailyCalls }}</h2>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card shadow-sm p-3">
                <h6 class="text-muted">Bekleyen Ödeme</h6>
                <h2 class="fw-bold text-danger">{{ $pendingPayments }}</h2>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold mb-3">Lead Kaynak Dağılımı</h5>
                <canvas id="leadSourceChart" height="150"></canvas>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold mb-3">Aylık Lead Artışı</h5>
                <canvas id="monthlyLeadsChart" height="150"></canvas>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold mb-3">Arama Durumları</h5>
                <canvas id="callStatusChart" height="150"></canvas>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold mb-3">Ödeme Durumları</h5>
                <canvas id="paymentStatusChart" height="150"></canvas>
            </div>
        </div>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const leadSources = @json($leadSources);
    const monthlyLeads = @json($monthlyLeads);
    const callStatuses = @json($callStatuses);
    const paymentStatuses = @json($paymentStatus);
    new Chart(document.getElementById('leadSourceChart'), {
        type: 'pie',
        data: {
            labels: leadSources.map(item => "Kaynak " + item.source_id),
            datasets: [{
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b'],
                data: leadSources.map(item => item.total)
            }]
        }
    });
    new Chart(document.getElementById('monthlyLeadsChart'), {
        type: 'line',
        data: {
            labels: monthlyLeads.map(item => item.month + ". Ay"),
            datasets: [{
                label: 'Yeni Lead',
                borderColor: '#4e73df',
                backgroundColor: 'rgba(78,115,223,0.1)',
                data: monthlyLeads.map(item => item.total),
                tension: 0.4
            }]
        }
    });
    new Chart(document.getElementById('callStatusChart'), {
        type: 'doughnut',
        data: {
            labels: callStatuses.map(item => item.call_status),
            datasets: [{
                backgroundColor: ['#1cc88a', '#e74a3b', '#858796'],
                data: callStatuses.map(item => item.total)
            }]
        }
    });
    new Chart(document.getElementById('paymentStatusChart'), {
        type: 'bar',
        data: {
            labels: paymentStatuses.map(item => item.payment_status),
            datasets: [{
                backgroundColor: ['#f6c23e', '#1cc88a', '#36b9cc', '#e74a3b'],
                data: paymentStatuses.map(item => item.total)
            }]
        }
    });

</script>

@endsection
