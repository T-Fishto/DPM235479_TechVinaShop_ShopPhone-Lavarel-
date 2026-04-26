<x-mail::message>
# Cảnh Báo Bảo Mật 🛡️

Xin chào **{{ $user->name }}**,

Hệ thống ghi nhận tài khoản của bạn vừa được đăng nhập thành công vào lúc: **{{ $thoigian }}**.

Nếu đây chính là bạn, xin hãy bỏ qua email này. 

Tuy nhiên, nếu bạn **không hề đăng nhập** nhưng lại nhận được thông báo này, tài khoản của bạn có thể đang gặp rủi ro. Vui lòng bấm vào nút bên dưới để tiến hành khôi phục mật khẩu ngay lập tức!

<x-mail::button :url="route('password.request')" color="error">
Đổi Mật Khẩu Khẩn Cấp
</x-mail::button>

Trân trọng,<br>
Đội ngũ Bảo mật {{ config('app.name') }}
</x-mail::message>