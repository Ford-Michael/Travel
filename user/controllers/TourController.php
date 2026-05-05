<?php
/**
 * Tour Controller
 * Handles tour listing, search, and detail pages
 */

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/TourModel.php';
require_once __DIR__ . '/../models/ReviewModel.php';

class TourController extends Controller {
    private $tourModel;
    private $reviewModel;

    public function __construct() {
        $this->tourModel = new TourModel();
        $this->reviewModel = new ReviewModel();
    }

    /**
     * Tour listing page
     */
    public function index() {
        $page  = (int) ($this->get('page', 1));
        $page  = max(1, $page);

        try {
            $tours = $this->tourModel->getForeignTours($page, 9);
            $total = $this->tourModel->countForeignTours();
            $continentCards = [];

            foreach ($this->tourModel->getAllContinentMeta() as $slug => $meta) {
                $continentCards[] = [
                    'slug' => $slug,
                    'name' => $meta['name'],
                    'title' => $meta['title'],
                    'subtitle' => $meta['subtitle'],
                    'heroImage' => $meta['heroImage'],
                    'count' => $this->tourModel->countToursByContinent($slug),
                    'featured' => $this->tourModel->getFeaturedToursByContinent($slug, 2),
                ];
            }
        } catch (Exception $e) {
            $tours = [];
            $total = 0;
            $continentCards = [];
        }

        $totalPages = max(1, (int) ceil($total / 9));

        $this->view('tours/index', [
            'title'      => 'Tất Cả Tours | Travel Bling',
            'tours'      => $tours,
            'page'       => $page,
            'totalPages' => $totalPages,
            'flash'      => $this->getFlash(),
            'user'       => $this->getCurrentUser(),
            'totalTours' => $total,
            'continentCards' => $continentCards,
            'title' => 'Du lich nuoc ngoai | Travel Bling',
        ]);
    }

    private function resolveContinentView($region) {
        $map = [
            'asia' => 'tours/tours_out_national/tour-chau-a',
            'europe' => 'tours/tours_out_national/tour-chau-au',
            'america' => 'tours/tours_out_national/tour-chau-my',
            'oceania' => 'tours/tours_out_national/tour-chau-uc',
            'africa' => 'tours/tours_out_national/tour-chau-phi',
        ];

        return $map[$region] ?? 'tours/continent';
    }

    /**
     * Continent page.
     */
    public function continent() {
        $region = $this->get('region', 'asia');
        $page = max(1, (int) $this->get('page', 1));

        try {
            $meta = $this->tourModel->getContinentMeta($region);
            $tours = $this->tourModel->getToursByContinent($region, $page, 9);
            $total = $this->tourModel->countToursByContinent($region);
        } catch (Exception $e) {
            $meta = $this->tourModel->getContinentMeta('asia');
            $tours = [];
            $total = 0;
        }

        $this->view($this->resolveContinentView($meta['slug'] ?? $region), [
            'title' => $meta['name'] . ' | Travel Bling',
            'meta' => $meta,
            'region' => $meta['slug'],
            'tours' => $tours,
            'page' => $page,
            'totalPages' => max(1, (int) ceil($total / 9)),
            'totalTours' => $total,
            'flash' => $this->getFlash(),
            'user' => $this->getCurrentUser(),
        ]);
    }

    /**
     * Domestic landing page.
     */
    public function domestic() {
        $page = max(1, (int) $this->get('page', 1));

        try {
            $tours = $this->tourModel->getDomesticTours($page, 9);
            $total = $this->tourModel->countDomesticTours();
            $regionCards = [];

            foreach ($this->tourModel->getAllDomesticMeta() as $slug => $meta) {
                $regionCards[] = [
                    'slug' => $slug,
                    'name' => $meta['name'],
                    'title' => $meta['title'],
                    'subtitle' => $meta['subtitle'],
                    'heroImage' => $meta['heroImage'],
                    'count' => $this->tourModel->countToursByDomesticRegion($slug),
                    'featured' => $this->tourModel->getFeaturedToursByDomesticRegion($slug, 2),
                ];
            }
        } catch (Exception $e) {
            $tours = [];
            $total = 0;
            $regionCards = [];
        }

        $this->view('tours/domestic_index', [
            'title' => 'Du lich trong nuoc | Travel Bling',
            'tours' => $tours,
            'page' => $page,
            'totalPages' => max(1, (int) ceil($total / 9)),
            'totalTours' => $total,
            'regionCards' => $regionCards,
            'flash' => $this->getFlash(),
            'user' => $this->getCurrentUser(),
        ]);
    }

