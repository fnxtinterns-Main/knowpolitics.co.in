<?php
// search.php - Search Representatives (with Photos) and Their Works
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/db.php';

$query = isset($_GET['q']) ? trim($_GET['q']) : '';
$tab = isset($_GET['tab']) ? strtolower(trim($_GET['tab'])) : 'all';

$all_mlas = get_mlas('all')['data'];
$all_mps = get_mps('all')['data'];
$works = json_decode(file_get_contents(__DIR__ . '/data/works_data.json'), true);

$matched_reps = [];
$matched_works = [];

if ($query !== '') {
    $q = mb_strtolower($query);

    // Search MPs
    foreach ($all_mps as $m) {
        if (mb_stripos($m['name'], $q) !== false || 
            mb_stripos($m['constituency'], $q) !== false || 
            mb_stripos($m['constituency_en'] ?? '', $q) !== false || 
            mb_stripos($m['party'], $q) !== false) {
            $m['rep_type'] = 'MP (Lok Sabha)';
            $matched_reps[] = $m;
        }
    }

    // Search MLAs
    foreach ($all_mlas as $m) {
        if (mb_stripos($m['name'], $q) !== false || 
            mb_stripos($m['constituency'], $q) !== false || 
            mb_stripos($m['party'] ?? '', $q) !== false) {
            $m['rep_type'] = 'MLA (Vidhan Sabha)';
            $matched_reps[] = $m;
        }
    }

    // Search Works
    foreach ($works as $w) {
        if (mb_stripos($w['title'] ?? '', $q) !== false || 
            mb_stripos($w['title_hi'] ?? '', $q) !== false || 
            mb_stripos($w['category'] ?? '', $q) !== false || 
            mb_stripos($w['constituency'] ?? '', $q) !== false || 
            mb_stripos($w['constituency_en'] ?? '', $q) !== false) {
            $matched_works[] = $w;
        }
    }
} else {
    // Default recommendations if search is empty
    $matched_reps = array_slice($all_mps, 0, 8);
    $matched_works = $works;
}

include __DIR__ . '/includes/header.php';
?>

