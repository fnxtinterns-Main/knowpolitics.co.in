<?php
// data/parse_mps_and_prs.php - Parse MPs from Bihar & Jharkhand official PDFs

// 1. Jharkhand 18th Lok Sabha MPs (Parsed from official Vidhan Sabha PDF)
$jharkhand_mps = [
    ["no" => 1, "constituency" => "कोडरमा", "constituency_en" => "Koderma", "name" => "श्रीमती अन्नपूर्णा देवी", "party" => "भारतीय जनता पार्टी (BJP)", "state" => "Jharkhand", "category" => "General"],
    ["no" => 2, "constituency" => "गिरिडीह", "constituency_en" => "Giridih", "name" => "श्री चन्द्र प्रकाश चौधरी", "party" => "एजेएसयू पार्टी (AJSU)", "state" => "Jharkhand", "category" => "General"],
    ["no" => 3, "constituency" => "धनबाद", "constituency_en" => "Dhanbad", "name" => "श्री दुलू महतो", "party" => "भारतीय जनता पार्टी (BJP)", "state" => "Jharkhand", "category" => "General"],
    ["no" => 4, "constituency" => "सिंहभूम", "constituency_en" => "Singhbhum", "name" => "श्रीमती जोबा माझी", "party" => "झारखंड मुक्ति मोर्चा (JMM)", "state" => "Jharkhand", "category" => "ST"],
    ["no" => 5, "constituency" => "खूँटी", "constituency_en" => "Khunti", "name" => "श्री काली चरण मुंडा", "party" => "भारतीय राष्ट्रीय कांग्रेस (INC)", "state" => "Jharkhand", "category" => "ST"],
    ["no" => 6, "constituency" => "चतरा", "constituency_en" => "Chatra", "name" => "श्री काली चरण सिंह", "party" => "भारतीय जनता पार्टी (BJP)", "state" => "Jharkhand", "category" => "General"],
    ["no" => 7, "constituency" => "हजारीबाग", "constituency_en" => "Hazaribagh", "name" => "श्री मनीष जायसवाल", "party" => "भारतीय जनता पार्टी (BJP)", "state" => "Jharkhand", "category" => "General"],
    ["no" => 8, "constituency" => "दुमका", "constituency_en" => "Dumka", "name" => "श्री नलिन सोरेन", "party" => "झारखंड मुक्ति मोर्चा (JMM)", "state" => "Jharkhand", "category" => "ST"],
    ["no" => 9, "constituency" => "गोड्डा", "constituency_en" => "Godda", "name" => "डॉ. निशिकान्त दुबे", "party" => "भारतीय जनता पार्टी (BJP)", "state" => "Jharkhand", "category" => "General"],
    ["no" => 10, "constituency" => "राँची", "constituency_en" => "Ranchi", "name" => "श्री संजय सेठ", "party" => "भारतीय जनता पार्टी (BJP)", "state" => "Jharkhand", "category" => "General"],
    ["no" => 11, "constituency" => "लोहरदगा", "constituency_en" => "Lohardaga", "name" => "श्री सुखदेव भगत", "party" => "भारतीय राष्ट्रीय कांग्रेस (INC)", "state" => "Jharkhand", "category" => "ST"],
    ["no" => 12, "constituency" => "जमशेदपुर", "constituency_en" => "Jamshedpur", "name" => "श्री बिद्युत बरन महतो", "party" => "भारतीय जनता पार्टी (BJP)", "state" => "Jharkhand", "category" => "General"],
    ["no" => 13, "constituency" => "राजमहल", "constituency_en" => "Rajmahal", "name" => "श्री विजय कुमार हाँसदाक", "party" => "झारखंड मुक्ति मोर्चा (JMM)", "state" => "Jharkhand", "category" => "ST"],
    ["no" => 14, "constituency" => "पलामू", "constituency_en" => "Palamu", "name" => "श्री विष्णु दयाल राम", "party" => "भारतीय जनता पार्टी (BJP)", "state" => "Jharkhand", "category" => "SC"]
];

