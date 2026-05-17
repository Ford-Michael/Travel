<?php
/**
 * Tour Model
 * Handles tour queries for the user-facing site.
 */

require_once __DIR__ . '/Model.php';
require_once __DIR__ . '/PromotionModel.php';

class TourModel extends Model {
    protected $table = 'Tour';
    protected $primaryKey = 'tourID';

    private $continentKeywords = [
        'asia' => [
            'chau a', 'asia', 'asian', 'japan', 'nhat ban', 'korea', 'han quoc', 'thai lan',
            'thailand', 'singapore', 'china', 'trung quoc', 'hong kong', 'taiwan', 'malaysia',
            'indonesia', 'bali', 'campuchia', 'cambodia', 'lao', 'myanmar', 'india', 'dubai'
        ],
        'europe' => [
            'chau au', 'europe', 'france', 'phap', 'italy', 'switzerland', 'thuy si',
            'germany', 'duc', 'netherlands', 'ha lan', 'spain', 'tay ban nha', 'uk', 'england',
            'belgium', 'austria', 'czech', 'greece', 'hy lap'
        ],
        'america' => [
            'chau my', 'america', 'americas', 'usa', 'new york', 'canada', 'mexico',
            'brazil', 'argentina', 'peru', 'chile', 'cuba', 'colombia', 'las vegas', 'san francisco'
        ],
        'oceania' => [
            'chau uc', 'oceania', 'australia', 'new zealand', 'sydney', 'melbourne'
        ],
        'africa' => [
            'chau phi', 'africa', 'south africa', 'nam phi', 'morocco', 'egypt', 'ai cap',
            'kenya', 'tanzania', 'madagascar'
        ],
    ];

    private $domesticKeywords = [
        'north' => [
            'mien bac', 'ha noi', 'ninh binh', 'ha long', 'quang ninh', 'sapa', 'lao cai',
            'ha giang', 'cao bang', 'moc chau', 'cat ba', 'yen bai', 'bac kan', 'lang son',
            'tam dao', 'mai chau', 'son la'
        ],
        'central' => [
            'mien trung', 'da nang', 'hoi an', 'hue', 'quang binh', 'phong nha', 'quang tri',
            'quy nhon', 'binh dinh', 'nha trang', 'khanh hoa', 'phu yen', 'da lat', 'lam dong',
            'phan thiet', 'mui ne', 'tay nguyen', 'kon tum', 'gia lai', 'dak lak', 'buon ma thuot'
        ],
        'south' => [
            'mien nam', 'ho chi minh', 'sai gon', 'tay ninh', 'vung tau', 'ba ria',
            'dong nai', 'binh duong', 'binh phuoc', 'cu chi', 'thu duc', 'phu my'
        ],
        'mekong' => [
            'mien tay', 'mekong', 'mekong delta', 'dong bang song cuu long', 'song cuu long',
            'can tho', 'dong thap', 'an giang', 'ca mau', 'bac lieu', 'soc trang', 'ben tre',
            'tien giang', 'chau doc', 'vinh long', 'long an', 'my tho', 'tra vinh',
            'hau giang', 'kien giang'
        ],
        'islands' => [
            'hai dao', 'dao', 'phu quoc', 'con dao', 'ly son', 'phu quy', 'co to', 'nam du',
            'binh ba', 'cat ba island', 'cu lao cham'
        ],
    ];

