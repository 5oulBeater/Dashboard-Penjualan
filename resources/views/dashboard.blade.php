<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penjualan</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        .filter-box {
            margin: 15px 0;
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .total-box {
            margin: 10px 0;
            font-size: 20px;
            font-weight: bold;
        }
        canvas {
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <h1>Dashboard Penjualan</h1>

    <!-- Total Penjualan -->
    <div class="total-box">
        Total Penjualan: Rp {{ number_format($total, 0, ',', '.') }}
    </div>

    <!-- Filter Form -->
    <form action="{{ url('/') }}" method="GET" class="filter-box">
        <label>
            Dari:
            <input type="date" name="start_date" value="{{ request('start_date') }}">
        </label>

        <label>
            Sampai:
            <input type="date" name="end_date" value="{{ request('end_date') }}">
        </label>

        <button type="submit">Filter</button>
        <a href="{{ url('/') }}" style="margin-left: 10px;">Reset</a>
    </form>

    <!-- Tabel Penjualan -->
    <table>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $s)
                <tr>
                    <td>{{ $s->nama_produk }}</td>
                    <td>{{ $s->tanggal_penjualan }}</td>
                    <td>{{ $s->jumlah }}</td>
                    <td>Rp {{ number_format($s->harga, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($s->jumlah * $s->harga, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Grafik Penjualan -->
    <h3>Grafik Penjualan (Jumlah per Tanggal)</h3>
    <canvas id="chart" width="600" height="300"></canvas>

    <script>
    /* @ts-nocheck */  // Hilangkan error merah di VSCode untuk Blade + JS

    // Data dari Laravel
    const labels = @json($sales->pluck('tanggal_penjualan')->toArray());
    const dataJumlah = @json($sales->pluck('jumlah')->toArray());

    const ctx = document.getElementById('chart').getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Terjual',
                data: dataJumlah,
                fill: false,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Tanggal'
                    }
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Jumlah'
                    },
                    beginAtZero: true
                }
            }
        }
    });
    </script>

</body>
</html>