// 2. Bihar Lok Sabha MPs (Parsed from official Vidhan Sabha PDF)
$bihar_mps = [
    ["no" => 1, "constituency" => "अररिया", "constituency_en" => "Araria", "name" => "श्री प्रदीप कुमार सिंह", "party" => "भारतीय जनता पार्टी (BJP)", "state" => "Bihar", "category" => "General"],
    ["no" => 2, "constituency" => "आरा", "constituency_en" => "Arrah", "name" => "श्री सुदामा प्रसाद", "party" => "भाकपा-माले (CPIML)", "state" => "Bihar", "category" => "General"],
    ["no" => 3, "constituency" => "औरंगाबाद", "constituency_en" => "Aurangabad", "name" => "श्री अभय कुमार सिन्हा", "party" => "राष्ट्रीय जनता दल (RJD)", "state" => "Bihar", "category" => "General"],
    ["no" => 4, "constituency" => "बांका", "constituency_en" => "Banka", "name" => "श्री गिरिधारी यादव", "party" => "जनता दल (यूनाइटेड) (JDU)", "state" => "Bihar", "category" => "General"],
    ["no" => 5, "constituency" => "बेगूसराय", "constituency_en" => "Begusarai", "name" => "श्री गिरिराज सिंह", "party" => "भारतीय जनता पार्टी (BJP)", "state" => "Bihar", "category" => "General"],
    ["no" => 6, "constituency" => "भागलपुर", "constituency_en" => "Bhagalpur", "name" => "श्री अजय कुमार मंडल", "party" => "जनता दल (यूनाइटेड) (JDU)", "state" => "Bihar", "category" => "General"],
    ["no" => 7, "constituency" => "बक्सर", "constituency_en" => "Buxar", "name" => "श्री सुधाकर सिंह", "party" => "राष्ट्रीय जनता दल (RJD)", "state" => "Bihar", "category" => "General"],
    ["no" => 8, "constituency" => "दरभंगा", "constituency_en" => "Darbhanga", "name" => "श्री गोपाल जी ठाकुर", "party" => "भारतीय जनता पार्टी (BJP)", "state" => "Bihar", "category" => "General"],
    ["no" => 9, "constituency" => "गया", "constituency_en" => "Gaya", "name" => "श्री जीतन राम माँझी", "party" => "हिंदुस्तानी अवाम मोर्चा (HAM)", "state" => "Bihar", "category" => "SC"],
    ["no" => 10, "constituency" => "गोपालगंज", "constituency_en" => "Gopalganj", "name" => "डा0 आलोक कुमार सुमन", "party" => "जनता दल (यूनाइटेड) (JDU)", "state" => "Bihar", "category" => "SC"],
    ["no" => 11, "constituency" => "हाजीपुर", "constituency_en" => "Hajipur", "name" => "श्री चिराग पासवान", "party" => "लोजपा (रामविलास) (LJPRV)", "state" => "Bihar", "category" => "SC"],
    ["no" => 12, "constituency" => "जहानाबाद", "constituency_en" => "Jehanabad", "name" => "श्री सुरेन्द्र प्रसाद यादव", "party" => "राष्ट्रीय जनता दल (RJD)", "state" => "Bihar", "category" => "General"],
    ["no" => 13, "constituency" => "जमुई", "constituency_en" => "Jamui", "name" => "श्री अरुण भारती", "party" => "लोजपा (रामविलास) (LJPRV)", "state" => "Bihar", "category" => "SC"],
    ["no" => 14, "constituency" => "झंझारपुर", "constituency_en" => "Jhanjharpur", "name" => "श्री रामप्रीत मंडल", "party" => "जनता दल (यूनाइटेड) (JDU)", "state" => "Bihar", "category" => "General"],
    ["no" => 15, "constituency" => "काराकाट", "constituency_en" => "Karakat", "name" => "श्री राजा राम सिंह", "party" => "भाकपा-माले (CPIML)", "state" => "Bihar", "category" => "General"],
    ["no" => 16, "constituency" => "कटिहार", "constituency_en" => "Katihar", "name" => "श्री तारिक अनवर", "party" => "भारतीय राष्ट्रीय कांग्रेस (INC)", "state" => "Bihar", "category" => "General"],
    ["no" => 17, "constituency" => "खगड़िया", "constituency_en" => "Khagaria", "name" => "श्री राजेश वर्मा", "party" => "लोजपा (रामविलास) (LJPRV)", "state" => "Bihar", "category" => "General"],
    ["no" => 18, "constituency" => "किशनगंज", "constituency_en" => "Kishanganj", "name" => "डा0 मोहम्मद जावेद", "party" => "भारतीय राष्ट्रीय कांग्रेस (INC)", "state" => "Bihar", "category" => "General"],
    ["no" => 19, "constituency" => "मधेपुरा", "constituency_en" => "Madhepura", "name" => "श्री दिनेश चन्द्र यादव", "party" => "जनता दल (यूनाइटेड) (JDU)", "state" => "Bihar", "category" => "General"],
    ["no" => 20, "constituency" => "मधुबनी", "constituency_en" => "Madhubani", "name" => "श्री अशोक कुमार यादव", "party" => "भारतीय जनता पार्टी (BJP)", "state" => "Bihar", "category" => "General"],
    ["no" => 21, "constituency" => "महाराजगंज", "constituency_en" => "Maharajganj", "name" => "श्री जनार्दन सिंह सिग्रीवाल", "party" => "भारतीय जनता पार्टी (BJP)", "state" => "Bihar", "category" => "General"],
    ["no" => 22, "constituency" => "मुंगेर", "constituency_en" => "Munger", "name" => "श्री राजीव रंजन सिंह (ललन सिंह)", "party" => "जनता दल (यूनाइटेड) (JDU)", "state" => "Bihar", "category" => "General"],
    ["no" => 23, "constituency" => "मुजफ्फरपुर", "constituency_en" => "Muzaffarpur", "name" => "डा0 राज भूषण चौधरी", "party" => "भारतीय जनता पार्टी (BJP)", "state" => "Bihar", "category" => "General"],
    ["no" => 24, "constituency" => "नालन्दा", "constituency_en" => "Nalanda", "name" => "श्री कौशलेन्द्र कुमार", "party" => "जनता दल (यूनाइटेड) (JDU)", "state" => "Bihar", "category" => "General"],
    ["no" => 25, "constituency" => "नवादा", "constituency_en" => "Nawada", "name" => "श्री विवेक ठाकुर", "party" => "भारतीय जनता पार्टी (BJP)", "state" => "Bihar", "category" => "General"],
    ["no" => 26, "constituency" => "पश्चिम चम्पारण", "constituency_en" => "Paschim Champaran", "name" => "डा0 संजय जायसवाल", "party" => "भारतीय जनता पार्टी (BJP)", "state" => "Bihar", "category" => "General"],
    ["no" => 27, "constituency" => "पाटलीपुत्र", "constituency_en" => "Pataliputra", "name" => "श्रीमती मीसा भारती", "party" => "राष्ट्रीय जनता दल (RJD)", "state" => "Bihar", "category" => "General"],
    ["no" => 28, "constituency" => "पटना साहिब", "constituency_en" => "Patna Sahib", "name" => "श्री रवि शंकर प्रसाद", "party" => "भारतीय जनता पार्टी (BJP)", "state" => "Bihar", "category" => "General"],
    ["no" => 29, "constituency" => "पूर्णियां", "constituency_en" => "Purnia", "name" => "श्री राजेश रंजन (पप्पू यादव)", "party" => "निर्दलीय (IND)", "state" => "Bihar", "category" => "General"],
    ["no" => 30, "constituency" => "पूर्वी चम्पारण", "constituency_en" => "Purvi Champaran", "name" => "श्री राधामोहन सिंह", "party" => "भारतीय जनता पार्टी (BJP)", "state" => "Bihar", "category" => "General"],
    ["no" => 31, "constituency" => "समस्तीपुर", "constituency_en" => "Samastipur", "name" => "श्रीमती शाम्भवी", "party" => "लोजपा (रामविलास) (LJPRV)", "state" => "Bihar", "category" => "SC"],
    ["no" => 32, "constituency" => "सारण", "constituency_en" => "Saran", "name" => "श्री राजीव प्रताप रूडी", "party" => "भारतीय जनता पार्टी (BJP)", "state" => "Bihar", "category" => "General"],
    ["no" => 33, "constituency" => "सासाराम", "constituency_en" => "Sasaram", "name" => "श्री मनोज कुमार", "party" => "भारतीय राष्ट्रीय कांग्रेस (INC)", "state" => "Bihar", "category" => "SC"],
    ["no" => 34, "constituency" => "शिवहर", "constituency_en" => "Sheohar", "name" => "श्रीमती लवली आनंद", "party" => "जनता दल (यूनाइटेड) (JDU)", "state" => "Bihar", "category" => "General"],
    ["no" => 35, "constituency" => "सीतामढ़ी", "constituency_en" => "Sitamarhi", "name" => "श्री देवेश चन्द्र ठाकुर", "party" => "जनता दल (यूनाइटेड) (JDU)", "state" => "Bihar", "category" => "General"],
    ["no" => 36, "constituency" => "सीवान", "constituency_en" => "Siwan", "name" => "श्रीमती विजयलक्ष्मी देवी", "party" => "जनता दल (यूनाइटेड) (JDU)", "state" => "Bihar", "category" => "General"],
    ["no" => 37, "constituency" => "सुपौल", "constituency_en" => "Supaul", "name" => "श्री दिलेश्वर कामत", "party" => "जनता दल (यूनाइटेड) (JDU)", "state" => "Bihar", "category" => "General"],
    ["no" => 38, "constituency" => "उजियारपुर", "constituency_en" => "Ujiarpur", "name" => "श्री नित्यानंद राय", "party" => "भारतीय जनता पार्टी (BJP)", "state" => "Bihar", "category" => "General"],
    ["no" => 39, "constituency" => "वैशाली", "constituency_en" => "Vaishali", "name" => "श्रीमती वीणा देवी", "party" => "लोजपा (रामविलास) (LJPRV)", "state" => "Bihar", "category" => "General"],
    ["no" => 40, "constituency" => "वाल्मीकि नगर", "constituency_en" => "Valmiki Nagar", "name" => "श्री सुनील कुमार", "party" => "जनता दल (यूनाइटेड) (JDU)", "state" => "Bihar", "category" => "General"]
];