    private $continentMeta = [
        'asia' => [
            'slug' => 'asia',
            'name' => 'Chau A',
            'title' => 'Asian Wonders',
            'eyebrow' => 'Trai nghiem doc ban',
            'subtitle' => 'Hanh trinh cham toi linh hon phuong Dong, tu pho thi hien dai den nhung diem den van hoa bieu tuong.',
            'heroImage' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuB4NyKnF043DaVf3mBzAAs78g2lgFq1aMWrI0zkUh51KaWM3Rh8xi8fWK3rYMVeBHnEp_IgIt4j7_dInd8B8U-tBd-u2NKXY40W7X7Y5y5R0GxhuZxwQWNCGm3-J_lao-usKs1fFVupikYb56PN9cY8t7ldgk-803qwIG2qAQF08oGYXVQsXeJmwR5yJ7k96OnwuLL4DugDTpr30bK_V6hyGPirynw4vKHD1JNHJWPX_g5k2NQLrx0EmjAsdsvuJb5RVc4ES-tF3g68',
            'ctaTitle' => 'Bat dau hanh trinh Chau A cua rieng ban',
            'highlights' => [
                ['name' => 'Nhat Ban', 'note' => 'Giao thoa truyen thong va tuong lai', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuA2b3YpwBQQBTcdv4mEL4WC7Bfs5oI7ui9rTojgc6IMrEbiSxRldG8TXM5Dit_95UCbQZ8OyHXK8r7AdriD477gaSqYii5ei0wh1sXFxr2aZ0k1vsVLZFCsDBv-FCBF4JR32ZI5btcax0_VxCwUC_AZm-WNsLk8D45ZzR5FoGbVTVZrvP3s5KuYH2N0HAEnLJgZn4NIKbelR1gw3vqUjK9uM2htw-VNyQuQHmbm9tyfi-uqThhkXvgp1nLBerknTdMTuBzNb4CO9-Fk'],
                ['name' => 'Han Quoc', 'note' => 'Van hoa song dong va tham my hien dai', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAMMjnb0Wj-0z8kHZIWJWI8Jpudu0zRs8ws3wT7vqVCYS5hvLX53vGrR_xgHj5EFtIsdNt7XhZbdyvuRHb8nki6tYi2m1eyWs8_WW3LQuEhs9hedZekyRTpSIAV02Vf0vzohkxvbWByLqEny_O2drpam98fy2HaDvMvccvdymcG64gBE3NpYPuT5vXRO4ZxgTsMGHhGjzXvXOWgXjjXasAPWsF8twOZEopU6_BPT5IvT_fD5sYqqmd1M8AsWSdUBHol4lFt5JCSwsqa'],
                ['name' => 'Thai Lan', 'note' => 'Bangkok rong rang va bien xanh nhiet doi', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDd8YXAP-U1BnezlBLPrWVhK2MygNoOMCFHBBHg8FSW-uzv1y8Z9FEIFql0-qNrq2C7Tlv3Cqbf59w832fNRAlUUhgsvMtZ2DVHk2yiv0pLO5ZRFCilmHgT5gy-i7t0eYZPQscX_hQ3EAG-mvaLbgJEfr-qoaILNCBJZEBxQgn4tLdHWU1utjLOZNdSAEHVHfT9gqZ8VSM90VgsPJp7ZQ_lX-RqaTZIbxNaH6DXrDwzFj7ZhYyvgzZ9PrQgtKnL5Rne407EgZ4iwq0K'],
                ['name' => 'Singapore', 'note' => 'Thanh pho tuong lai trong long di san xanh', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDsiaEzt7QWj1Bbw68nQmvp2uSIG1MrWw07a6XPT_z9vwYI_2L6ruRPp1jZLKLrIA_Yqo5oKnH_VSyKTuMoXjBiBUHW0JGoOiNGnkYg_Fk5dp6HBw8SMrbpjCxTkrHrUbEPUVPiKfMOrSRtmb3Gcj9nW00IpjjgnsEMtMYbs0a8eHSIf3DKVD2FXTHn3Y4qQf8CKyuWgopnAR4j3wAcZ81MzACBk5T8pCB-SCrLWhFwW9mf_xCMfXm023cOxQOGItxCAIg9mTYWaMTa'],
            ],
        ],
        'europe' => [
            'slug' => 'europe',
            'name' => 'Chau Au',
            'title' => 'European Elegance',
            'eyebrow' => 'Tinh hoa co dien',
            'subtitle' => 'Mot hanh trinh di qua trai tim Chau Au co kinh voi kien truc, nghe thuat va phong cach song sang trong.',
            'heroImage' => 'https://images.unsplash.com/photo-1491557345352-5929e343eb89?auto=format&fit=crop&w=1600&q=80',
            'ctaTitle' => 'Nhan cam hung cho chuyen di Chau Au tiep theo',
            'highlights' => [
                ['name' => 'Phap', 'note' => 'Paris va nhung diem den lang man', 'image' => 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?auto=format&fit=crop&w=1200&q=80'],
                ['name' => 'Italy', 'note' => 'Nghe thuat, lich su va vi ngon Dia Trung Hai', 'image' => 'https://images.unsplash.com/photo-1525874684015-58379d421a52?auto=format&fit=crop&w=1200&q=80'],
                ['name' => 'Thuy Si', 'note' => 'Ho nuoc xanh va day Alps hung vi', 'image' => 'https://images.unsplash.com/photo-1501594907352-04cda38ebc29?auto=format&fit=crop&w=1200&q=80'],
                ['name' => 'Tay Ban Nha', 'note' => 'Sac mau kien truc va am nhac', 'image' => 'https://images.unsplash.com/photo-1543783207-ec64e4d95325?auto=format&fit=crop&w=1200&q=80'],
            ],
        ],
        'america' => [
            'slug' => 'america',
            'name' => 'Chau My',
            'title' => 'The New World Discovery',
            'eyebrow' => 'Hanh trinh kham pha Chau My',
            'subtitle' => 'Tu Manhattan soi dong den Rockies tuyet phu, day la bo suu tap trai nghiem danh cho tam hon khao khat tu do.',
            'heroImage' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAd4mIlQpoGHQfgSu1Aq7287uYpCGOAgO-0tXG8fzkJF0MDH1jiuNEpqnqBqsOhrYok3rWq857vLRxOEfOdf3txFlaPpqQ_iHnkn8bjNEXYbg5_WIXnzQfwGdc5M5kP862MMbPLWCWwMH203swLTKBu4pBoxcP_fUNgg-gFLpYyt8VDaKhxICjIn3NZeKrQCCPaqUnOFoz39UCHrPro_3hcBVfnR_H6jmCqOa94oMh2_GWi7XQN9J07ERoqzJHm6RQpj3o90cNbCvF6',
            'ctaTitle' => 'Curated service cho mot chuyen di Chau My khac biet',
            'highlights' => [
                ['name' => 'USA', 'note' => 'Nhiep song do thi va bieu tuong van hoa', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAt7Jjz7OY9D22MCMrywPV0iirfcorjf_5lQFN7L09syXWkwNxolLKU6hYPK9bLJF-UiRR_02JPWbWhRJyUhEZEanvXjeQRnjQcgj4kVP-P7dsxEtb1Fs3rPRKkTNyWGowDl17XKwXCfXNPqVdXoyK0pQPF_TbTERPretIInnUvkchI0y3P16QwLQtAJoyHPl4lWli7wnbIFUXrl3BG-NqBGYv9MhN_54dwVLghOEzhuSpdoknpsPCE40xeWm7OQ7jNAtf6HGrKkicM'],
                ['name' => 'Brazil', 'note' => 'Sac mau Latin va nang luong nhiet doi', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCwW4m3eyNi9OTYrxjyLy-cPY5ZrdKLZ2daF5mxucrwIDKA7mf5VStd1mcSJ65DHJ10AVcAg04zxpMizqh7VLmBftEWcyDyANQ9iy-PK1NGgL_H7HjGY_3pAzn01fs4cL-mq0HXVe_Xm7UibCOz3ZSpPdNcUzL_iEmnA6f2BIUXXr6M8qSp_s5Yb8NZ2fHRHdvLSGw736wxqxlYnXPhgCr03EQmYjj87jLf_-nE6X0OvB8YOzS9hIU_nBsW3UVAfg9MZoOTqqSQfjW5'],
                ['name' => 'Peru', 'note' => 'Huyen thoai Inca va nui rung ky vi', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBnGih2cV12VWelE02rNU5DTrkOOqbAxUbr_36TI1xlJlyCEhUTvZDtwatSdc92d5hsCP7MfMD4uSFLMaOKG6-I5vKF6pqY7aWSgXJS0QH8PhVuTcMySGT51AxSDyJFaTwv0SGLpJvZ_Cj_-0_dyEv2DMy0xQFZvdp8KW3Ilhbk10FYS_mhaHRsbXiNhaeY9VrAZWFGgjMqaKw4cGnOfcPgfyTzdgOPMWhseuQlY90PLphOAEK3VRVLEU5_QIWskbQqEBGyVcWEM8pI'],
                ['name' => 'Canada', 'note' => 'Rockies va ho bang xanh ngoc', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD7aog5oAAsYR3sMnOaPKb99HdOk0P6CO0_LmYlWChCyhIqWkS6JkpaFFh7Y52k5FgkRoTaqRLhmscEN6vCtzxYILreAwfktEFJrGJ3Yml4HGdhi2M565Qr0aZn10Bi08gZlP5vZt0pQ1pHC97_cRiwiQNssFYfcIRaoTXDPYPOcCrHF_PIee_LLoPJqTo9T6aFN7T8W14Xft5XxqKSWcBCf2Iqofl0EfCRmPd5YrWsdObPgrPaTapUsuhu3LmFAHuO86Zh8tcmsjKn'],
            ],
        ],
        'oceania' => [
            'slug' => 'oceania',
            'name' => 'Chau Uc',
            'title' => 'Oceania Escape',
            'eyebrow' => 'Ky quan xu so Nam Ban Cau',
            'subtitle' => 'Khoi day cam hung kham pha voi bo bien, thanh pho nang dong va thien nhien nguyen so cua Chau Uc.',
            'heroImage' => 'https://images.unsplash.com/photo-1523482580672-f109ba8cb9be?auto=format&fit=crop&w=1600&q=80',
            'ctaTitle' => 'Len ke hoach cho mot ky nghi Oceania thong dong',
            'highlights' => [
                ['name' => 'Sydney', 'note' => 'Bieu tuong nha hat ben cang', 'image' => 'https://images.unsplash.com/photo-1506973035872-a4f23ef6b47a?auto=format&fit=crop&w=1200&q=80'],
                ['name' => 'Melbourne', 'note' => 'Thanh pho nghe thuat va am thuc', 'image' => 'https://images.unsplash.com/photo-1514395462725-fb4566210144?auto=format&fit=crop&w=1200&q=80'],
                ['name' => 'New Zealand', 'note' => 'Phong canh dien anh ngoan muc', 'image' => 'https://images.unsplash.com/photo-1507699622108-4be3abd695ad?auto=format&fit=crop&w=1200&q=80'],
                ['name' => 'Gold Coast', 'note' => 'Bien xanh va nghi duong nang dong', 'image' => 'https://images.unsplash.com/photo-1500375592092-40eb2168fd21?auto=format&fit=crop&w=1200&q=80'],
            ],
        ],
        'africa' => [
            'slug' => 'africa',
            'name' => 'Chau Phi',
            'title' => 'African Horizons',
            'eyebrow' => 'Hoang da va di san nhan loai',
            'subtitle' => 'Tu safari den kim tu thap, Chau Phi mo ra mot chuyen di day ban nang va ky uc khong the sao chep.',
            'heroImage' => 'https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?auto=format&fit=crop&w=1600&q=80',
            'ctaTitle' => 'Mo khoa mot hanh trinh Chau Phi day ban nang',
            'highlights' => [
                ['name' => 'Ai Cap', 'note' => 'Kim tu thap va song Nile', 'image' => 'https://images.unsplash.com/photo-1539650116574-75c0c6d73f23?auto=format&fit=crop&w=1200&q=80'],
                ['name' => 'Nam Phi', 'note' => 'Safari, vang nho va mui Hao Vong', 'image' => 'https://images.unsplash.com/photo-1523805009345-7448845a9e53?auto=format&fit=crop&w=1200&q=80'],
                ['name' => 'Morocco', 'note' => 'Sac mau sa mac va medina co', 'image' => 'https://images.unsplash.com/photo-1489493887464-892be6d1daae?auto=format&fit=crop&w=1200&q=80'],
                ['name' => 'Kenya', 'note' => 'Thao nguyen rong lon va dong vat hoang da', 'image' => 'https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?auto=format&fit=crop&w=1200&q=80'],
            ],
        ],
    ];

    private $domesticMeta = [
        'north' => [
            'slug' => 'north',
            'name' => 'Mien Bac',
            'title' => 'Hành Trình Di Sản Miền Bắc',
            'eyebrow' => 'Văn hóa và di sản',
            'subtitle' => 'Từ phố cổ Hà Nội đến ruộng bậc thang Tây Bắc, miền Bắc là những chuyến đi đậm chất văn hóa và cảnh quan.',
            'heroImage' => 'https://images.unsplash.com/photo-1549646871-ebdd8a65fbbc?auto=format&fit=crop&w=1600&q=80',
            'ctaTitle' => 'Tìm hành trình miền Bắc phù hợp với nhịp đi của bạn',
            'highlights' => [
                ['name' => 'Hà Nội', 'note' => 'Phố cổ, ẩm thực và nhịp sống thủ đô', 'image' => 'https://images.unsplash.com/photo-1583416750470-965b2707b355?auto=format&fit=crop&w=1200&q=80'],
                ['name' => 'Hạ Long', 'note' => 'Di sản biển và du thuyền nghỉ dưỡng', 'image' => 'https://images.unsplash.com/photo-1527786356703-4b100091cd2c?auto=format&fit=crop&w=1200&q=80'],
                ['name' => 'Sa Pa', 'note' => 'Ruộng bậc thang và bản làng Tây Bắc', 'image' => 'https://images.unsplash.com/photo-1557750255-c76072a7aad1?auto=format&fit=crop&w=1200&q=80'],
                ['name' => 'Hà Giang', 'note' => 'Cung đường đèo đá và cao nguyên đá', 'image' => 'https://images.unsplash.com/photo-1573270689103-d7d46b1f5470?auto=format&fit=crop&w=1200&q=80'],
            ],
        ],
        'central' => [
            'slug' => 'central',
            'name' => 'Miền Trung',
            'title' => 'Di Sản & Bờ Biển Miền Trung',
            'eyebrow' => 'Nắng gió và di sản',
            'subtitle' => 'Miền Trung kết hợp bờ biển đẹp, đô thị cổ và những hành trình nghỉ dưỡng cao cấp chuẩn mực.',
            'heroImage' => 'https://images.unsplash.com/photo-1565780046528-9f4d6f9ab04b?auto=format&fit=crop&w=1600&q=80',
            'ctaTitle' => 'Lên lịch cho kỳ nghỉ miền Trung đầy nắng',
            'highlights' => [
                ['name' => 'Đà Nẵng', 'note' => 'Thành phố biển năng động và hiện đại', 'image' => 'https://images.unsplash.com/photo-1559592413-7cec4d0cae2b?auto=format&fit=crop&w=1200&q=80'],
                ['name' => 'Hội An', 'note' => 'Phố cổ, đèn lồng và nhịp sống chậm', 'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1200&q=80'],
                ['name' => 'Huế', 'note' => 'Cố đô và âm hưởng cung đình', 'image' => 'https://images.unsplash.com/photo-1555400038-63f5ba517a47?auto=format&fit=crop&w=1200&q=80'],
                ['name' => 'Nha Trang', 'note' => 'Biển xanh và nghỉ dưỡng ven bờ', 'image' => 'https://images.unsplash.com/photo-1528702748617-c64d49f918af?auto=format&fit=crop&w=1200&q=80'],
            ],
        ],
        'south' => [
            'slug' => 'south',
            'name' => 'Miền Nam',
            'title' => 'Nhịp Sống Phương Nam',
            'eyebrow' => 'Sông nước và thành thị',
            'subtitle' => 'Không gian du lịch miền Nam được thiết kế linh hoạt với ẩm thực phong phú và dịch vụ cao cấp.',
            'heroImage' => 'https://images.unsplash.com/photo-1580184489285-8c4f7f8ce8ac?auto=format&fit=crop&w=1600&q=80',
            'ctaTitle' => 'Chọn một chuyến đi miền Nam trọn vẹn',
            'highlights' => [
                ['name' => 'Sài Gòn', 'note' => 'Phố thị sôi động và dịch vụ cao cấp', 'image' => 'https://images.unsplash.com/photo-1583417319070-4a69db38a482?auto=format&fit=crop&w=1200&q=80'],
                ['name' => 'Vũng Tàu', 'note' => 'Biển gần thành phố để nghỉ cuối tuần', 'image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=80'],
                ['name' => 'Tây Ninh', 'note' => 'Hành trình tâm linh và cung đường xanh', 'image' => 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1200&q=80'],
                ['name' => 'Đồng Nai', 'note' => 'Nghỉ dưỡng ngoại thành và điểm xanh cuối tuần', 'image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1200&q=80'],
            ],
        ],
        'mekong' => [
            'slug' => 'mekong',
            'name' => 'Miền Tây',
            'title' => 'Hành Trình Sông Nước Cửu Long',
            'eyebrow' => 'Sông nước và chợ nổi',
            'subtitle' => 'Miền Tây mang đậm bản sắc địa phương, vườn trái cây trĩu quả và những hành trình sông nước yên bình.',
            'heroImage' => 'https://images.unsplash.com/photo-1464037866556-6812c9d1c72e?auto=format&fit=crop&w=1600&q=80',
            'ctaTitle' => 'Lên lịch cho một hành trình Miền Tây đậm chất bản địa',
            'highlights' => [
                ['name' => 'Cần Thơ', 'note' => 'Chợ nổi, bến Ninh Kiều và ẩm thực sông nước', 'image' => 'https://images.unsplash.com/photo-1690639442457-f6f7a4d8c080?auto=format&fit=crop&w=1200&q=80'],
                ['name' => 'Bến Tre', 'note' => 'Xứ dừa, kênh rạch và vườn trái cây', 'image' => 'https://images.unsplash.com/photo-1519046904884-53103b34b206?auto=format&fit=crop&w=1200&q=80'],
                ['name' => 'An Giang', 'note' => 'Châu Đốc, rừng tràm và văn hóa biên giới', 'image' => 'https://images.unsplash.com/photo-1500534314209-a25ddb2bd429?auto=format&fit=crop&w=1200&q=80'],
                ['name' => 'Cà Mau', 'note' => 'Đất mũi, rừng ngập mặn và nhịp sống cực Nam', 'image' => 'https://images.unsplash.com/photo-1470770841072-f978cf4d019e?auto=format&fit=crop&w=1200&q=80'],
            ],
        ],
        'islands' => [
            'slug' => 'islands',
            'name' => 'Hải Đảo',
            'title' => 'Bộ Sưu Tập Biển Đảo',
            'eyebrow' => 'Nghỉ dưỡng biển đảo',
            'subtitle' => 'Những chuyến đi biển đảo mang lại không gian tĩnh lặng, cảnh quan hùng vĩ và trải nghiệm nghỉ dưỡng đích thực.',
            'heroImage' => 'https://images.unsplash.com/photo-1500375592092-40eb2168fd21?auto=format&fit=crop&w=1600&q=80',
            'ctaTitle' => 'Đặt một kỳ nghỉ biển đảo thong dong',
            'highlights' => [
                ['name' => 'Phú Quốc', 'note' => 'Resort biển và hoàng hôn phía Tây', 'image' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?auto=format&fit=crop&w=1200&q=80'],
                ['name' => 'Côn Đảo', 'note' => 'Biển trong, rừng nguyên sinh và sự tĩnh lặng', 'image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=80'],
                ['name' => 'Lý Sơn', 'note' => 'Địa hình núi lửa và biển xanh', 'image' => 'https://images.unsplash.com/photo-1473116763249-2faaef81ccda?auto=format&fit=crop&w=1200&q=80'],
                ['name' => 'Nam Du', 'note' => 'Đảo nhỏ, biển êm và nhịp sống chậm', 'image' => 'https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=1200&q=80'],
            ],
        ],
    ];

    public function getFeaturedTours($limit = 3) {
        $sql = "SELECT * FROM {$this->table} WHERE availability = 1 ORDER BY {$this->primaryKey} DESC LIMIT :limit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $this->normalizeTours($stmt->fetchAll(), true);
    }

    public function getActiveTours($page = 1, $limit = 9) {
        return $this->getForeignTours($page, $limit);
    }

    public function countActiveTours() {
        return $this->countForeignTours();
    }

    public function getTourDetail($id) {
        $tour = $this->findById($id);
        if (!$tour || empty($tour['availability'])) {
            return null;
        }

        $promoModel = new PromotionModel();
        $promoMap = $promoModel->getBestDiscountPercentForTourIds([(int) $id]);
        $promoPct = (float) ($promoMap[(int) $id] ?? 0);
        $tour = $this->normalizeTour($tour, true, $promoPct);
        $tour['images'] = $this->getTourImages($id);
        $tour['itinerary'] = $this->getItinerary($id);
        $tour['reviewCount'] = $this->getReviewCount($id);
        $tour['avgRating'] = $this->getAverageRating($id);
        $tour['continent'] = $this->getTourContinent($tour);
        $tour['domesticRegion'] = $this->getTourDomesticRegion($tour);
        $tour['continentMeta'] = $this->getContinentMeta($tour['continent']);
        $tour['domesticMeta'] = $tour['domesticRegion'] ? $this->getDomesticMeta($tour['domesticRegion']) : null;
        $tour['tourCode'] = 'TBL-' . str_pad((string) $tour['tourID'], 4, '0', STR_PAD_LEFT);

        return $tour;
    }

    public function searchTours($keyword, $limit = 12) {
        $keyword = trim((string) $keyword);
        if ($keyword === '') {
            return [];
        }

        $search = '%' . $keyword . '%';
        $sql = "SELECT * FROM {$this->table}
                WHERE availability = 1
                  AND (title LIKE :kw OR description LIKE :kw OR destination LIKE :kw)
                ORDER BY {$this->primaryKey} DESC
                LIMIT :limit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':kw', $search);
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $this->normalizeTours($stmt->fetchAll(), true);
    }

    /**
     * Search tours by multiple keywords with pagination.
     *
     * @param string[] $keywords
     * @return array{tours: array, total: int}
     */
    public function searchToursKeywordsPaged(array $keywords, $page = 1, $limit = 9) {
        $page = max(1, (int) $page);
        $limit = max(1, (int) $limit);

        $cleanKeywords = [];
        foreach ($keywords as $keyword) {
            $keyword = trim((string) $keyword);
            if ($keyword !== '') {
                $cleanKeywords[] = mb_strtolower($keyword, 'UTF-8');
            }
        }

        if (empty($cleanKeywords)) {
            return [
                'tours' => [],
                'total' => 0,
            ];
        }

        $matchedTours = [];
        foreach ($this->getAllAvailableTours() as $tour) {
            $haystack = mb_strtolower($this->buildHaystack($tour), 'UTF-8');

            foreach ($cleanKeywords as $keyword) {
                if (mb_strpos($haystack, $keyword, 0, 'UTF-8') !== false) {
                    $matchedTours[] = $tour;
                    break;
                }
            }
        }

        return [
            'tours' => $this->sliceTours($matchedTours, $page, $limit),
            'total' => count($matchedTours),
        ];
    }

    public function getToursByDestination($destination, $limit = 9) {
        $sql = "SELECT * FROM {$this->table}
                WHERE availability = 1
                  AND (destination LIKE :dest OR title LIKE :dest OR description LIKE :dest)
                ORDER BY {$this->primaryKey} DESC
                LIMIT :limit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':dest', '%' . $destination . '%');
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $this->normalizeTours($stmt->fetchAll(), true);
    }

    public function getForeignTours($page = 1, $limit = 9) {
        $tours = $this->getAllAvailableTours();
        $foreignTours = [];

        foreach ($tours as $tour) {
            if ($this->getTourContinent($tour) !== null) {
                $foreignTours[] = $tour;
            }
        }

        return $this->sliceTours($foreignTours, $page, $limit);
    }

    public function countForeignTours() {
        $count = 0;
        foreach ($this->getAllAvailableTours() as $tour) {
            if ($this->getTourContinent($tour) !== null) {
                $count++;
            }
        }
        return $count;
    }

    public function getDomesticTours($page = 1, $limit = 9) {
        $filtered = [];

        foreach ($this->getAllAvailableTours() as $tour) {
            if ($this->getTourDomesticRegion($tour) !== null) {
                $filtered[] = $tour;
            }
        }

        return $this->sliceTours($filtered, $page, $limit);
    }

    public function countDomesticTours() {
        $count = 0;

        foreach ($this->getAllAvailableTours() as $tour) {
            if ($this->getTourDomesticRegion($tour) !== null) {
                $count++;
            }
        }

        return $count;
    }

    public function getToursByDomesticRegion($region, $page = 1, $limit = 9) {
        $region = $this->normalizeDomesticRegion($region);
        $filtered = [];

        foreach ($this->getAllAvailableTours() as $tour) {
            if ($this->matchesDomesticRegion($tour, $region)) {
                $filtered[] = $tour;
            }
        }

        return $this->sliceTours($filtered, $page, $limit);
    }

    public function countToursByDomesticRegion($region) {
        $region = $this->normalizeDomesticRegion($region);
        $count = 0;

        foreach ($this->getAllAvailableTours() as $tour) {
            if ($this->matchesDomesticRegion($tour, $region)) {
                $count++;
            }
        }

        return $count;
    }

    public function getFeaturedToursByDomesticRegion($region, $limit = 3) {
        return array_slice($this->getToursByDomesticRegion($region, 1, 100), 0, $limit);
    }

    public function getToursByContinent($continent, $page = 1, $limit = 9) {
        $continent = $this->normalizeRegion($continent);
        $filtered = [];

        foreach ($this->getAllAvailableTours() as $tour) {
            if ($this->matchesContinent($tour, $continent)) {
                $filtered[] = $tour;
            }
        }

        return $this->sliceTours($filtered, $page, $limit);
    }

    public function countToursByContinent($continent) {
        $continent = $this->normalizeRegion($continent);
        $count = 0;

        foreach ($this->getAllAvailableTours() as $tour) {
            if ($this->matchesContinent($tour, $continent)) {
                $count++;
            }
        }

        return $count;
    }

    public function getFeaturedToursByContinent($continent, $limit = 3) {
        return array_slice($this->getToursByContinent($continent, 1, 100), 0, $limit);
    }

    public function getContinentMeta($continent = null) {
        $continent = $this->normalizeRegion($continent);
        return $this->continentMeta[$continent] ?? $this->continentMeta['asia'];
    }

    public function getAllContinentMeta() {
        return $this->continentMeta;
    }

    public function getDomesticMeta($region = null) {
        $region = $this->normalizeDomesticRegion($region);
        return $this->domesticMeta[$region] ?? $this->domesticMeta['north'];
    }

    public function getAllDomesticMeta() {
        return $this->domesticMeta;
    }

    public function getTourContinent($tour) {
        $haystack = $this->buildHaystack($tour);

        foreach (array_keys($this->continentKeywords) as $continent) {
            foreach ($this->continentKeywords[$continent] as $keyword) {
                if (strpos($haystack, $keyword) !== false) {
                    return $continent;
                }
            }
        }

        return null;
    }

    public function getTourDomesticRegion($tour) {
        $haystack = $this->buildHaystack($tour);

        foreach (array_keys($this->domesticKeywords) as $region) {
            foreach ($this->domesticKeywords[$region] as $keyword) {
                if (strpos($haystack, $keyword) !== false) {
                    return $region;
                }
            }
        }

        return null;
    }

    public function getRelatedTours($tourId, $limit = 3) {
        $tour = $this->getTourDetail($tourId);
        if (!$tour) {
            return [];
        }

        $continent = $tour['continent'];
        $domesticRegion = $tour['domesticRegion'] ?? null;
        $related = [];

        $pool = $domesticRegion !== null
            ? $this->getToursByDomesticRegion($domesticRegion, 1, 100)
            : $this->getToursByContinent($continent, 1, 100);

        foreach ($pool as $item) {
            if ((int) $item['tourID'] === (int) $tourId) {
                continue;
            }
            $related[] = $item;
            if (count($related) >= $limit) {
                break;
            }
        }

        return $related;
    }

    public function getItinerary($tourId) {
        try {
            $sql = "SELECT * FROM TourItinerary WHERE tourID = :tourId ORDER BY dayNumber ASC, sortOrder ASC";
            $stmt = $this->query($sql, ['tourId' => $tourId]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }

    private function getAllAvailableTours() {
        $sql = "SELECT * FROM {$this->table} WHERE availability = 1 ORDER BY {$this->primaryKey} DESC";
        $stmt = $this->db->query($sql);
        return $this->normalizeTours($stmt->fetchAll(), true);
    }

    private function normalizeTours(array $tours, $attachImages = false) {
        $ids = [];
        foreach ($tours as $t) {
            if (!empty($t['tourID'])) {
                $ids[] = (int) $t['tourID'];
            }
        }
        $promoMap = [];
        if (!empty($ids)) {
            $promoModel = new PromotionModel();
            $promoMap = $promoModel->getBestDiscountPercentForTourIds($ids);
        }
        $normalized = [];
        foreach ($tours as $tour) {
            $tid = (int) ($tour['tourID'] ?? 0);
            $pct = $tid > 0 ? (float) ($promoMap[$tid] ?? 0) : 0.0;
            $normalized[] = $this->normalizeTour($tour, $attachImages, $pct);
        }
        return $normalized;
    }

    /**
     * Attach active promotion pricing to a raw tour row (e.g. inactive tour on old invoice).
     */
    public function enrichTourWithPromotion(array $tour) {
        $tid = (int) ($tour['tourID'] ?? 0);
        if ($tid <= 0) {
            return $this->normalizeTour($tour, false, 0.0);
        }
        $promoModel = new PromotionModel();
        $map = $promoModel->getBestDiscountPercentForTourIds([$tid]);
        $pct = (float) ($map[$tid] ?? 0);
        return $this->normalizeTour($tour, false, $pct);
    }

    private function normalizeTour($tour, $attachImages = false, $promoDiscountPercent = 0.0) {
        if (!$tour) {
            return $tour;
        }

        $tour['tour_name'] = $tour['tour_name'] ?? ($tour['title'] ?? 'Untitled Tour');
        $tour['title'] = $tour['title'] ?? ($tour['tour_name'] ?? 'Untitled Tour');
        $tour['status'] = !empty($tour['availability']) ? 'active' : 'inactive';

        $listAdult = (float) ($tour['priceAdult'] ?? 0);
        $listChild = (float) ($tour['priceChild'] ?? 0);
        $pct = min(100, max(0, (float) $promoDiscountPercent));
        $tour['promoDiscountPercent'] = $pct;
        $tour['priceAdultSale'] = (int) round($listAdult * (1 - $pct / 100));
        $tour['priceChildSale'] = (int) round($listChild * (1 - $pct / 100));
        $tour['price'] = (float) $tour['priceAdultSale'];
        $tour['continent'] = $this->getTourContinent($tour);
        $tour['domesticRegion'] = $this->getTourDomesticRegion($tour);
        $tour['continentLabel'] = $tour['continent'] ? ($this->getContinentMeta($tour['continent'])['name'] ?? '') : 'Khac';
        $tour['domesticLabel'] = $tour['domesticRegion'] ? ($this->getDomesticMeta($tour['domesticRegion'])['name'] ?? '') : null;
        $dbImageURL = $tour['imageURL'] ?? '';

        $tour['summary'] = $tour['description'] ?? '';

        if ($attachImages) {
            $tour['images'] = $this->getTourImages($tour['tourID']);
            if (!empty($dbImageURL)) {
                $tour['heroImage'] = $dbImageURL;
            } elseif (!empty($tour['images'][0]['imageURL'])) {
                $tour['heroImage'] = $tour['images'][0]['imageURL'];
                $tour['imageURL'] = $tour['images'][0]['imageURL'];
            } else {
                $tour['heroImage'] = $this->getPlaceholderImage($tour['continent'], $tour['domesticRegion']);
                $tour['imageURL'] = $tour['heroImage'];
            }
        } else {
            $tour['heroImage'] = !empty($dbImageURL) ? $dbImageURL : $this->getPlaceholderImage($tour['continent'], $tour['domesticRegion']);
            $tour['imageURL'] = !empty($dbImageURL) ? $dbImageURL : $tour['heroImage'];
        }

        return $tour;
    }

    private function getTourImages($tourId) {
        try {
            $this->syncGalleryImagesFromFilesystem($tourId);
            $stmt = $this->query("SELECT * FROM Images WHERE tourID = :tourId ORDER BY imageID ASC", ['tourId' => $tourId]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }

    private function getReviewCount($tourId) {
        try {
            $stmt = $this->query("SELECT COUNT(*) AS total FROM Review WHERE tourID = :tourId", ['tourId' => $tourId]);
            $row = $stmt->fetch();
            return (int) ($row['total'] ?? 0);
        } catch (PDOException $e) {
            return 0;
        }
    }

    private function getAverageRating($tourId) {
        try {
            $stmt = $this->query("SELECT AVG(rating) AS avgRating FROM Review WHERE tourID = :tourId", ['tourId' => $tourId]);
            $row = $stmt->fetch();
            return round((float) ($row['avgRating'] ?? 0), 1);
        } catch (PDOException $e) {
            return 0;
        }
    }

    private function matchesContinent($tour, $continent) {
        return $this->getTourContinent($tour) === $continent;
    }

    private function matchesDomesticRegion($tour, $region) {
        return $this->getTourDomesticRegion($tour) === $region;
    }

    private function sliceTours(array $tours, $page, $limit) {
        $offset = max(0, ($page - 1) * $limit);
        return array_slice($tours, $offset, $limit);
    }

    private function buildHaystack($tour) {
        $text = implode(' ', [
            $tour['destination'] ?? '',
            $tour['title'] ?? '',
            $tour['tour_name'] ?? '',
            $tour['description'] ?? '',
        ]);

        return $this->normalizeText($text);
    }

    private function normalizeRegion($region) {
        $region = strtolower(trim((string) $region));
        if ($region === 'americas') {
            return 'america';
        }
        if ($region === 'australia') {
            return 'oceania';
        }
        return isset($this->continentKeywords[$region]) ? $region : 'asia';
    }

    private function normalizeDomesticRegion($region) {
        $region = strtolower(trim((string) $region));
        $map = [
            'mien bac' => 'north',
            'bac' => 'north',
            'north' => 'north',
            'mien trung' => 'central',
            'trung' => 'central',
            'central' => 'central',
            'mien nam' => 'south',
            'nam' => 'south',
            'south' => 'south',
            'mien tay' => 'mekong',
            'mekong' => 'mekong',
            'mekong delta' => 'mekong',
            'dong bang song cuu long' => 'mekong',
            'song cuu long' => 'mekong',
            'hai dao' => 'islands',
            'dao' => 'islands',
            'islands' => 'islands',
        ];

        return $map[$region] ?? (isset($this->domesticKeywords[$region]) ? $region : 'north');
    }

    private function normalizeText($value) {
        $value = strtolower((string) $value);
        $map = [
            'à' => 'a', 'á' => 'a', 'ạ' => 'a', 'ả' => 'a', 'ã' => 'a',
            'â' => 'a', 'ầ' => 'a', 'ấ' => 'a', 'ậ' => 'a', 'ẩ' => 'a', 'ẫ' => 'a',
            'ă' => 'a', 'ằ' => 'a', 'ắ' => 'a', 'ặ' => 'a', 'ẳ' => 'a', 'ẵ' => 'a',
            'è' => 'e', 'é' => 'e', 'ẹ' => 'e', 'ẻ' => 'e', 'ẽ' => 'e',
            'ê' => 'e', 'ề' => 'e', 'ế' => 'e', 'ệ' => 'e', 'ể' => 'e', 'ễ' => 'e',
            'ì' => 'i', 'í' => 'i', 'ị' => 'i', 'ỉ' => 'i', 'ĩ' => 'i',
            'ò' => 'o', 'ó' => 'o', 'ọ' => 'o', 'ỏ' => 'o', 'õ' => 'o',
            'ô' => 'o', 'ồ' => 'o', 'ố' => 'o', 'ộ' => 'o', 'ổ' => 'o', 'ỗ' => 'o',
            'ơ' => 'o', 'ờ' => 'o', 'ớ' => 'o', 'ợ' => 'o', 'ở' => 'o', 'ỡ' => 'o',
            'ù' => 'u', 'ú' => 'u', 'ụ' => 'u', 'ủ' => 'u', 'ũ' => 'u',
            'ư' => 'u', 'ừ' => 'u', 'ứ' => 'u', 'ự' => 'u', 'ử' => 'u', 'ữ' => 'u',
            'ỳ' => 'y', 'ý' => 'y', 'ỵ' => 'y', 'ỷ' => 'y', 'ỹ' => 'y',
            'đ' => 'd'
        ];
        $value = strtr($value, $map);
        $value = preg_replace('/[^a-z0-9\s]/', ' ', $value);
        return preg_replace('/\s+/', ' ', trim((string) $value));
    }

    private function getPlaceholderImage($continent, $domesticRegion = null) {
        // Return a local fallback image instead of Unsplash URLs which might fail to load
        return '/travel.bling/img/pexels-fotoaibe-1669799.jpg';
    }

    private function syncGalleryImagesFromFilesystem($tourId) {
        $tourId = (int) $tourId;
        if ($tourId <= 0) {
            return;
        }

        $tour = $this->findById($tourId);
        if (!$tour) {
            return;
        }

        $uploadDir = dirname(__DIR__, 2) . '/img/tours/';
        if (!is_dir($uploadDir)) {
            return;
        }

        $files = glob($uploadDir . 'tour_' . $tourId . '_*');
        if (empty($files)) {
            return;
        }

        sort($files, SORT_NATURAL);

        $existingStmt = $this->query("SELECT imageURL FROM Images WHERE tourID = :tourId", ['tourId' => $tourId]);
        $existingUrls = $existingStmt->fetchAll(PDO::FETCH_COLUMN) ?: [];
        $existingLookup = array_fill_keys($existingUrls, true);

        $reservedUrls = [];
        if (!empty($tour['imageURL'])) {
            $reservedUrls[$tour['imageURL']] = true;
        }

        try {
            $itineraryStmt = $this->query(
                "SELECT imageURL FROM TourItinerary WHERE tourID = :tourId AND imageURL IS NOT NULL AND imageURL <> ''",
                ['tourId' => $tourId]
            );
            foreach ($itineraryStmt->fetchAll(PDO::FETCH_COLUMN) ?: [] as $imageUrl) {
                $reservedUrls[$imageUrl] = true;
            }
        } catch (PDOException $e) {
            // Ignore older schemas without TourItinerary image storage.
        }

        foreach ($files as $file) {
            $url = '/travel.bling/img/tours/' . basename($file);

            if (isset($existingLookup[$url]) || isset($reservedUrls[$url])) {
                continue;
            }

            $this->query(
                "INSERT INTO Images (tourID, imageURL, description) VALUES (:tourId, :url, :description)",
                [
                    'tourId' => $tourId,
                    'url' => $url,
                    'description' => '',
                ]
            );
            $existingLookup[$url] = true;
        }
    }
}
