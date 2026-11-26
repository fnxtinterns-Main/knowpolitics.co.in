<?php
// database/import.php - Imports knowpolitics_mlas.sql into MySQL

require_once dirname(__DIR__) . '/config.php';
require_once dirname(__DIR__) . '/includes/db.php';

$message = '';
$status = 'info';

if (isset($_POST['import']) || php_sapi_name() === 'cli') {
    try {
        $pdo = get_db_connection();
        if (!$pdo) {
            // Attempt direct connection
            $candidate_hosts = array_unique([DB_HOST, 'localhost', 'srv921.hstgr.io', '82.25.121.173', '127.0.0.1']);
            foreach ($candidate_hosts as $h) {
                try {
                    $pdo = new PDO("mysql:host={$h};port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS, [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_TIMEOUT => 5
                    ]);
                    break;
                } catch (Exception $e) {
                    $pdo = null;
                }
            }
        }

        if (!$pdo) {
            throw new Exception("Unable to establish MySQL connection to " . DB_HOST . " or localhost. If connecting remotely, ensure your IP is allowed in Hostinger hPanel -> Remote MySQL.");
        }

        $sql_all = __DIR__ . '/u369924234_knowpolitics.sql';
        if (file_exists($sql_all)) {
            $pdo->exec(file_get_contents($sql_all));
        } else {
            $sql_mla = __DIR__ . '/knowpolitics_mlas.sql';
            $sql_mp = __DIR__ . '/knowpolitics_mps.sql';
            if (file_exists($sql_mla)) $pdo->exec(file_get_contents($sql_mla));
            if (file_exists($sql_mp)) $pdo->exec(file_get_contents($sql_mp));
        }

        // Verify counts
        $total_mlas = $pdo->query("SELECT COUNT(*) FROM `mlas`")->fetchColumn();
        $total_mps = $pdo->query("SELECT COUNT(*) FROM `mps`")->fetchColumn();

        $message = "SUCCESS! Database `" . DB_NAME . "` migrated. Total {$total_mlas} MLAs and {$total_mps} Lok Sabha MPs imported into MySQL.";
        $status = 'success';
    } catch (Exception $e) {
        $message = "MySQL Connection / Import Error: " . $e->getMessage();
        $status = 'error';
    }
}

if (php_sapi_name() === 'cli') {
    echo $message . "\n";
    exit;
}

include dirname(__DIR__) . '/includes/header.php';
?>

<main class="flex-grow bg-offwhite py-12">
    <div class="max-w-3xl mx-auto px-4">
        
        <div class="bg-white border border-slate-200 rounded-2xl p-8 shadow-sm">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-cyan-100 text-brandTeal flex items-center justify-center font-black text-xl">
                    DB
                </div>
                <div>
                    <h1 class="text-2xl font-black text-slateNavy">MySQL Database Importer</h1>
                    <p class="text-xs text-slate-500">KnowPolitics.co.in • 325 Elected Representatives (Bihar & Jharkhand)</p>
                </div>
            </div>

            <?php if (!empty($message)): ?>
                <div class="mb-6 p-4 rounded-xl text-sm font-semibold <?php echo $status === 'success' ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : 'bg-red-50 text-red-800 border border-red-200'; ?>">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <div class="space-y-4 text-sm text-slate-600 mb-8">
                <p>
                    This utility creates the database <strong><code>knowpolitics</code></strong> and the table <strong><code>mlas</code></strong>, and imports all 325 MLAs from <a href="knowpolitics_mlas.sql" download class="text-brandTeal font-bold hover:underline">knowpolitics_mlas.sql</a>.
                </p>
                <div class="bg-slate-50 p-4 rounded-xl border border-slate-200 text-xs font-mono text-slate-700 space-y-1">
                    <div><strong>Host:</strong> <?php echo DB_HOST; ?>:<?php echo DB_PORT; ?></div>
                    <div><strong>User:</strong> <?php echo DB_USER; ?></div>
                    <div><strong>Database:</strong> <?php echo DB_NAME; ?></div>
                    <div><strong>Table:</strong> mlas (325 records)</div>
                </div>
            </div>

            <form method="POST" action="import.php" class="flex flex-col sm:flex-row gap-3">
                <button type="submit" name="import" value="1" class="flex-1 bg-brandTeal hover:bg-cyan-700 text-white font-bold py-3 px-6 rounded-xl shadow transition-all text-sm flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                    <span>Execute MySQL Import Now</span>
                </button>
                <a href="../mla.php" class="px-6 py-3 rounded-xl border border-slate-300 font-bold text-slate-700 text-sm text-center hover:bg-slate-50 transition-colors">
                    Back to MLA Directory
                </a>
            </form>

        </div>

    </div>
</main>

<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