    /**
     * Domestic region page.
     */
    public function domesticRegion() {
        $region = $this->get('region', 'north');
        $page = max(1, (int) $this->get('page', 1));

        try {
            $meta = $this->tourModel->getDomesticMeta($region);
            $tours = $this->tourModel->getToursByDomesticRegion($region, $page, 9);
            $total = $this->tourModel->countToursByDomesticRegion($region);
        } catch (Exception $e) {
            $meta = $this->tourModel->getDomesticMeta('north');
            $tours = [];
            $total = 0;
        }

        $this->view($this->resolveDomesticRegionView($meta['slug'] ?? $region), [
            'title' => $meta['name'] . ' | Travel Bling',
            'meta' => $meta,
            'region' => $meta['slug'],
            'tours' => $tours,
            'page' => $page,
            'totalPages' => max(1, (int) ceil($total / 9)),
            'totalTours' => $total,
            'flash' => $this->getFlash(),
            'user' => $this->getCurrentUser(),
        ]);
    }

    /**
     * Tour detail page
     */
    public function detail() {
        $id = (int) $this->get('id');
        if (!$id) {
            $this->setFlash('danger', 'Tour khong ton tai.');
            $this->redirect('index.php?controller=tour');
        }

        try {
            $tour = $this->tourModel->getTourDetail($id);
            $relatedTours = $this->tourModel->getRelatedTours($id, 3);
            $reviews = $this->reviewModel->getByTour($id);
        } catch (Exception $e) {
            $tour = null;
            $relatedTours = [];
            $reviews = [];
        }

        if (!$tour) {
            $this->setFlash('danger', 'Tour không tồn tại.');
            $this->redirect('index.php?controller=tour');
        }

        $this->view('tours/detail', [
            'title' => htmlspecialchars($tour['tour_name'] ?? 'Tour Detail') . ' | Travel Bling',
            'tour'  => $tour,
            'relatedTours' => $relatedTours,
            'reviews' => $reviews,
            'flash' => $this->getFlash(),
            'user'  => $this->getCurrentUser(),
            'csrf_token' => $this->generateCsrfToken(),
        ]);
    }

    /**
     * Search tours
     */
    public function search() {
        $keyword = $this->sanitize($this->get('q', ''));

        $region = $this->resolveContinentKeyword($keyword);
        if ($region !== null) {
            $_GET['region'] = $region;
            return $this->continent();
        }

        $domesticRegion = $this->resolveDomesticKeyword($keyword);
        if ($domesticRegion === '__domestic__') {
            return $this->domestic();
        }
        if ($domesticRegion !== null) {
            $_GET['region'] = $domesticRegion;
            return $this->domesticRegion();
        }

        try {
            $tours = $keyword ? $this->tourModel->searchTours($keyword) : [];
        } catch (Exception $e) {
            $tours = [];
        }

        $this->view('tours/search', [
            'title'   => 'Tìm Kiếm: ' . $keyword . ' | Travel Bling',
            'tours'   => $tours,
            'keyword' => $keyword,
            'flash'   => $this->getFlash(),
            'user'    => $this->getCurrentUser(),
            'title'   => 'Tim kiem: ' . $keyword . ' | Travel Bling',
        ]);
    }

    private function resolveContinentKeyword($keyword) {
        $value = mb_strtolower(trim((string) $keyword), 'UTF-8');
        $value = strtr($value, [
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
        ]);

        $map = [
            'chau a' => 'asia',
            'asia' => 'asia',
            'chau au' => 'europe',
            'europe' => 'europe',
            'chau my' => 'america',
            'america' => 'america',
            'americas' => 'america',
            'chau uc' => 'oceania',
            'oceania' => 'oceania',
            'chau phi' => 'africa',
            'africa' => 'africa',
        ];

        return $map[$value] ?? null;
    }

