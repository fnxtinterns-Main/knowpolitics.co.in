<?php
// data/fetch_mps_and_prs.php
$ctx = stream_context_create([
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
    ],
    'http' => [
        'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\r\nAccept: text/html,application/xhtml+xml,application/xml;q=0.9,application/pdf,*/*;q=0.8\r\n",
        'timeout' => 30,
    ]
]);

echo "1. Downloading Jharkhand 18th Lok Sabha Members PDF...\n";
$jh_pdf = @file_get_contents("https://vidhansabha.jharkhand.gov.in/sites/default/files/18th-loksabha-members-from-jharkhand.pdf", false, $ctx);
if ($jh_pdf !== false) {
    file_put_contents(__DIR__ . '/jharkhand_mps.pdf', $jh_pdf);
    echo "   -> Saved jharkhand_mps.pdf (" . strlen($jh_pdf) . " bytes)\n";
} else {
    echo "   -> Failed to download Jharkhand MP PDF\n";
}

echo "2. Downloading Bihar Members of Lok Sabha PDF...\n";
$br_pdf = @file_get_contents("https://vidhansabha.bihar.gov.in/pdf/Member%20of%20lok%20Sabha.pdf", false, $ctx);
if ($br_pdf !== false) {
    file_put_contents(__DIR__ . '/bihar_mps.pdf', $br_pdf);
    echo "   -> Saved bihar_mps.pdf (" . strlen($br_pdf) . " bytes)\n";
} else {
    echo "   -> Failed to download Bihar MP PDF\n";
}

echo "3. Fetching PRS India Jharkhand MLA Track...\n";
$prs_jh = @file_get_contents("https://prsindia.org/mlatrack?state=Jharkhand&assembly_term=&name=&education=&constituency=&party=&gender=All", false, $ctx);
if ($prs_jh !== false) {
    file_put_contents(__DIR__ . '/prs_jharkhand.html', $prs_jh);
    echo "   -> Saved prs_jharkhand.html (" . strlen($prs_jh) . " bytes)\n";
} else {
    echo "   -> Failed to download PRS Jharkhand\n";
}

echo "4. Fetching PRS India Bihar MLA Track...\n";
$prs_br = @file_get_contents("https://prsindia.org/mlatrack?state=Bihar&assembly_term=&name=&education=&constituency=&party=&gender=All", false, $ctx);
if ($prs_br !== false) {
    file_put_contents(__DIR__ . '/prs_bihar.html', $prs_br);
    echo "   -> Saved prs_bihar.html (" . strlen($prs_br) . " bytes)\n";
} else {
    echo "   -> Failed to download PRS Bihar\n";
}
