<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = 'vouchers';

    protected $fillable = [
        'ma_giam_gia', 'ten_voucher', 'loai_giam', 'gia_tri_giam',
        'giam_toi_da', 'don_hang_toi_thieu', 'so_lan_su_dung_toi_da',
        'so_lan_da_su_dung', 'ngay_bat_dau', 'ngay_het_han', 'kichhoat',
    ];

    /**
     * Tính số tiền thực tế được giảm dựa trên tổng đơn hàng
     */
    public function tinhSoTienGiam(int $tongTien): int
    {
        if ($this->loai_giam === 'percent') {
            $giam = intval($tongTien * $this->gia_tri_giam / 100);
            // Nếu có giới hạn tối đa thì áp dụng
            if ($this->giam_toi_da > 0 && $giam > $this->giam_toi_da) {
                $giam = $this->giam_toi_da;
            }
            return $giam;
        }
        // Giảm cố định: không được giảm quá tổng tiền
        return min($this->gia_tri_giam, $tongTien);
    }

    /**
     * Kiểm tra voucher còn hiệu lực không
     */
    public function isHopLe(int $tongTien): array
    {
        if (!$this->kichhoat) {
            return ['hop_le' => false, 'thong_bao' => 'Mã giảm giá không còn hoạt động.'];
        }

        $today = now()->toDateString();

        if ($this->ngay_bat_dau && $today < $this->ngay_bat_dau) {
            return ['hop_le' => false, 'thong_bao' => 'Mã giảm giá chưa đến ngày áp dụng.'];
        }

        if ($this->ngay_het_han && $today > $this->ngay_het_han) {
            return ['hop_le' => false, 'thong_bao' => 'Mã giảm giá đã hết hạn.'];
        }

        if ($this->so_lan_su_dung_toi_da !== null && $this->so_lan_da_su_dung >= $this->so_lan_su_dung_toi_da) {
            return ['hop_le' => false, 'thong_bao' => 'Mã giảm giá đã hết lượt sử dụng.'];
        }

        if ($tongTien < $this->don_hang_toi_thieu) {
            return [
                'hop_le' => false,
                'thong_bao' => 'Đơn hàng tối thiểu ' . number_format($this->don_hang_toi_thieu, 0, ',', '.') . 'đ để dùng mã này.',
            ];
        }

        return ['hop_le' => true, 'thong_bao' => 'Áp dụng thành công!'];
    }
}