    private function resolveDomesticKeyword($keyword) {
        $value = mb_strtolower(trim((string) $keyword), 'UTF-8');
        $value = strtr($value, [
            'Ã ' => 'a', 'Ã¡' => 'a', 'áº¡' => 'a', 'áº£' => 'a', 'Ã£' => 'a',
            'Ã¢' => 'a', 'áº§' => 'a', 'áº¥' => 'a', 'áº­' => 'a', 'áº©' => 'a', 'áº«' => 'a',
            'Äƒ' => 'a', 'áº±' => 'a', 'áº¯' => 'a', 'áº·' => 'a', 'áº³' => 'a', 'áºµ' => 'a',
            'Ã¨' => 'e', 'Ã©' => 'e', 'áº¹' => 'e', 'áº»' => 'e', 'áº½' => 'e',
            'Ãª' => 'e', 'á»' => 'e', 'áº¿' => 'e', 'á»‡' => 'e', 'á»ƒ' => 'e', 'á»…' => 'e',
            'Ã¬' => 'i', 'Ã­' => 'i', 'á»‹' => 'i', 'á»‰' => 'i', 'Ä©' => 'i',
            'Ã²' => 'o', 'Ã³' => 'o', 'á»' => 'o', 'á»' => 'o', 'Ãµ' => 'o',
            'Ã´' => 'o', 'á»“' => 'o', 'á»‘' => 'o', 'á»™' => 'o', 'á»•' => 'o', 'á»—' => 'o',
            'Æ¡' => 'o', 'á»' => 'o', 'á»›' => 'o', 'á»£' => 'o', 'á»Ÿ' => 'o', 'á»¡' => 'o',
            'Ã¹' => 'u', 'Ãº' => 'u', 'á»¥' => 'u', 'á»§' => 'u', 'Å©' => 'u',
            'Æ°' => 'u', 'á»«' => 'u', 'á»©' => 'u', 'á»±' => 'u', 'á»­' => 'u', 'á»¯' => 'u',
            'á»³' => 'y', 'Ã½' => 'y', 'á»µ' => 'y', 'á»·' => 'y', 'á»¹' => 'y',
            'Ä‘' => 'd'
        ]);

        $map = [
            'trong nuoc' => '__domestic__',
            'du lich trong nuoc' => '__domestic__',
            'mien bac' => 'north',
            'bac' => 'north',
            'mien trung' => 'central',
            'trung' => 'central',
            'mien nam' => 'south',
            'nam' => 'south',
            'mien tay' => 'mekong',
            'mekong' => 'mekong',
            'mekong delta' => 'mekong',
            'dong bang song cuu long' => 'mekong',
            'song cuu long' => 'mekong',
            'hai dao' => 'islands',
            'dao' => 'islands',
        ];

        return $map[$value] ?? null;
    }

    private function resolveDomesticRegionView($region) {
        $map = [
            'north' => 'tours/tours_in_country/tour_mien_bac',
            'central' => 'tours/tours_in_country/tour_mien-trung',
            'south' => 'tours/tours_in_country/tour-mien-nam',
            'mekong' => 'tours/tours_in_country/tour-mien-tay',
            'islands' => 'tours/tours_in_country/tour-hải-dao',
        ];

        return $map[$region] ?? 'tours/domestic_region';
    }

    /** Base URL for curated stock photos — `img/tour khách đoàn/` */
    private function miceDelegationImageUrl($filename) {
        return '/travel.bling/img/tour khách đoàn/' . ltrim($filename, '/');
    }

