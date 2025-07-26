@extends("layout._layout_admin")

@section("content")

<div class="alert alert-primary d-flex align-items-center mt-1" role="alert" id="welcome-name">
    <i class="bi bi-person-circle me-2 fs-4"></i>
    <div>Selamat datang</div>
</div>

<div class="row g-3 my-3">
    <div class="col-lg-4 col-md-6">
        <div class="card shadow border-0 bg-white h-100">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <i class="bi bi-people-fill text-info fs-1"></i>
                </div>
                <div>
                    <h6 class="text-uppercase text-muted mb-1">Jumlah Siswa</h6>
                    <h3 class="mb-0 text-info">{{ $total }} siswa</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="card shadow border-0 bg-white h-100">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <i class="bi bi-person-x-fill text-warning fs-1"></i>
                </div>
                <div>
                    <h6 class="text-uppercase text-muted mb-1">Siswa Terblokir</h6>
                    <h3 class="mb-0 text-warning">{{ $siswa_blocked }} siswa</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="card shadow border-0 bg-white h-100">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <i class="bi bi-person-check-fill text-success fs-1"></i>
                </div>
                <div>
                    <h6 class="text-uppercase text-muted mb-1">Siswa Aktif</h6>
                    <h3 class="mb-0 text-success">{{ $siswa_unblocked }} siswa</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Grafik Statistik -->
<div class="card mt-4 shadow-sm">
    <div class="card-header bg-primary text-white">
        <i class="bi bi-bar-chart-line"></i> Statistik Siswa
    </div>
    <div class="card-body">
        <canvas id="siswaChart" height="100"></canvas>
    </div>
</div>

@endsection

@section("script")
<script>
    sidebar_change_state("sidebar-soal-assesmen");

    // Menampilkan nama user
    fetch("/api/global/get_me")
        .then((response) => response.json())
        .then((decoded) => {
            document.getElementById("welcome-name").innerHTML =
                `<i class="bi bi-person-circle me-2 fs-4"></i> Selamat datang ` + decoded["data"];
        });

    // Grafik siswa (Chart.js)
    const ctx = document.getElementById('siswaChart').getContext('2d');
    const siswaChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Total', 'Aktif', 'Terblokir'],
            datasets: [{
                label: 'Jumlah Siswa',
                data: [{{ $total }}, {{ $siswa_unblocked }}, {{ $siswa_blocked }}],
                backgroundColor: [
                    'rgba(13, 110, 253, 0.7)',   // Total - biru
                    'rgba(25, 135, 84, 0.7)',    // Aktif - hijau
                    'rgba(255, 193, 7, 0.7)'     // Terblokir - kuning
                ],
                borderColor: [
                    'rgba(13, 110, 253, 1)',
                    'rgba(25, 135, 84, 1)',
                    'rgba(255, 193, 7, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: { enabled: true }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
</script>
@endsection