$all_mps = array_merge($bihar_mps, $jharkhand_mps);

file_put_contents(__DIR__ . '/mps_all.json', json_encode($all_mps, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
file_put_contents(__DIR__ . '/mps_bihar.json', json_encode($bihar_mps, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
file_put_contents(__DIR__ . '/mps_jharkhand.json', json_encode($jharkhand_mps, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo "Saved 54 Lok Sabha MPs (" . count($bihar_mps) . " Bihar + " . count($jharkhand_mps) . " Jharkhand)\n";

// Generate MySQL DDL + DML for MPs
$db_dir = dirname(__DIR__) . '/database';
$mp_sql = "-- KnowPolitics.co.in - Complete Official 18th Lok Sabha MPs Database Dump\n";
$mp_sql .= "USE `knowpolitics`;\n\n";
$mp_sql .= "DROP TABLE IF EXISTS `mps`;\n";
$mp_sql .= "CREATE TABLE `mps` (\n";
$mp_sql .= "  `id` INT AUTO_INCREMENT PRIMARY KEY,\n";
$mp_sql .= "  `state` VARCHAR(50) NOT NULL,\n";
$mp_sql .= "  `constituency_no` INT NOT NULL,\n";
$mp_sql .= "  `constituency` VARCHAR(150) NOT NULL,\n";
$mp_sql .= "  `constituency_en` VARCHAR(150) NOT NULL,\n";
$mp_sql .= "  `name` VARCHAR(150) NOT NULL,\n";
$mp_sql .= "  `party` VARCHAR(100) DEFAULT NULL,\n";
$mp_sql .= "  `category` VARCHAR(50) DEFAULT 'General',\n";
$mp_sql .= "  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,\n";
$mp_sql .= "  INDEX `idx_mp_state` (`state`),\n";
$mp_sql .= "  INDEX `idx_mp_constituency` (`constituency`),\n";
$mp_sql .= "  INDEX `idx_mp_party` (`party`),\n";
$mp_sql .= "  INDEX `idx_mp_name` (`name`)\n";
$mp_sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;\n\n";

$mp_sql .= "INSERT INTO `mps` (`state`, `constituency_no`, `constituency`, `constituency_en`, `name`, `party`, `category`) VALUES\n";
$mp_rows = [];
foreach ($all_mps as $m) {
    $state = addslashes($m['state']);
    $no = (int)$m['no'];
    $c = addslashes($m['constituency']);
    $ce = addslashes($m['constituency_en']);
    $name = addslashes($m['name']);
    $party = addslashes($m['party']);
    $cat = addslashes($m['category']);
    $mp_rows[] = "('$state', $no, '$c', '$ce', '$name', '$party', '$cat')";
}
$mp_sql .= implode(",\n", $mp_rows) . ";\n";

file_put_contents($db_dir . '/knowpolitics_mps.sql', $mp_sql);
echo "Generated database/knowpolitics_mps.sql\n";

// Generate CSV for MPs
$csv_fp = fopen(__DIR__ . '/mps_all.csv', 'w');
fputs($csv_fp, "\xEF\xBB\xBF");
fputcsv($csv_fp, ['ID', 'State', 'Constituency_No', 'Constituency_Hindi', 'Constituency_English', 'MP_Name', 'Party', 'Category']);
$id = 1;
foreach ($all_mps as $m) {
    fputcsv($csv_fp, [$id++, $m['state'], $m['no'], $m['constituency'], $m['constituency_en'], $m['name'], $m['party'], $m['category']]);
}
fclose($csv_fp);
echo "Generated data/mps_all.csv\n";