    /**
     * @return array|null
     */
    private function miceDelegationPageConfig($slug) {
        $img = [$this, 'miceDelegationImageUrl'];

        $base = [
            'doanh-nghiep' => [
                'view'       => 'tours/tour_khach-doan/tour-doanh-nghiep',
                'searchKeys' => ['Tour Doanh Nghiệp', 'MICE', 'đoàn doanh nghiệp'],
                'eyebrow'    => 'Tour đoàn & MICE',
                'breadcrumb' => 'Doanh nghiệp / MICE',
                'title'      => "Tour doanh nghiệp,\nhội thảo incentive",
                'subtitle'   => 'Lịch trình khảo sát, gala – team building DN, không gian họp và trải nghiệm thương hiệu được chăm sóc trọn vẹn.',
                'heroImage'  => $img('czDmd.jpg'),
                'ctaTitle'   => 'Nhận báo giá tour đoàn theo KPI & nhân sự',
                'highlights' => [
                    ['name' => 'Hội thảo — conference', 'note' => 'Sảnh và kỹ thuật theo checklist sự kiện.', 'image' => $img('9JENi.jpg')],
                    ['name' => 'Roadshow & khảo sát', 'note' => 'Di chuyển riêng, lịch sát chỉ đạo doanh nghiệp.', 'image' => $img('AxgbU.jpg')],
                    ['name' => 'Gala & CSR', 'note' => 'Concept trao giải, quà tặng thương hiệu gắn kết đội ngũ.', 'image' => $img('HMEcd.jpg')],
                    ['name' => 'MICE outbound', 'note' => 'Kết nối châu lục cùng hướng dẫn đồng hành 24/7.', 'image' => $img('Q0Vy1.jpg')],
                ],
            ],
            'gia-dinh' => [
                'view'       => 'tours/tour_khach-doan/tour-gia-dinh',
                'searchKeys' => ['Tour Gia Đình', 'gia đình', 'du lịch gia đình'],
                'eyebrow'    => 'Khách đoàn đa thế hệ',
                'breadcrumb' => 'Gia đình',
                'title'      => "Tour đoàn\ngia đình",
                'subtitle'   => 'Nghỉ dưỡng an toàn, tiết tấu thư giãn, phù hợp ông bà – con nhỏ, chụp ảnh và tiệc nhỏ theo nhu cầu.',
                'heroImage'  => $img('ygLIt.jpg'),
                'ctaTitle'   => 'Tư vấn lịch trình đa thế hệ chỉ trong 24h',
                'highlights' => [
                    ['name' => 'Resort gia đình', 'note' => 'Suite kết nối, tiện nghi giải trí cho trẻ.', 'image' => $img('qfAsB.jpg')],
                    ['name' => 'Ẩm thực chọn món', 'note' => 'Thực đơn chỉnh theo khẩu vị từng lứa tuổi.', 'image' => $img('XAbKY.jpg')],
                    ['name' => 'Chơi trong ngày', 'note' => 'Teambuilding nhẹ, chợ đêm, chợ làng lành mạnh.', 'image' => $img('ZoOj9.jpg')],
                    ['name' => 'Ký ức chụp ảnh', 'note' => 'Điểm check-in được gợi ý theo tổ ấm của bạn.', 'image' => $img('9JENi.jpg')],
                ],
            ],
            'nhom' => [
                'view'       => 'tours/tour_khach-doan/tour-nhom',
                'searchKeys' => ['Tour Nhóm', 'nhóm bạn', 'đoàn nhóm'],
                'eyebrow'    => 'Nhóm bạn · CLB · hội',
                'breadcrumb' => 'Nhóm bạn',
                'title'      => "Tour đoàn\ncùng nhóm",
                'subtitle'   => 'Linh hoạt số khách — nối các chặng và hoạt động chia sẻ chi phí, vẫn giữ không gian riêng trong ngày.',
                'heroImage'  => $img('XAbKY.jpg'),
                'ctaTitle'   => 'Đề xuất budget theo nhân sự & phong trào của nhóm',
                'highlights' => [
                    ['name' => 'Beach breakout', 'note' => 'BBQ và workshop thư giãn trên biển.', 'image' => $img('HMEcd.jpg')],
                    ['name' => 'City hops', 'note' => 'Chuyển nhanh giữa bar thời thượng và thủ đô di sản.', 'image' => $img('Q0Vy1.jpg')],
                    ['name' => 'Homestay dải làng', 'note' => 'Sống như dân làng và trải nghiệm bản địa.', 'image' => $img('AxgbU.jpg')],
                    ['name' => 'Sắp xếp xe & guide', 'note' => 'Giảm mảnh vụn logictics nhóm xe lớn.', 'image' => $img('czDmd.jpg')],
                ],
            ],
            'sinh-vien-hoc-sinh' => [
                'view'       => 'tours/tour_khach-doan/tour-sinh-vien-hoc-sinh',
                'searchKeys' => ['Tour Sinh Viên - Học Sinh', 'Sinh Viên', 'học sinh', 'trại hè'],
                'eyebrow'    => 'Học đường & trải nghiệm',
                'breadcrumb' => 'Sinh viên — học sinh',
                'title'      => "Tour đoàn\nhọc sinh – sinh viên",
                'subtitle'   => 'An toàn – giám sát theo nhóm nhỏ — kết nối bảo tàng và dự án thực tế không khô khan.',
                'heroImage'  => $img('qfAsB.jpg'),
                'ctaTitle'   => 'Nộp SLA an toàn & chương trình experiential learning',
                'highlights' => [
                    ['name' => 'Trại hè kỹ năng', 'note' => 'Ngày chia block kỹ năng mềm và thể chất nhẹ nhàng.', 'image' => $img('ZoOj9.jpg')],
                    ['name' => 'Museum quests', 'note' => 'Hướng dẫn kể chuyện lịch sử dễ xơi.', 'image' => $img('ygLIt.jpg')],
                    ['name' => 'Eco field trip', 'note' => 'Quan sát rừng – biển – trang trại tương tác STEM.', 'image' => $img('czDmd.jpg')],
                    ['name' => 'Quản giáo trên xe', 'note' => 'Checklist kiểm số báo điểm danh realtime.', 'image' => $img('9JENi.jpg')],
                ],
            ],
            'team-building' => [
                'view'       => 'tours/tour_khach-doan/tour-team-building',
                'searchKeys' => ['Tour Team Building', 'Team Building', 'teambuilding'],
                'eyebrow'    => 'Gắn kết nhân lực',
                'breadcrumb' => 'Team building',
                'title'      => "Team building —\nincentive nội bộ",
                'subtitle'   => 'Kịch bản hoạt động chỉnh theo KPI, chỉnh văn hóa doanh nghiệp và logistics không gián đoạn ca làm.',
                'heroImage'  => $img('AxgbU.jpg'),
                'ctaTitle'   => 'Thử thách kịch bản team building chỉ trong 72h báo giá',
                'highlights' => [
                    ['name' => 'Survival lite', 'note' => 'Thử thách nhóm không quá sức, phù hợp mọi độ tuổi văn phòng.', 'image' => $img('ZoOj9.jpg')],
                    ['name' => 'Battle of bands nội bộ', 'note' => 'Gắn thương hiệu vào phần biểu diễn sân khấu của chính công ty.', 'image' => $img('ygLIt.jpg')],
                    ['name' => 'Hackathon có facilitator', 'note' => 'Làm việc nhóm và trình diễn ý tưởng cuối ngày trong khung giờ cố định.', 'image' => $img('HMEcd.jpg')],
                    ['name' => 'Giá trị cốt lõi', 'note' => 'Chuỗi workshop ngắn gắn với KPI và văn hóa của ban lãnh đạo.', 'image' => $img('Q0Vy1.jpg')],
                ],
            ],
        ];

        return $base[$slug] ?? null;
    }

