<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Thông báo liên hệ mới</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; color: #333; }
        .container { width: 80%; margin: 20px auto; padding: 20px; border: 1px solid #ddd; }
        .header { background: #f4f4f4; padding: 10px; text-align: center; }
        .content { margin-top: 20px; }
        .footer { margin-top: 30px; font-size: 0.8em; color: #777; border-top: 1px solid #eee; padding-top: 10px; }
        .label { font-weight: bold; width: 150px; display: inline-block; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Bạn có lời nhắn mới từ khách hàng</h2>
        </div>
        <div class="content">
            <p><span class="label">Họ và tên:</span> {{ $data['ho_ten'] }}</p>
            <p><span class="label">Số điện thoại:</span> {{ $data['dien_thoai'] }}</p>
            <p><span class="label">Email:</span> {{ $data['email'] }}</p>
            <p><span class="label">Nội dung:</span></p>
            <div style="background: #f9f9f9; padding: 15px; border-left: 4px solid #gold;">
                {{ $data['noi_dung'] }}
            </div>
        </div>
        <div class="footer">
            <p>Email này được gửi tự động từ hệ thống TechVinaShop.</p>
        </div>
    </div>
</body>
</html>
