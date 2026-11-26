<?php
// database/migrate_remote.php - Remote MySQL Migration for Hostinger Database

require_once dirname(__DIR__) . '/config.php';
require_once dirname(__DIR__) . '/includes/db.php';

$host = DB_HOST;
$port = DB_PORT;
$dbname = DB_NAME;
$user = DB_USER;
$pass = DB_PASS;

echo "Connecting to MySQL server at {$host}:{$port} [Database: {$dbname}]...\n";

$pdo = null;
$candidate_hosts = array_unique([$host, 'srv921.hstgr.io', '82.25.121.173', 'localhost', '127.0.0.1']);

foreach ($candidate_hosts as $h) {
    try {
        $dsn = "mysql:host={$h};port={$port};dbname={$dbname};charset=utf8mb4";
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_TIMEOUT => 6,
        ]);
        echo "CONNECTED SUCCESSFULLY to {$h}!\n\n";
        break;
    } catch (PDOException $e) {
        $last_error = $e->getMessage();
    }
}

if (!$pdo) {
    echo "============================================================\n";
    echo "CONNECTION FAILED: {$last_error}\n";
    echo "============================================================\n";
    echo "NOTE FOR HOSTINGER REMOTE ACCESS:\n";
    echo "Hostinger MySQL user '{$user}' by default only allows 'localhost'.\n";
    echo "To allow migration directly from this machine:\n";
    echo "1. Log in to Hostinger hPanel -> Databases -> Remote MySQL.\n";
    echo "2. Select Database: {$dbname}\n";
    echo "3. In 'IP (IPv4 or IPv6)', enter % (or your current IP) and click Create.\n";
    echo "4. Re-run: php database/migrate_remote.php\n\n";
    echo "ALTERNATIVE (INSTANT 1-CLICK):\n";
    echo "- When deployed on Hostinger, visit: https://yourdomain.com/database/import.php\n";
    echo "  (It connects via 'localhost' on the server and imports all 325 MLAs & 543 MPs instantly!)\n";
    echo "- Or in Hostinger hPanel -> phpMyAdmin -> Import:\n";
    echo "  Upload 'database/u369924234_knowpolitics.sql'\n";
    echo "============================================================\n";
    exit(1);
}

// 1. Create MLAs table
echo "1. Creating `mlas` table...\n";
$pdo->exec("DROP TABLE IF EXISTS `mlas`");
$pdo->exec("
CREATE TABLE `mlas` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `state` VARCHAR(50) NOT NULL,
  `constituency_no` INT NOT NULL,
  `constituency` VARCHAR(150) NOT NULL,
  `name` VARCHAR(150) NOT NULL,
  `party` VARCHAR(100) DEFAULT NULL,
  `contact` VARCHAR(50) DEFAULT NULL,
  `image` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_state` (`state`),
  INDEX `idx_constituency_no` (`constituency_no`),
  INDEX `idx_party` (`party`),
  INDEX `idx_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
");
echo "   `mlas` table created.\n";

$mlas = json_decode(file_get_contents(dirname(__DIR__) . '/data/mlas_all.json'), true);
echo "   Inserting " . count($mlas) . " MLAs...\n";

$pdo->beginTransaction();
$stmtMLA = $pdo->prepare("
    INSERT INTO `mlas` (`state`, `constituency_no`, `constituency`, `name`, `party`, `contact`, `image`) 
    VALUES (:state, :constituency_no, :constituency, :name, :party, :contact, :image)
");

foreach ($mlas as $m) {
    $stmtMLA->execute([
        ':state' => $m['state'] ?? 'Bihar',
        ':constituency_no' => (int)($m['constituency_no'] ?? 0),
        ':constituency' => $m['constituency'] ?? '',
        ':name' => $m['name'] ?? '',
        ':party' => $m['party'] ?? '',
        ':contact' => $m['contact'] ?? '',
        ':image' => $m['image'] ?? ''
    ]);
}
$pdo->commit();
echo "   Successfully inserted " . count($mlas) . " MLAs.\n\n";

// 2. Create MPs table
echo "2. Creating `mps` table...\n";
$pdo->exec("DROP TABLE IF EXISTS `mps`");
$pdo->exec("
CREATE TABLE `mps` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `state` VARCHAR(50) NOT NULL,
  `constituency_no` INT DEFAULT NULL,
  `constituency` VARCHAR(150) NOT NULL,
  `constituency_en` VARCHAR(150) DEFAULT NULL,
  `name` VARCHAR(150) NOT NULL,
  `party` VARCHAR(100) DEFAULT NULL,
  `gender` VARCHAR(20) DEFAULT NULL,
  `education` VARCHAR(150) DEFAULT NULL,
  `age` INT DEFAULT NULL,
  `debates` INT DEFAULT NULL,
  `questions` INT DEFAULT NULL,
  `bills` INT DEFAULT NULL,
  `attendance` VARCHAR(20) DEFAULT NULL,
  `image` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_state` (`state`),
  INDEX `idx_constituency` (`constituency`),
  INDEX `idx_name` (`name`),
  INDEX `idx_party` (`party`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
");
echo "   `mps` table created.\n";

$mps_file = dirname(__DIR__) . '/data/mps_all_india.json';
if (!file_exists($mps_file)) {
    $mps_file = dirname(__DIR__) . '/data/mps_all.json';
}
$mps = json_decode(file_get_contents($mps_file), true);
echo "   Inserting " . count($mps) . " MPs...\n";

$pdo->beginTransaction();
$stmtMP = $pdo->prepare("
    INSERT INTO `mps` (`state`, `constituency_no`, `constituency`, `constituency_en`, `name`, `party`, `gender`, `education`, `age`, `debates`, `questions`, `bills`, `attendance`, `image`) 
    VALUES (:state, :constituency_no, :constituency, :constituency_en, :name, :party, :gender, :education, :age, :debates, :questions, :bills, :attendance, :image)
");

foreach ($mps as $p) {
    $stmtMP->execute([
        ':state' => $p['state'] ?? '',
        ':constituency_no' => isset($p['constituency_no']) && $p['constituency_no'] !== null ? (int)$p['constituency_no'] : null,
        ':constituency' => $p['constituency'] ?? '',
        ':constituency_en' => $p['constituency_en'] ?? ($p['constituency'] ?? ''),
        ':name' => $p['name'] ?? '',
        ':party' => $p['party'] ?? '',
        ':gender' => $p['gender'] ?? '',
        ':education' => $p['education'] ?? '',
        ':age' => isset($p['age']) && $p['age'] !== null ? (int)$p['age'] : null,
        ':debates' => isset($p['debates']) ? (int)$p['debates'] : null,
        ':questions' => isset($p['questions']) ? (int)$p['questions'] : null,
        ':bills' => isset($p['bills']) ? (int)$p['bills'] : null,
        ':attendance' => $p['attendance'] ?? null,
        ':image' => $p['image'] ?? ''
    ]);
}
$pdo->commit();
echo "   Successfully inserted " . count($mps) . " MPs.\n\n";

// 3. Verification Counts
$total_mlas = $pdo->query("SELECT COUNT(*) FROM `mlas`")->fetchColumn();
$total_mps = $pdo->query("SELECT COUNT(*) FROM `mps`")->fetchColumn();
$states_count = $pdo->query("SELECT COUNT(DISTINCT `state`) FROM `mps`")->fetchColumn();

echo "=== MIGRATION COMPLETED SUCCESSFULLY ===\n";
echo "Total MLAs in MySQL: {$total_mlas}\n";
echo "Total MPs in MySQL:  {$total_mps} across {$states_count} States/UTs\n";
