<?php
// data/export_to_sql_csv.php - Generates MySQL schema, dump, and CSV for all 325 MLAs

$bihar = json_decode(file_get_contents(__DIR__ . '/mlas_bihar.json'), true);
$jharkhand = json_decode(file_get_contents(__DIR__ . '/mlas_jharkhand.json'), true);
$all_mlas = array_merge($bihar, $jharkhand);

// Ensure database directory exists
$db_dir = dirname(__DIR__) . '/database';
if (!is_dir($db_dir)) {
    mkdir($db_dir, 0777, true);
}

// 1. Generate MySQL DDL + DML SQL Dump
$sql = "-- ============================================================\n";
$sql .= "-- KnowPolitics.co.in - Complete Official MLA Database Dump\n";
$sql .= "-- States: Bihar (243) & Jharkhand (82) | Total: 325 MLAs\n";
$sql .= "-- Sourced from: vidhansabha.bihar.gov.in & vidhansabha.jharkhand.gov.in\n";
$sql .= "-- Generated at: " . date('Y-m-d H:i:s') . "\n";
$sql .= "-- ============================================================\n\n";

$sql .= "CREATE DATABASE IF NOT EXISTS `knowpolitics` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;\n";
$sql .= "USE `knowpolitics`;\n\n";

$sql .= "DROP TABLE IF EXISTS `mlas`;\n";
$sql .= "CREATE TABLE `mlas` (\n";
$sql .= "  `id` INT AUTO_INCREMENT PRIMARY KEY,\n";
$sql .= "  `state` VARCHAR(50) NOT NULL,\n";
$sql .= "  `constituency_no` INT NOT NULL,\n";
$sql .= "  `constituency` VARCHAR(150) NOT NULL,\n";
$sql .= "  `name` VARCHAR(150) NOT NULL,\n";
$sql .= "  `party` VARCHAR(100) DEFAULT NULL,\n";
$sql .= "  `contact` VARCHAR(50) DEFAULT NULL,\n";
$sql .= "  `image` VARCHAR(255) DEFAULT NULL,\n";
$sql .= "  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,\n";
$sql .= "  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,\n";
$sql .= "  INDEX `idx_state` (`state`),\n";
$sql .= "  INDEX `idx_constituency_no` (`constituency_no`),\n";
$sql .= "  INDEX `idx_party` (`party`),\n";
$sql .= "  INDEX `idx_name` (`name`)\n";
$sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;\n\n";

$sql .= "-- Inserting all 325 Official Elected Representatives --\n";
$sql .= "INSERT INTO `mlas` (`state`, `constituency_no`, `constituency`, `name`, `party`, `contact`, `image`) VALUES\n";

$rows = [];
foreach ($all_mlas as $m) {
    $state = addslashes($m['state']);
    $c_no = (int)$m['constituency_no'];
    $const = addslashes($m['constituency']);
    $name = addslashes($m['name']);
    $party = !empty($m['party']) ? "'" . addslashes($m['party']) . "'" : "NULL";
    $contact = !empty($m['contact']) ? "'" . addslashes($m['contact']) . "'" : "NULL";
    $img = !empty($m['image']) ? "'" . addslashes($m['image']) . "'" : "NULL";

    $rows[] = "('$state', $c_no, '$const', '$name', $party, $contact, $img)";
}

$sql .= implode(",\n", $rows) . ";\n";

file_put_contents($db_dir . '/knowpolitics_mlas.sql', $sql);
echo "Generated database/knowpolitics_mlas.sql (" . strlen($sql) . " bytes)\n";

// 2. Generate CSV Export
$csv_file = __DIR__ . '/mlas_all.csv';
$fp = fopen($csv_file, 'w');
// Write UTF-8 BOM so Excel opens Hindi/Devanagari text cleanly
fputs($fp, "\xEF\xBB\xBF");
fputcsv($fp, ['ID', 'State', 'Constituency_No', 'Constituency', 'MLA_Name', 'Party', 'Contact', 'Photo_URL']);

$id = 1;
foreach ($all_mlas as $m) {
    fputcsv($fp, [
        $id++,
        $m['state'],
        $m['constituency_no'],
        $m['constituency'],
        $m['name'],
        $m['party'] ?? '',
        $m['contact'] ?? '',
        $m['image'] ?? ''
    ]);
}
fclose($fp);
echo "Generated data/mlas_all.csv\n";

// 3. Combined JSON for sharing
file_put_contents(__DIR__ . '/mlas_all.json', json_encode($all_mlas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "Generated data/mlas_all.json\n";
