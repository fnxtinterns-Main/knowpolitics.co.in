<?php
// data/update_mp_photos.php
$jh_mps = json_decode(file_get_contents(__DIR__ . '/mps_jharkhand.json'), true);
foreach ($jh_mps as $i => &$m) {
    $img_no = $i + 1;
    $m['image'] = "assets/images/mps/jharkhand_mp_{$img_no}.jpg";
}
unset($m);
file_put_contents(__DIR__ . '/mps_jharkhand.json', json_encode($jh_mps, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

$br_mps = json_decode(file_get_contents(__DIR__ . '/mps_bihar.json'), true);
// Common Bihar prominent MPs image fallbacks/avatars
foreach ($br_mps as &$m) {
    $m['image'] = ''; // Will display styled avatar or fetched photo
}
unset($m);
file_put_contents(__DIR__ . '/mps_bihar.json', json_encode($br_mps, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

$all_mps = array_merge($br_mps, $jh_mps);
file_put_contents(__DIR__ . '/mps_all.json', json_encode($all_mps, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

// Re-generate SQL and CSV
require_once __DIR__ . '/parse_mps_and_prs.php';
echo "MP photos updated successfully in JSON, SQL, and CSV!\n";