    /**
     * Tour khách đoàn / MICE landing — highlights (kiểu châu lục) + lưới tour DB (giống trang trong nước).
     */
    public function miceDelegation() {
        $allowed = ['doanh-nghiep', 'gia-dinh', 'nhom', 'sinh-vien-hoc-sinh', 'team-building'];
        $slug = strtolower(trim((string) $this->get('type', 'doanh-nghiep')));
        if (!in_array($slug, $allowed, true)) {
            $slug = 'doanh-nghiep';
        }

        $cfg = $this->miceDelegationPageConfig($slug);
        if (!$cfg) {
            $this->setFlash('danger', 'Trang không tồn tại.');
            $this->redirect('index.php?controller=tour');
        }

        $page = max(1, (int) $this->get('page', 1));
        $limit = 9;

        try {
            $result = $this->tourModel->searchToursKeywordsPaged($cfg['searchKeys'], $page, $limit);
            $tours = $result['tours'];
            $totalTours = $result['total'];
        } catch (Exception $e) {
            $tours = [];
            $totalTours = 0;
        }

        $totalPages = $totalTours > 0 ? max(1, (int) ceil($totalTours / $limit)) : 1;

        $breadcrumb = $cfg['breadcrumb'];
        $parts = preg_split('/\R/u', $cfg['title'], -1, PREG_SPLIT_NO_EMPTY);
        $h1Plain = implode(' ', array_map('trim', $parts));
        $baseTitle = $breadcrumb . ' · Tour khách đoàn';

        $meta = [
            'slug'       => $slug,
            'name'       => $breadcrumb,
            'eyebrow'    => $cfg['eyebrow'],
            'breadcrumb' => $breadcrumb,
            'title'      => $cfg['title'],
            'h1Plain'    => $h1Plain,
            'subtitle'   => $cfg['subtitle'],
            'heroImage'  => $cfg['heroImage'],
            'ctaTitle'   => $cfg['ctaTitle'],
            'highlights' => $cfg['highlights'],
        ];

        $this->view($cfg['view'], [
            'title'              => $baseTitle . ' | Travel Bling',
            'description'        => strip_tags(substr((string) $cfg['subtitle'], 0, 160)),
            'meta'               => $meta,
            'tours'              => $tours,
            'totalTours'         => $totalTours,
            'page'               => $page,
            'totalPages'         => $totalPages,
            'miceDelegationSlug' => $slug,
            'region'             => $slug,
            'flash'              => $this->getFlash(),
            'user'               => $this->getCurrentUser(),
        ]);
    }
}
