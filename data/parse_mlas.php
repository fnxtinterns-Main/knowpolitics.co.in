<?php
// data/parse_mlas.php - Parse downloaded raw HTML into clean JSON

// 1. Parse Bihar
$bihar_html = file_get_contents(__DIR__ . '/bihar_raw.html');
$bihar_mlas = [];

if (preg_match('/<table[^>]*id=["\']example["\'][^>]*>(.*?)<\/table>/is', $bihar_html, $tbl)) {
    preg_match_all('/<tr[^>]*>(.*?)<\/tr>/is', $tbl[1], $rows);
    echo "Bihar row count: " . count($rows[0]) . "\n";
    
    // First row is header
    echo "Header: " . trim(preg_replace('/\s+/', ' ', strip_tags($rows[0][0]))) . "\n";
    
    for ($i = 1; $i < count($rows[0]); $i++) {
        preg_match_all('/<td[^>]*>(.*?)<\/td>/is', $rows[0][$i], $cells);
        if (count($cells[1]) >= 4) {
            $sl = trim(strip_tags($cells[1][0]));
            $constituency_raw = trim(strip_tags($cells[1][1]));
            $mla_raw = trim(strip_tags($cells[1][2]));
            $party_raw = trim(strip_tags($cells[1][3]));
            $contact = isset($cells[1][4]) ? trim(strip_tags($cells[1][4])) : '';
            
            // Extract constituency number and name
            // Often format: "1 - Valmiki Nagar" or "1 - वाल्मीकिनगर"
            $parts = explode('-', $constituency_raw, 2);
            $c_no = trim($parts[0] ?? $sl);
            $c_name = trim($parts[1] ?? $constituency_raw);

            // Extract profile image if any
            $img = '';
            if (preg_match('/<img[^>]+src=["\']([^"\']+)["\']/i', $rows[0][$i], $img_m)) {
                $img = $img_m[1];
                if (!str_starts_with($img, 'http')) {
                    $img = 'https://vidhansabha.bihar.gov.in/' . ltrim($img, '/');
                }
            }

            $bihar_mlas[] = [
                'sl_no' => (int)$sl,
                'constituency_no' => (int)$c_no,
                'constituency' => $c_name ?: $constituency_raw,
                'name' => $mla_raw,
                'party' => $party_raw,
                'contact' => $contact,
                'state' => 'Bihar',
                'image' => $img
            ];
        }
    }
}

echo "Parsed " . count($bihar_mlas) . " Bihar MLAs\n";
file_put_contents(__DIR__ . '/mlas_bihar.json', json_encode($bihar_mlas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

// 2. Parse Jharkhand
$jh_html = file_get_contents(__DIR__ . '/jharkhand_raw.html');
$jh_mlas = [];

if (preg_match_all('/<table[^>]*>(.*?)<\/table>/is', $jh_html, $tables)) {
    // Table 1 is usually the members table
    $tbl = $tables[0][1] ?? $tables[0][0];
    preg_match_all('/<tr[^>]*>(.*?)<\/tr>/is', $tbl, $rows);
    echo "Jharkhand row count: " . count($rows[0]) . "\n";
    echo "Jharkhand Header: " . trim(preg_replace('/\s+/', ' ', strip_tags($rows[0][0]))) . "\n";

    for ($i = 1; $i < count($rows[0]); $i++) {
        preg_match_all('/<td[^>]*>(.*?)<\/td>/is', $rows[0][$i], $cells);
        if (count($cells[1]) >= 3) {
            $c_no = trim(strip_tags($cells[1][0]));
            $c_name = trim(strip_tags($cells[1][1]));
            $mla_name = trim(strip_tags($cells[1][2]));
            $party = isset($cells[1][3]) ? trim(strip_tags($cells[1][3])) : '';
            $contact = isset($cells[1][4]) ? trim(strip_tags($cells[1][4])) : (isset($cells[1][3]) && is_numeric(preg_replace('/[^0-9]/', '', $cells[1][3])) ? trim(strip_tags($cells[1][3])) : '');

            $jh_mlas[] = [
                'sl_no' => $i,
                'constituency_no' => (int)$c_no,
                'constituency' => $c_name,
                'name' => $mla_name,
                'party' => $party,
                'contact' => $contact,
                'state' => 'Jharkhand'
            ];
        }
    }
}

echo "Parsed " . count($jh_mlas) . " Jharkhand MLAs\n";
file_put_contents(__DIR__ . '/mlas_jharkhand.json', json_encode($jh_mlas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

// 3. Update data/constituencies.json with the full list from both states
$all_constituencies = [
    'bihar' => array_map(function($m) {
        return [
            'id' => 'bihar-' . $m['constituency_no'],
            'no' => $m['constituency_no'],
            'name_hi' => $m['constituency'],
            'name_en' => $m['constituency'],
            'mla' => $m['name'],
            'party' => $m['party'],
            'type' => 'Vidhan Sabha'
        ];
    }, $bihar_mlas),
    'jharkhand' => array_map(function($m) {
        return [
            'id' => 'jharkhand-' . $m['constituency_no'],
            'no' => $m['constituency_no'],
            'name_hi' => $m['constituency'],
            'name_en' => $m['constituency'],
            'mla' => $m['name'],
            'party' => $m['party'],
            'type' => 'Vidhan Sabha'
        ];
    }, $jh_mlas),
];

file_put_contents(__DIR__ . '/constituencies.json', json_encode($all_constituencies, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "Successfully updated data/constituencies.json with " . count($all_constituencies['bihar']) . " Bihar and " . count($all_constituencies['jharkhand']) . " Jharkhand constituencies!\n";
