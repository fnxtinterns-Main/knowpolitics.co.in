<?php
// includes/db.php - MySQL Database Connection & Fallback Handler

define('DB_HOST', getenv('DB_HOST') ?: 'srv921.hstgr.io');
define('DB_PORT', getenv('DB_PORT') ?: '3306');
define('DB_NAME', getenv('DB_NAME') ?: 'u369924234_knowpolitics');
define('DB_USER', getenv('DB_USER') ?: 'u369924234_knowpolitics');
define('DB_PASS', getenv('DB_PASS') ?: 'Knowpolitics@99');

function get_db_connection() {
    static $pdo = null;
    static $attempted = false;

    if ($attempted) {
        return $pdo;
    }
    $attempted = true;

    // Credentials sets: Hostinger production credentials, and local development fallback
    $credential_sets = [
        ['host' => DB_HOST, 'user' => DB_USER, 'pass' => DB_PASS],
        ['host' => 'localhost', 'user' => DB_USER, 'pass' => DB_PASS],
        ['host' => '127.0.0.1', 'user' => 'root', 'pass' => ''],
    ];

    foreach ($credential_sets as $cred) {
        try {
            $dsn = "mysql:host=" . $cred['host'] . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_TIMEOUT => 2,
            ];
            $pdo = new PDO($dsn, $cred['user'], $cred['pass'], $options);
            return $pdo;
        } catch (PDOException $e) {
            $pdo = null;
        }
    }

    return null;
}

/**
 * Fetch MLAs with optional filters (from MySQL if active, otherwise JSON)
 */
function get_mlas($state_filter = 'all', $search_query = '') {
    $pdo = get_db_connection();

    if ($pdo !== null) {
        try {
            $sql = "SELECT * FROM `mlas` WHERE 1=1";
            $params = [];

            if ($state_filter !== 'all') {
                $sql .= " AND (LOWER(`state`) = :st OR LOWER(REPLACE(`state`, ' ', '-')) = :st)";
                $params[':st'] = strtolower(trim($state_filter));
            }

            if ($search_query !== '') {
                $sql .= " AND (`name` LIKE :q OR `constituency` LIKE :q OR `party` LIKE :q)";
                $params[':q'] = '%' . $search_query . '%';
            }

            $sql .= " ORDER BY `state` ASC, `constituency_no` ASC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            return [
                'source' => 'MySQL Database',
                'data' => $stmt->fetchAll()
            ];
        } catch (PDOException $e) {
            // Fallback
        }
    }

    $json_file = dirname(__DIR__) . '/data/mlas_all.json';
    $all = file_exists($json_file) ? json_decode(file_get_contents($json_file), true) : [];

    $filtered = array_filter($all, function($m) use ($state_filter, $search_query) {
        if ($state_filter !== 'all') {
            $sf = strtolower(trim($state_filter));
            $ms = strtolower($m['state'] ?? '');
            $ms_slug = strtolower(str_replace(' ', '-', $m['state'] ?? ''));
            if ($ms !== $sf && $ms_slug !== $sf) return false;
        }

        if ($search_query !== '') {
            $q = mb_strtolower($search_query);
            $name_m = mb_strpos(mb_strtolower($m['name'] ?? ''), $q) !== false;
            $const_m = mb_strpos(mb_strtolower($m['constituency'] ?? ''), $q) !== false;
            $party_m = mb_strpos(mb_strtolower($m['party'] ?? ''), $q) !== false;
            return $name_m || $const_m || $party_m;
        }

        return true;
    });

    return [
        'source' => 'JSON Seed Cache',
        'data' => array_values($filtered)
    ];
}

/**
 * Fetch MPs with optional filters (from MySQL if active, otherwise JSON)
 */
function get_mps($state_filter = 'all', $search_query = '') {
    $pdo = get_db_connection();

    if ($pdo !== null) {
        try {
            $sql = "SELECT * FROM `mps` WHERE 1=1";
            $params = [];

            if ($state_filter !== 'all') {
                $sql .= " AND (LOWER(`state`) = :st OR LOWER(REPLACE(`state`, ' ', '-')) = :st)";
                $params[':st'] = strtolower($state_filter);
            }

            if ($search_query !== '') {
                $sql .= " AND (`name` LIKE :q OR `constituency` LIKE :q OR `constituency_en` LIKE :q OR `party` LIKE :q)";
                $params[':q'] = '%' . $search_query . '%';
            }

            $sql .= " ORDER BY `state` ASC, `constituency_no` ASC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            return [
                'source' => 'MySQL Database',
                'data' => $stmt->fetchAll()
            ];
        } catch (PDOException $e) {
            // Fallback
        }
    }

    $json_file = dirname(__DIR__) . '/data/mps_all_india.json';
    if (!file_exists($json_file)) {
        $json_file = dirname(__DIR__) . '/data/mps_all.json';
    }
    $all = file_exists($json_file) ? json_decode(file_get_contents($json_file), true) : [];

    $filtered = array_filter($all, function($m) use ($state_filter, $search_query) {
        if ($state_filter !== 'all') {
            $sf = strtolower($state_filter);
            $ms = strtolower($m['state']);
            $ms_slug = strtolower(str_replace(' ', '-', $m['state']));
            if ($ms !== $sf && $ms_slug !== $sf) return false;
        }

        if ($search_query !== '') {
            $q = mb_strtolower($search_query);
            $name_m = mb_strpos(mb_strtolower($m['name']), $q) !== false;
            $const_m = mb_strpos(mb_strtolower($m['constituency']), $q) !== false;
            $const_en_m = mb_strpos(mb_strtolower($m['constituency_en'] ?? ''), $q) !== false;
            $party_m = mb_strpos(mb_strtolower($m['party'] ?? ''), $q) !== false;
            return $name_m || $const_m || $const_en_m || $party_m;
        }

        return true;
    });

    return [
        'source' => 'JSON Seed Cache',
        'data' => array_values($filtered)
    ];
}
