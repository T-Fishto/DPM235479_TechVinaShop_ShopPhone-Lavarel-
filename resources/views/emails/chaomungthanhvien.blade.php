<x-mail::message>
# Chào mừng thành viên mới! 🎊

Xin chào **{{ $user->name }}**,

Cảm ơn bạn đã tin tưởng và đăng ký tài khoản tại **{{ config('app.name') }}**. 

Chúng tôi rất vui mừng được đồng hành cùng bạn. Ngay bây giờ, bạn đã có thể đăng nhập và khám phá hàng ngàn mẫu điện thoại công nghệ mới nhất với giá cực kỳ ưu đãi!

<x-mail::button :url="url('/')" color="primary">
Bắt đầu mua sắm ngay
</x-mail::button>

Trân trọng,<br>
Đội ngũ CSKH {{ config('app.name') }}
</x-mail::message>