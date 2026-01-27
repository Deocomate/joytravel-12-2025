@extends("admin.layouts.main")
@section("title","Tổng quan")
@section("content")
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ number_format($totalRevenue ?? 0) }}<sup style="font-size: 20px">đ</sup></h3>
                    <p>Tổng doanh thu</p>
                </div>
                <div class="icon"><i class="ion ion-cash"></i></div>
                <a href="{{ route('admin.orders.index', ['status' => 'COMPLETED']) }}" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalOrders ?? 0 }}</h3>
                    <p>Tổng số đơn hàng</p>
                </div>
                <div class="icon"><i class="ion ion-bag"></i></div>
                <a href="{{ route('admin.orders.index') }}" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $totalCustomers ?? 0 }}</h3>
                    <p>Khách hàng đăng ký</p>
                </div>
                <div class="icon"><i class="ion ion-person-add"></i></div>
                <a href="{{ route('admin.users.index') }}" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $totalTours ?? 0 }}</h3>
                    <p>Tổng số tour</p>
                </div>
                <div class="icon"><i class="ion ion-paper-airplane"></i></div>
                <a href="{{ route('admin.tours.index') }}" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-chart-pie mr-1"></i>Doanh thu và Đơn hàng</h3>
                    <div class="card-tools">
                        <div class="btn-group" id="sales-chart-filter-buttons">
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-filter="week">Tuần</button>
                            <button type="button" class="btn btn-sm btn-secondary" data-filter="month">Tháng</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-filter="quarter">Quý</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-filter="year">Năm</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="position: relative; height:300px; width:100%"><canvas id="salesChart"></canvas></div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        $(function () {
            let salesChart;
            const salesChartCanvas = $('#salesChart').get(0).getContext('2d');

            function fetchSalesChartData(filter) {
                $('#sales-chart-filter-buttons .btn').removeClass('btn-secondary').addClass('btn-outline-secondary');
                $(`#sales-chart-filter-buttons .btn[data-filter="${filter}"]`).removeClass('btn-outline-secondary').addClass('btn-secondary');
                $.ajax({
                    url: '{{ route('admin.dashboard.chartData') }}', type: 'GET', data: { filter: filter }, dataType: 'json',
                    success: data => updateSalesChart(data),
                    error: error => console.error("Lỗi khi lấy dữ liệu doanh thu:", error)
                });
            }



            function updateSalesChart(data) {
                if (salesChart) salesChart.destroy();
                salesChart = new Chart(salesChartCanvas, {
                    type: 'bar',
                    data: {
                        labels: data.labels,
                        datasets: [
                            { label: 'Doanh thu', backgroundColor: 'rgba(60,141,188,0.9)', data: data.revenue, yAxisID: 'y-revenue' },
                            { label: 'Đơn hàng', backgroundColor: 'rgba(210, 214, 222, 1)', data: data.orders, yAxisID: 'y-orders', type: 'line', fill: false, borderColor: 'rgba(210, 214, 222, 1)' }
                        ]
                    },
                    options: {
                        responsive: true, maintainAspectRatio: false,
                        scales: {
                            x: { grid: { display: false } },
                            'y-revenue': { type: 'linear', position: 'left', title: { display: true, text: 'Doanh thu (đ)' }, ticks: { callback: value => new Intl.NumberFormat('vi-VN').format(value) } },
                            'y-orders': { type: 'linear', position: 'right', title: { display: true, text: 'Số lượng đơn hàng' }, grid: { drawOnChartArea: false }, ticks: { beginAtZero: true, stepSize: 1 } }
                        },
                        plugins: {
                            tooltip: {
                                mode: 'index', intersect: false,
                                callbacks: {
                                    label: function(context) {
                                        let label = context.dataset.label || '';
                                        if (label) label += ': ';
                                        if (context.parsed.y !== null) {
                                            label += context.dataset.yAxisID === 'y-revenue' ? new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(context.parsed.y) : context.parsed.y;
                                        }
                                        return label;
                                    }
                                }
                            }
                        }
                    }
                });
            }



            $('#sales-chart-filter-buttons .btn').on('click', function () { fetchSalesChartData($(this).data('filter')); });


            fetchSalesChartData('month');

        });
    </script>
@endpush
