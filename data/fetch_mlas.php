<?php
// data/fetch_mlas.php
$ctx = stream_context_create([
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
    ],
    'http' => [
        'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)\r\nAccept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\r\n",
        'timeout' => 20,
    ]
]);

echo "--- FETCHING BIHAR ---\n";
$bihar_url = "https://vidhansabha.bihar.gov.in/Knowyourmla.html";
$bihar_html = @file_get_contents($bihar_url, false, $ctx);
if ($bihar_html === false) {
    echo "Bihar fetch failed!\n";
} else {
    echo "Bihar HTML size: " . strlen($bihar_html) . " bytes\n";
    file_put_contents(__DIR__ . '/bihar_raw.html', $bihar_html);
    if (preg_match('/<table[^>]*id=["\']example["\'][^>]*>(.*?)<\/table>/is', $bihar_html, $m)) {
        echo "Found #example table! Length: " . strlen($m[0]) . "\n";
        // Count rows
        preg_match_all('/<tr[^>]*>(.*?)<\/tr>/is', $m[1], $rows);
        echo "Bihar table rows: " . count($rows[0]) . "\n";
    }
}

echo "\n--- FETCHING JHARKHAND ---\n";
$jh_url = "https://vidhansabha.jharkhand.gov.in/%E0%A4%AE%E0%A4%BE%E0%A4%A8%E0%A4%A8%E0%A5%80%E0%A4%AF-%E0%A4%B8%E0%A4%A6%E0%A4%B8%E0%A5%8D%E0%A4%AF%E0%A5%8B%E0%A4%82-%E0%A4%95%E0%A5%87-%E0%A4%A8%E0%A4%BE%E0%A4%AE-%E0%A4%95%E0%A5%8D%E0%A4%B7%E0%A5%87%E0%A4%A4%E0%A5%8D%E0%A4%B0-%E0%A4%B8%E0%A4%820-%E0%A4%8F%E0%A4%B5%E0%A4%82-%E0%A4%B8%E0%A4%82%E0%A4%AA%E0%A4%B0%E0%A5%8D%E0%A4%95";
$jh_html = @file_get_contents($jh_url, false, $ctx);
if ($jh_html === false) {
    echo "Jharkhand fetch failed!\n";
} else {
    echo "Jharkhand HTML size: " . strlen($jh_html) . " bytes\n";
    file_put_contents(__DIR__ . '/jharkhand_raw.html', $jh_html);
    preg_match_all('/<table[^>]*>(.*?)<\/table>/is', $jh_html, $tables);
    echo "Jharkhand tables found: " . count($tables[0]) . "\n";
    if (!empty($tables[0])) {
        foreach ($tables[0] as $i => $tbl) {
            preg_match_all('/<tr[^>]*>(.*?)<\/tr>/is', $tbl, $rows);
            echo "  Table $i rows: " . count($rows[0]) . " length: " . strlen($tbl) . "\n";
        }
    }
}
