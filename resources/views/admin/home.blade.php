@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Bảng điều khiển</h1>

    <div class="row">
        <div class="col-sm-6 col-xl-3 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Sản phẩm</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="box"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">{{ $soSanPham }}</h1>
                    <div class="mb-0">
                        <span class="text-muted">Tổng số sản phẩm</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Đơn hàng</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-success">
                                <i class="align-middle" data-feather="shopping-cart"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">{{ $soDonHang }}</h1>
                    <div class="mb-0">
                        <span class="text-muted">Tổng đơn đã đặt</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Tài khoản</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-info">
                                <i class="align-middle" data-feather="users"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">{{ $soNguoiDung }}</h1>
                    <div class="mb-0">
                        <span class="text-muted">Khách hàng & Quản trị</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Bài viết</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-warning">
                                <i class="align-middle" data-feather="file-text"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">{{ $soBaiViet }}</h1>
                    <div class="mb-0">
                        <span class="text-muted">Bài viết trên Blog</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8 col-xxl-9 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="card-title mb-0">Đơn hàng mới nhất</h5>
                </div>
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>Mã ĐH</th>
                            <th class="d-none d-xl-table-cell">Ngày đặt</th>
                            <th>Khách hàng</th>
                            <th>Trạng thái</th>
                            <th class="d-none d-md-table-cell">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donHangMoi as $dh)
                        <tr>
                            <td>#{{ $dh->id }}</td>
                            <td class="d-none d-xl-table-cell">{{ $dh->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $dh->User->name ?? 'Khách lẻ' }}</td>
                            <td>
                                @if($dh->tinhtrang_id == 1)
                                    <span class="badge bg-secondary">{{ $dh->TinhTrang->tentinhtrang ?? 'Đã đặt' }}</span>
                                @elseif($dh->tinhtrang_id == 2)
                                    <span class="badge bg-warning text-dark">{{ $dh->TinhTrang->tentinhtrang ?? 'Đang xử lý' }}</span>
                                @elseif($dh->tinhtrang_id == 4)
                                    <span class="badge bg-danger">{{ $dh->TinhTrang->tentinhtrang ?? 'Đã hủy' }}</span>
                                @else
                                    <span class="badge bg-success">{{ $dh->TinhTrang->tentinhtrang ?? 'Đã giao' }}</span>
                                @endif
                            </td>
                            <td class="d-none d-md-table-cell">
                                <a href="{{ route('admin.donhang.chitiet', $dh->id) }}" class="btn btn-sm btn-info">Xem</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Chưa có đơn hàng nào</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="col-12 col-lg-4 col-xxl-3 d-flex">
            <div class="card flex-fill w-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Thống kê trạng thái đơn hàng</h5>
                </div>
                <div class="card-body d-flex w-100">
                    <div class="align-self-center w-100">
                        <div class="py-3">
                            <div class="chart chart-sm">
                                <canvas id="chartjs-dashboard-pie"></canvas>
                            </div>
                        </div>
                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <td><i class="fas fa-circle text-warning fa-fw"></i> Mới đặt</td>
                                    <td class="text-end">{{ $thongKeDonHang['moi_dat'] }}</td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-circle text-primary fa-fw"></i> Đang xử lý</td>
                                    <td class="text-end">{{ $thongKeDonHang['dang_xu_ly'] }}</td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-circle text-success fa-fw"></i> Đã giao</td>
                                    <td class="text-end">{{ $thongKeDonHang['hoan_thanh'] }}</td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-circle text-danger fa-fw"></i> Đã hủy</td>
                                    <td class="text-end">{{ $thongKeDonHang['da_huy'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Pie chart
        var ctx = document.getElementById("chartjs-dashboard-pie");
        if (ctx) {
            new Chart(ctx, {
                type: "pie",
                data: {
                    labels: ["Mới đặt", "Đang xử lý", "Đã giao", "Đã hủy"],
                    datasets: [{
                        data: [
                            {{ $thongKeDonHang['moi_dat'] }},
                            {{ $thongKeDonHang['dang_xu_ly'] }},
                            {{ $thongKeDonHang['hoan_thanh'] }},
                            {{ $thongKeDonHang['da_huy'] }}
                        ],
                        backgroundColor: [
                            "#ffc107", // warning
                            "#0d6efd", // primary
                            "#198754", // success
                            "#dc3545"  // danger
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }
    });
</script>
@endpush
@endsection