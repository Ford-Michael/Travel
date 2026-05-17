<?php
// ─── GEMINI API TEST v2 ──────────────────────────────────────
// Truy cập: http://localhost/travel.bling/test_gemini.php
// XÓA FILE NÀY SAU KHI TEST XONG!

$apiKey = 'AIzaSyCz1YwYcBzOByeOR21HsqDMJ5efEgxb_Nk';
$url    = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key={$apiKey}";

$payload = json_encode([
    'system_instruction' => [
        'parts' => [['text' => 'Bạn là trợ lý AI của Travel Bling. Trả lời mọi câu hỏi.']]
    ],
    'contents' => [
        ['role' => 'user', 'parts' => [['text' => '1+1 bằng mấy?']]]
    ],
], JSON_UNESCAPED_UNICODE);

// Tìm file cacert.pem của XAMPP
$cacertPaths = [
    'C:/xampp/php/extras/ssl/cacert.pem',
    'C:/xampp/apache/conf/ssl.crt/server.crt',
    'C:/xampp/php/cacert.pem',
    ini_get('curl.cainfo'),
    ini_get('openssl.cafile'),
];
$caCert = '';
foreach ($cacertPaths as $p) {
    if ($p && file_exists($p)) { $caCert = $p; break; }
}

$ch = curl_init($url);
$opts = [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => $payload,
    CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
    CURLOPT_TIMEOUT        => 25,
    CURLOPT_CONNECTTIMEOUT => 10,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_FOLLOWLOCATION => true,
];
if ($caCert) $opts[CURLOPT_CAINFO] = $caCert;

curl_setopt_array($ch, $opts);
$response  = curl_exec($ch);
$curlErrno = curl_errno($ch);
$curlError = curl_error($ch);
$httpCode  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo '<!DOCTYPE html><html><head><meta charset="utf-8">
<style>body{font-family:monospace;padding:24px;background:#111;color:#eee;font-size:14px;line-height:1.8}
.ok{color:#4ade80}.err{color:#f87171}.warn{color:#fb923c}.box{background:#1e1e1e;padding:16px;border-radius:8px;margin:12px 0;white-space:pre-wrap;word-break:break-all}</style>
</head><body>';

echo "<h2>🔍 GEMINI API DIAGNOSTICS</h2>";

// PHP & cURL info
echo "<div class='box'>";
echo "PHP Version     : " . phpversion() . "\n";
echo "cURL Enabled    : " . (function_exists('curl_init') ? "<span class='ok'>✅ YES</span>" : "<span class='err'>❌ NO – Mở php.ini, bỏ ; trước extension=curl</span>") . "\n";
echo "cURL Version    : " . (curl_version()['version'] ?? 'n/a') . "\n";
echo "OpenSSL         : " . (curl_version()['ssl_version'] ?? 'n/a') . "\n";
echo "cacert.pem      : " . ($caCert ?: "<span class='warn'>⚠️ Không tìm thấy – Tải tại https://curl.se/ca/cacert.pem → lưu vào C:/xampp/php/cacert.pem</span>") . "\n";
echo "curl.cainfo     : " . (ini_get('curl.cainfo') ?: '(chưa cấu hình)') . "\n";
echo "</div>";

echo "<div class='box'>";
echo "HTTP Status     : {$httpCode}\n";
echo "cURL Error No   : {$curlErrno}\n";
echo "cURL Error Msg  : " . ($curlError ? "<span class='err'>{$curlError}</span>" : "<span class='ok'>(none)</span>") . "\n";
echo "</div>";

if ($response) {
    $data = json_decode($response, true);
    $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;
    $err  = $data['error']['message'] ?? null;

    echo "<div class='box'>";
    if ($text) {
        echo "<span class='ok'>✅ THÀNH CÔNG! Gemini trả lời:\n   → " . htmlspecialchars($text) . "</span>\n";
    } elseif ($err) {
        echo "<span class='err'>❌ API ERROR: " . htmlspecialchars($err) . "</span>\n\n";
        echo "Full API Response:\n" . htmlspecialchars(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    } else {
        echo "<span class='warn'>⚠️ Response không parse được:</span>\n";
        echo htmlspecialchars($response);
    }
    echo "</div>";
} else {
    echo "<div class='box'>";
    echo "<span class='err'>❌ Không nhận được response nào từ server (cURL failed hoàn toàn)</span>\n\n";
    echo "→ Kiểm tra XAMPP có kết nối internet không bằng cách ping google.com\n";
    echo "→ Thử tắt antivirus/firewall tạm thời\n";
    echo "</div>";
}

echo "</body></html>";
