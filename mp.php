<?php
// mp.php - 18th Lok Sabha Members of Parliament (Bihar & Jharkhand)
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/db.php';

// Filter by state and search query
$state_filter = isset($_GET['state']) ? strtolower(trim($_GET['state'])) : 'all';
$search_query = isset($_GET['q']) ? trim($_GET['q']) : '';

// Fetch MPs data
$mp_result = get_mps($state_filter, $search_query);
$filtered_mps = $mp_result['data'];
$data_source = $mp_result['source'];

// Counts for tabs
$all_count = count(get_mps('all')['data']);
$bihar_count = count(get_mps('bihar')['data']);
$jharkhand_count = count(get_mps('jharkhand')['data']);

include __DIR__ . '/includes/header.php';
?>

<main class="flex-grow bg-offwhite py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header & Breadcrumb -->
        <div class="mb-6">
            <div class="flex items-center gap-2 text-xs text-textMuted font-bold uppercase tracking-wider mb-2">
                <a href="index.php?lang=<?php echo $current_lang; ?>" class="hover:text-brandTeal"><?php echo __t('nav_home'); ?></a>
                <span>/</span>
                <span class="text-slateNavy"><?php echo ($current_lang === 'hi') ? 'सांसद सूची (18वीं लोकसभा)' : 'MP Directory (18th Lok Sabha)'; ?></span>
            </div>
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-slateNavy tracking-tight">
                        <?php echo ($current_lang === 'hi') ? '18वीं लोकसभा सांसद (MP) सूची' : 'Members of Parliament (18th Lok Sabha)'; ?>
                    </h1>
                    <p class="text-sm text-slate-600 mt-1">
                        <?php echo ($current_lang === 'hi') 
                            ? 'बिहार (40) एवं झारखंड (14) से निर्वाचित सभी सांसदों का आधिकारिक संसदीय रिकॉर्ड' 
                            : 'Official parliamentary directory of elected Lok Sabha MPs from Bihar (40) & Jharkhand (14)'; ?>
                    </p>
                </div>

                <!-- Live Status & Counter Badge -->
                <div class="flex flex-wrap items-center gap-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold bg-white border border-slate-300 text-slate-700 shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                        <span>18th Lok Sabha</span>
                    </span>
                    <span class="inline-flex items-center gap-1.5 bg-slateNavy text-white px-3.5 py-1.5 rounded-xl shadow-sm text-xs font-bold">
                        <span><?php echo count($filtered_mps); ?> <?php echo ($current_lang === 'hi') ? 'सांसद' : 'MPs'; ?></span>
                    </span>
                </div>
            </div>
        </div>

        <!-- Share & Export Data Toolbar -->
        <div class="bg-gradient-to-r from-brandNavyDark via-brandNavy to-brandNavyDark text-white rounded-2xl p-4 sm:p-5 mb-8 shadow-md flex flex-col md:flex-row md:items-center justify-between gap-4 border border-brandNavy/60">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-xs font-black uppercase tracking-wider text-brandOrange">Official Lok Sabha Data</span>
                    <span class="text-[10px] bg-brandOrange/20 text-amber-200 px-2 py-0.5 rounded border border-brandOrange/40">54 Seats Covered</span>
                </div>
                <p class="text-xs text-slate-300">
                    <?php echo ($current_lang === 'hi') 
                        ? 'बिहार व झारखंड के सभी 54 सांसदों का डेटा आधिकारिक विधानसभा व लोकसभा राजपत्रों से सत्यापित:' 
                        : 'All 54 Bihar & Jharkhand Lok Sabha MPs verified from official state legislative gazettes:'; ?>
                </p>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                <a href="database/knowpolitics_mps.sql" download class="inline-flex items-center gap-1.5 bg-brandOrange hover:bg-brandOrangeDark text-white text-xs font-black px-3.5 py-2 rounded-xl transition-all shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    <span>MySQL .SQL Dump</span>
                </a>
                <a href="data/mps_all.csv" download class="inline-flex items-center gap-1.5 bg-slate-700 hover:bg-slate-600 text-white text-xs font-bold px-3.5 py-2 rounded-xl border border-slate-600 transition-all">
                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span>Excel / CSV</span>
                </a>
                <a href="data/mps_all.json" download class="inline-flex items-center gap-1.5 bg-slate-700 hover:bg-slate-600 text-white text-xs font-bold px-3.5 py-2 rounded-xl border border-slate-600 transition-all">
                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                    <span>JSON API</span>
                </a>
            </div>
        </div>

        <!-- Filter Bar -->
        <div class="bg-white border border-slate-200 rounded-2xl p-4 sm:p-6 mb-8 shadow-sm">
            <form method="GET" action="mp.php" class="grid grid-cols-1 sm:grid-cols-12 gap-4 items-center">
                <input type="hidden" name="lang" value="<?php echo htmlspecialchars($current_lang); ?>">

                <!-- State Filter Tabs -->
                <div class="sm:col-span-5 flex rounded-lg p-1 bg-slate-100 border border-slate-200">
                    <a href="mp.php?state=all&lang=<?php echo $current_lang; ?>" 
                       class="flex-1 text-center py-2 text-xs font-bold rounded-md transition-all <?php echo ($state_filter === 'all') ? 'bg-white text-slateNavy shadow' : 'text-slate-600 hover:text-slateNavy'; ?>">
                        <?php echo ($current_lang === 'hi') ? 'सभी (' . $all_count . ')' : 'All (' . $all_count . ')'; ?>
                    </a>
                    <a href="mp.php?state=bihar&lang=<?php echo $current_lang; ?>" 
                       class="flex-1 text-center py-2 text-xs font-bold rounded-md transition-all <?php echo ($state_filter === 'bihar') ? 'bg-stateBihar text-white shadow' : 'text-slate-600 hover:text-stateBihar'; ?>">
                        <?php echo __t('state_bihar'); ?> (<?php echo $bihar_count; ?>)
                    </a>
                    <a href="mp.php?state=jharkhand&lang=<?php echo $current_lang; ?>" 
                       class="flex-1 text-center py-2 text-xs font-bold rounded-md transition-all <?php echo ($state_filter === 'jharkhand') ? 'bg-stateJharkhand text-white shadow' : 'text-slate-600 hover:text-stateJharkhand'; ?>">
                        <?php echo __t('state_jharkhand'); ?> (<?php echo $jharkhand_count; ?>)
                    </a>
                </div>

                <!-- Search Input -->
                <div class="sm:col-span-5 relative">
                    <input 
                        type="text" 
                        name="q" 
                        value="<?php echo htmlspecialchars($search_query); ?>" 
                        placeholder="<?php echo ($current_lang === 'hi') ? 'सांसद का नाम, लोकसभा क्षेत्र या दल खोजें...' : 'Search MP name, constituency or party...'; ?>" 
                        class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-brandTeal focus:ring-1 focus:ring-brandTeal"
                    >
                    <?php if ($state_filter !== 'all'): ?>
                        <input type="hidden" name="state" value="<?php echo htmlspecialchars($state_filter); ?>">
                    <?php endif; ?>
                </div>

                <!-- Submit Button -->
                <div class="sm:col-span-2">
                    <button type="submit" class="w-full bg-brandOrange hover:bg-brandOrangeDark text-white font-bold text-xs uppercase tracking-wider py-3 rounded-xl shadow transition-all flex items-center justify-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <span><?php echo __t('search_btn'); ?></span>
                    </button>
                </div>
            </form>
        </div>

        <!-- MP Cards Grid -->
        <?php if (empty($filtered_mps)): ?>
            <div class="bg-white rounded-2xl border border-slate-200 p-12 text-center text-slate-500">
                <svg class="w-12 h-12 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p class="font-bold text-lg text-slate-700">कोई सांसद रिकॉर्ड नहीं मिला</p>
                <p class="text-xs text-slate-400 mt-1">कृपया भिन्न खोज शब्द दर्ज करें।</p>
                <a href="mp.php?lang=<?php echo $current_lang; ?>" class="inline-block mt-4 text-xs font-bold text-brandTeal hover:underline">सभी सांसद देखें</a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <?php foreach ($filtered_mps as $mp): 
                    $isBihar = strtolower($mp['state']) === 'bihar';
                    $stateColor = $isBihar ? 'bg-stateBihar text-white' : 'bg-stateJharkhand text-white';
                    $stateBorder = $isBihar ? 'hover:border-stateBihar' : 'hover:border-stateJharkhand';
                ?>
                    <div class="card-hover-effect bg-white border border-slate-200 <?php echo $stateBorder; ?> rounded-2xl p-5 shadow-sm flex flex-col justify-between transition-all">
                        
                        <div>
                            <!-- Top Tag Strip -->
                            <div class="flex items-center justify-between mb-3">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black tracking-wide <?php echo $stateColor; ?>">
                                    <?php echo $mp['state']; ?>
                                </span>
                                <div class="flex items-center gap-1.5">
                                    <?php if (!empty($mp['category']) && $mp['category'] !== 'General'): ?>
                                        <span class="px-2 py-0.5 bg-amber-100 text-amber-800 text-[10px] font-bold rounded">
                                            <?php echo htmlspecialchars($mp['category']); ?>
                                        </span>
                                    <?php endif; ?>
                                    <span class="text-[11px] font-bold text-slate-500">
                                        #<?php echo $mp['no']; ?>
                                    </span>
                                </div>
                            </div>

                            <!-- MP Avatar & Details -->
                            <div class="flex items-start gap-3 mb-4">
                                <?php if (!empty($mp['image'])): ?>
                                    <img 
                                        src="<?php echo htmlspecialchars($mp['image']); ?>" 
                                        alt="<?php echo htmlspecialchars($mp['name']); ?>" 
                                        class="w-14 h-16 rounded-xl object-cover border-2 border-slate-200 shadow-sm flex-shrink-0 bg-slate-100"
                                        onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=<?php echo urlencode($mp['name']); ?>&background=0891b2&color=fff';"
                                    >
                                <?php else: ?>
                                    <div class="w-14 h-16 rounded-xl bg-blue-50 text-brandTeal font-black text-xl flex items-center justify-center border-2 border-slate-200 shadow-sm flex-shrink-0">
                                        <?php echo mb_substr($mp['name'], 0, 1); ?>
                                    </div>
                                <?php endif; ?>

                                <div>
                                    <h3 class="font-extrabold text-slateNavy text-base leading-snug">
                                        <?php echo htmlspecialchars($mp['name']); ?>
                                    </h3>
                                    <div class="text-xs font-bold text-brandTeal mt-0.5">
                                        🏛️ <?php echo htmlspecialchars($mp['constituency']); ?>
                                        <span class="text-slate-400 font-normal">(<?php echo htmlspecialchars($mp['constituency_en']); ?>)</span>
                                    </div>
                                    <?php if (!empty($mp['party'])): ?>
                                        <div class="inline-block mt-1 px-2 py-0.5 bg-slate-100 border border-slate-200 rounded text-[11px] font-bold text-slate-700">
                                            <?php echo htmlspecialchars($mp['party']); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Source citation -->
                            <div class="text-[11px] text-slate-500 font-medium flex items-center gap-1.5 pt-2 border-t border-slate-100">
                                <svg class="w-3.5 h-3.5 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                <span>18th Lok Sabha Official Record</span>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center gap-2">
                            <a 
                                href="report-card?type=mp&name=<?php echo urlencode($mp['name']); ?>&const=<?php echo urlencode($mp['constituency_en']); ?>" 
                                class="flex-1 inline-flex items-center justify-center gap-1.5 text-xs font-bold text-slateNavy hover:text-brandTeal bg-slate-50 hover:bg-slate-100 border border-slate-200 py-2 rounded-xl transition-all"
                            >
                                <span>View Photo & Work Report</span>
                                <svg class="w-3.5 h-3.5 text-brandTeal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                            <a 
                                href="https://prsindia.org/mptrack/18th-lok-sabha/<?php echo urlencode(strtolower(str_replace([' ', '.'], ['-', ''], $mp['name']))); ?>" 
                                target="_blank" 
                                rel="noopener noreferrer"
                                title="PRS Legislative Track"
                                class="p-2 rounded-xl border border-slate-200 text-slate-500 hover:text-brandTeal hover:border-brandTeal bg-slate-50 transition-colors"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