<main class="flex-grow bg-offwhite py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Search Header Bar -->
        <div class="max-w-3xl mx-auto mb-10 text-center">
            <h1 class="text-3xl sm:text-4xl font-black text-slateNavy tracking-tight mb-2">
                Search Representatives & Development Works
            </h1>
            <p class="text-sm text-slate-600 mb-6">
                Search by MP/MLA name, constituency, or civic work (roads, schools, hospitals, water)
            </p>

            <form method="GET" action="search.php" class="relative max-w-2xl mx-auto">
                <input type="hidden" name="lang" value="<?php echo htmlspecialchars($current_lang); ?>">
                <div class="flex items-center bg-white rounded-2xl shadow-md border-2 border-slate-300 focus-within:border-brandTeal p-2 transition-all">
                    <div class="pl-3 pr-2 text-slate-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input 
                        type="text" 
                        name="q" 
                        value="<?php echo htmlspecialchars($query); ?>" 
                        placeholder="Search representative photo or work (e.g. Chirag, Ranchi, road, hospital)..." 
                        class="w-full bg-transparent text-slate-800 placeholder-slate-400 font-semibold focus:outline-none text-base"
                    >
                    <button type="submit" class="bg-brandOrange hover:bg-brandOrangeDark text-white font-bold px-6 py-2.5 rounded-xl shadow text-sm transition-all">
                        Search
                    </button>
                </div>
            </form>
        </div>

        <!-- Result Tabs -->
        <div class="flex border-b border-slate-200 mb-8 space-x-6">
            <a href="search.php?q=<?php echo urlencode($query); ?>&tab=all" class="pb-3 text-sm font-extrabold border-b-2 transition-colors <?php echo $tab === 'all' ? 'border-brandTeal text-brandTeal' : 'border-transparent text-slate-500 hover:text-slate-800'; ?>">
                All Results (<?php echo count($matched_reps) + count($matched_works); ?>)
            </a>
            <a href="search.php?q=<?php echo urlencode($query); ?>&tab=reps" class="pb-3 text-sm font-extrabold border-b-2 transition-colors <?php echo $tab === 'reps' ? 'border-brandTeal text-brandTeal' : 'border-transparent text-slate-500 hover:text-slate-800'; ?>">
                Representatives & Photos (<?php echo count($matched_reps); ?>)
            </a>
            <a href="search.php?q=<?php echo urlencode($query); ?>&tab=works" class="pb-3 text-sm font-extrabold border-b-2 transition-colors <?php echo $tab === 'works' ? 'border-brandTeal text-brandTeal' : 'border-transparent text-slate-500 hover:text-slate-800'; ?>">
                Development Works (<?php echo count($matched_works); ?>)
            </a>
        </div>

        <!-- 1. REPRESENTATIVES WITH PHOTOS -->
        <?php if ($tab === 'all' || $tab === 'reps'): ?>
            <div class="mb-12">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-black text-slateNavy flex items-center gap-2">
                        <span>👤 Representatives with Photos</span>
                        <span class="text-xs bg-slate-200 text-slate-700 px-2 py-0.5 rounded-full font-bold"><?php echo count($matched_reps); ?></span>
                    </h2>
                </div>

                <?php if (empty($matched_reps)): ?>
                    <p class="text-sm text-slate-500 bg-white p-6 rounded-2xl border border-slate-200 text-center">No representatives matched your search query.</p>
                <?php else: ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        <?php foreach ($matched_reps as $m): 
                            $photo = !empty($m['image']) ? $m['image'] : '';
                            $isBihar = strtolower($m['state']) === 'bihar';
                        ?>
                            <div class="card-hover-effect bg-white border border-slate-200 rounded-2xl p-5 shadow-sm flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="px-2 py-0.5 rounded text-[10px] font-black text-white <?php echo $isBihar ? 'bg-stateBihar' : 'bg-stateJharkhand'; ?>">
                                            <?php echo $m['state']; ?>
                                        </span>
                                        <span class="text-[11px] font-bold text-brandTeal">
                                            <?php echo $m['rep_type'] ?? 'Representative'; ?>
                                        </span>
                                    </div>

                                    <div class="flex items-start gap-3 mb-3">
                                        <?php if (!empty($photo)): ?>
                                            <img 
                                                src="<?php echo htmlspecialchars($photo); ?>" 
                                                alt="<?php echo htmlspecialchars($m['name']); ?>" 
                                                class="w-14 h-16 rounded-xl object-cover border-2 border-slate-200 shadow-sm flex-shrink-0 bg-slate-100"
                                                onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=<?php echo urlencode($m['name']); ?>&background=0891b2&color=fff';"
                                            >
                                        <?php else: ?>
                                            <div class="w-14 h-16 rounded-xl bg-slate-100 text-brandTeal font-black text-xl flex items-center justify-center border-2 border-slate-200 shadow-sm flex-shrink-0">
                                                <?php echo mb_substr($m['name'], 0, 1); ?>
                                            </div>
                                        <?php endif; ?>

                                        <div>
                                            <h3 class="font-extrabold text-slateNavy text-base leading-snug">
                                                <?php echo htmlspecialchars($m['name']); ?>
                                            </h3>
                                            <div class="text-xs font-bold text-slate-500 mt-0.5">
                                                📍 <?php echo htmlspecialchars($m['constituency']); ?>
                                            </div>
                                            <?php if (!empty($m['party'])): ?>
                                                <div class="inline-block mt-1 text-[11px] font-semibold text-slate-600 bg-slate-50 px-2 py-0.5 rounded border border-slate-200">
                                                    <?php echo htmlspecialchars($m['party']); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 pt-3 border-t border-slate-100">
                                    <a 
                                        href="report-card?name=<?php echo urlencode($m['name']); ?>&const=<?php echo urlencode($m['constituency']); ?>" 
                                        class="w-full inline-flex items-center justify-center gap-1.5 bg-brandOrange hover:bg-brandOrangeDark text-white text-xs font-bold py-2.5 rounded-xl transition-all shadow-sm"
                                    >
                                        <span>View Photo & Work Report</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- 2. DEVELOPMENT WORKS (THEIR WORK) -->
        <?php if ($tab === 'all' || $tab === 'works'): ?>
            <div>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-black text-slateNavy flex items-center gap-2">
                        <span>🏗️ Development Works & Projects Tracked</span>
                        <span class="text-xs bg-slate-200 text-slate-700 px-2 py-0.5 rounded-full font-bold"><?php echo count($matched_works); ?></span>
                    </h2>
                </div>

                <?php if (empty($matched_works)): ?>
                    <p class="text-sm text-slate-500 bg-white p-6 rounded-2xl border border-slate-200 text-center">No projects matched your search query.</p>
                <?php else: ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <?php foreach ($matched_works as $w): ?>
                            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider <?php echo $w['status'] === 'Completed' ? 'bg-emerald-100 text-emerald-800' : 'bg-orange-100 text-brandOrange'; ?>">
                                            <?php echo $w['status']; ?> • <?php echo $w['completion_pct']; ?>% Done
                                        </span>
                                        <span class="text-sm font-black text-slateNavy">₹ <?php echo $w['cost_cr']; ?> Cr</span>
                                    </div>
                                    <h3 class="text-base font-bold text-slateNavy mb-1">
                                        <?php echo htmlspecialchars($w['title']); ?>
                                    </h3>
                                    <div class="text-xs text-slate-500 mb-3">
                                        📍 <?php echo htmlspecialchars($w['constituency']); ?> (<?php echo htmlspecialchars($w['constituency_en']); ?>), <?php echo $w['state']; ?>
                                    </div>
                                    <!-- Progress -->
                                    <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden mb-3">
                                        <div class="bg-brandTeal h-full rounded-full" style="width: <?php echo $w['completion_pct']; ?>%"></div>
                                    </div>
                                </div>
                                <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                                    <span class="text-slate-500 font-medium">Scheme: <strong><?php echo htmlspecialchars($w['scheme']); ?></strong></span>
                                    <a href="report-card?const=<?php echo urlencode($w['constituency_en']); ?>" class="text-brandTeal font-bold hover:underline">
                                        Constituency Report →
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
