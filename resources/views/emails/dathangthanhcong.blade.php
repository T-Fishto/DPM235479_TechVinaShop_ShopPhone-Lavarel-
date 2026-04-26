<x-mail::message>
# Xác Nhận Đơn Hàng Thành Công! 🎉

Xin chào **{{ Auth::user()->name }}**,

Cảm ơn bạn đã tin tưởng và mua sắm tại **{{ config('app.name') }}**. 
Đơn hàng của bạn đã được hệ thống ghi nhận và đang trong quá trình chuẩn bị.

## 📍 Thông tin giao hàng:
- **Người nhận:** {{ Auth::user()->name }}
- **Điện thoại:** {{ $donhang->dienthoaigiaohang }}
- **Nơi nhận:** {{ $donhang->diachigiaohang }}

## 🛍️ Chi tiết đơn hàng:
<x-mail::table>
| STT | Tên sản phẩm | SL | Đơn giá | Thành tiền |
|:---|:---|:---:|---:|---:|
@php $tongtien = 0; @endphp
@foreach($donhang->DonHang_ChiTiet as $chitiet)
| {{ $loop->iteration }} | {{ $chitiet->SanPham->tensanpham }} | {{ $chitiet->soluongban }} | {{ number_format($chitiet->dongiaban) }}đ | {{ number_format($chitiet->soluongban * $chitiet->dongiaban) }}đ |
@php $tongtien += $chitiet->soluongban * $chitiet->dongiaban; @endphp
@endforeach
| | | | **Tổng cộng:** | **<span style="color: #e53e3e;">{{ number_format($tongtien) }}đ</span>** |
</x-mail::table>

Chúng tôi sẽ liên hệ với bạn qua số điện thoại trên trong thời gian sớm nhất để xác nhận việc giao hàng.

<x-mail::button :url="url('/')" color="success">
Tiếp tục mua sắm
</x-mail::button>

Trân trọng,<br>
Đội ngũ CSKH {{ config('app.name') }}
</x-mail::message>