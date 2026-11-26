<?php
// mla.php - MLA Directory (Bihar & Jharkhand)
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/db.php';

// Filter by state and search from query params
$state_filter = isset($_GET['state']) ? strtolower(trim($_GET['state'])) : 'all';
$search_query = isset($_GET['q']) ? trim($_GET['q']) : '';

// Fetch data using DB layer (MySQL with automatic JSON fallback)
$mla_result = get_mlas($state_filter, $search_query);
$filtered_mlas = $mla_result['data'];
$data_source = $mla_result['source'];

// Counts for tabs
$all_count = count(get_mlas('all')['data']);
$bihar_count = count(get_mlas('bihar')['data']);
$jharkhand_count = count(get_mlas('jharkhand')['data']);

include __DIR__ . '/includes/header.php';
?>

<main class="flex-grow bg-offwhite py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header & Breadcrumb -->
        <div class="mb-6">
            <div class="flex items-center gap-2 text-xs text-textMuted font-bold uppercase tracking-wider mb-2">
                <a href="index.php?lang=<?php echo $current_lang; ?>" class="hover:text-brandTeal"><?php echo __t('nav_home'); ?></a>
                <span>/</span>
                <span class="text-slateNavy"><?php echo ($current_lang === 'hi') ? 'विधायक सूची' : 'MLA Directory'; ?></span>
            </div>
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-slateNavy tracking-tight">
                        <?php echo ($current_lang === 'hi') ? 'माननीय विधायक (MLA) सूची' : 'Members of Legislative Assembly (MLAs)'; ?>
                    </h1>
                    <p class="text-sm text-slate-600 mt-1">
                        <?php echo ($current_lang === 'hi') 
                            ? 'बिहार (243) एवं झारखंड (81) विधानसभा के सभी निर्वाचित जनप्रतिनिधियों का आधिकारिक विवरण' 
                            : 'Official directory of elected representatives from Bihar (243) & Jharkhand (81) Legislative Assemblies'; ?>
                    </p>
                </div>

                <!-- Live Status & Counter Badge -->
                <div class="flex flex-wrap items-center gap-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold bg-white border border-slate-300 text-slate-700 shadow-sm">
                        <span class="w-2 h-2 rounded-full <?php echo $data_source === 'MySQL Database' ? 'bg-emerald-500' : 'bg-cyan-500'; ?> animate-pulse"></span>
                        <span><?php echo $data_source; ?></span>
                    </span>
                    <span class="inline-flex items-center gap-1.5 bg-slateNavy text-white px-3.5 py-1.5 rounded-xl shadow-sm text-xs font-bold">
                        <span><?php echo count($filtered_mlas); ?> <?php echo ($current_lang === 'hi') ? 'प्रतिनिधि' : 'Members'; ?></span>
                    </span>
                </div>
            </div>
        </div>

        <!-- Share & Export Data Toolbar -->
        <div class="bg-gradient-to-r from-brandNavyDark via-brandNavy to-brandNavyDark text-white rounded-2xl p-4 sm:p-5 mb-8 shadow-md flex flex-col md:flex-row md:items-center justify-between gap-4 border border-brandNavy/60">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-xs font-black uppercase tracking-wider text-brandOrange">MySQL & Open Data</span>
                    <span class="text-[10px] bg-brandOrange/20 text-amber-200 px-2 py-0.5 rounded border border-brandOrange/40">Ready to Share</span>
                </div>
                <p class="text-xs text-slate-300">
                    <?php echo ($current_lang === 'hi') 
                        ? 'संपूर्ण 325 विधायकों का सत्यापित डेटा MySQL, CSV या JSON में डाउनलोड व शेयर करें:' 
                        : 'Download and share all 325 verified MLA records in MySQL, CSV, or JSON:'; ?>
                </p>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                <a href="database/knowpolitics_mlas.sql" download class="inline-flex items-center gap-1.5 bg-brandOrange hover:bg-brandOrangeDark text-white text-xs font-black px-3.5 py-2 rounded-xl transition-all shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    <span>MySQL .SQL Dump</span>
                </a>
                <a href="data/mlas_all.csv" download class="inline-flex items-center gap-1.5 bg-slate-700 hover:bg-slate-600 text-white text-xs font-bold px-3.5 py-2 rounded-xl border border-slate-600 transition-all">
                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span>Excel / CSV</span>
                </a>
                <a href="data/mlas_all.json" download class="inline-flex items-center gap-1.5 bg-slate-700 hover:bg-slate-600 text-white text-xs font-bold px-3.5 py-2 rounded-xl border border-slate-600 transition-all">
                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                    <span>JSON API</span>
                </a>
                <a href="database/import.php" class="inline-flex items-center gap-1.5 bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white text-xs font-bold px-3 py-2 rounded-xl border border-slate-700 transition-all">
                    <span>⚙️ Setup DB</span>
                </a>
            </div>
        </div>

        <!-- Filter Bar -->
        <div class="bg-white border border-slate-200 rounded-2xl p-4 sm:p-6 mb-8 shadow-sm">
            <form method="GET" action="mla.php" class="grid grid-cols-1 sm:grid-cols-12 gap-4 items-center">
                <input type="hidden" name="lang" value="<?php echo htmlspecialchars($current_lang); ?>">

                <!-- State Filter Tabs -->
                <div class="sm:col-span-5 flex rounded-lg p-1 bg-slate-100 border border-slate-200">
                    <a href="mla.php?state=all&lang=<?php echo $current_lang; ?>" 
                       class="flex-1 text-center py-2 text-xs font-bold rounded-md transition-all <?php echo ($state_filter === 'all') ? 'bg-white text-slateNavy shadow' : 'text-slate-600 hover:text-slateNavy'; ?>">
                        <?php echo ($current_lang === 'hi') ? 'सभी (' . $all_count . ')' : 'All (' . $all_count . ')'; ?>
                    </a>
                    <a href="mla.php?state=bihar&lang=<?php echo $current_lang; ?>" 
                       class="flex-1 text-center py-2 text-xs font-bold rounded-md transition-all <?php echo ($state_filter === 'bihar') ? 'bg-stateBihar text-white shadow' : 'text-slate-600 hover:text-stateBihar'; ?>">
                        <?php echo __t('state_bihar'); ?> (<?php echo $bihar_count; ?>)
                    </a>
                    <a href="mla.php?state=jharkhand&lang=<?php echo $current_lang; ?>" 
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
                        placeholder="<?php echo ($current_lang === 'hi') ? 'विधायक का नाम, क्षेत्र या दल खोजें...' : 'Search by name, constituency or party...'; ?>" 
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

        <!-- MLA Grid -->
        <?php if (empty($filtered_mlas)): ?>
            <div class="bg-white rounded-2xl border border-slate-200 p-12 text-center text-slate-500">
                <svg class="w-12 h-12 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p class="font-bold text-lg text-slate-700">कोई रिकॉर्ड नहीं मिला</p>
                <p class="text-xs text-slate-400 mt-1">कृपया भिन्न खोज शब्द दर्ज करें या सभी राज्यों का चयन करें।</p>
                <a href="mla.php?lang=<?php echo $current_lang; ?>" class="inline-block mt-4 text-xs font-bold text-brandTeal hover:underline">सभी विधायक देखें</a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <?php foreach ($filtered_mlas as $mla): 
                    $isBihar = strtolower($mla['state']) === 'bihar';
                    $stateColor = $isBihar ? 'bg-stateBihar text-white' : 'bg-stateJharkhand text-white';
                    $stateBorder = $isBihar ? 'hover:border-stateBihar' : 'hover:border-stateJharkhand';
                ?>
                    <div class="card-hover-effect bg-white border border-slate-200 <?php echo $stateBorder; ?> rounded-2xl p-5 shadow-sm flex flex-col justify-between transition-all">
                        
                        <div>
                            <!-- Top Tag Strip -->
                            <div class="flex items-center justify-between mb-3">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black tracking-wide <?php echo $stateColor; ?>">
                                    <?php echo $mla['state']; ?>
                                </span>
                                <span class="text-[11px] font-bold text-slate-500">
                                    #<?php echo $mla['constituency_no']; ?>
                                </span>
                            </div>

                            <!-- Avatar & Details -->
                            <div class="flex items-start gap-3 mb-4">
                                <?php if (!empty($mla['image'])): ?>
                                    <img 
                                        src="<?php echo htmlspecialchars($mla['image']); ?>" 
                                        alt="<?php echo htmlspecialchars($mla['name']); ?>" 
                                        class="w-14 h-14 rounded-full object-cover border-2 border-slate-200 shadow-sm flex-shrink-0"
                                        onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=<?php echo urlencode($mla['name']); ?>&background=0891b2&color=fff';"
                                    >
                                <?php else: ?>
                                    <div class="w-14 h-14 rounded-full bg-slate-100 text-slate-700 font-black text-lg flex items-center justify-center border-2 border-slate-200 shadow-sm flex-shrink-0">
                                        <?php echo mb_substr($mla['name'], 0, 1); ?>
                                    </div>
                                <?php endif; ?>

                                <div>
                                    <h3 class="font-extrabold text-slateNavy text-base leading-snug">
                                        <?php echo htmlspecialchars($mla['name']); ?>
                                    </h3>
                                    <div class="text-xs font-bold text-brandTeal mt-0.5">
                                        📍 <?php echo htmlspecialchars($mla['constituency']); ?>
                                    </div>
                                    <?php if (!empty($mla['party'])): ?>
                                        <div class="inline-block mt-1 px-2 py-0.5 bg-slate-100 border border-slate-200 rounded text-[11px] font-bold text-slate-700">
                                            <?php echo htmlspecialchars($mla['party']); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Contact info if available -->
                            <?php if (!empty($mla['contact'])): ?>
                                <div class="text-[11px] text-slate-500 font-medium flex items-center gap-1.5 pt-2 border-t border-slate-100">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                    <span><?php echo htmlspecialchars($mla['contact']); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Action Button -->
                        <div class="mt-4 pt-3 border-t border-slate-100">
                            <a 
                                href="report-card?type=mla&name=<?php echo urlencode($mla['name']); ?>&const=<?php echo urlencode($mla['constituency']); ?>" 
                                class="w-full inline-flex items-center justify-center gap-1.5 text-xs font-bold text-slateNavy hover:text-brandTeal bg-slate-50 hover:bg-slate-100 border border-slate-200 py-2 rounded-xl transition-all"
                            >
                                <span><?php echo ($current_lang === 'hi') ? 'रिपोर्ट कार्ड देखें' : 'View Photo & Work Report'; ?></span>
                                <svg class="w-3.5 h-3.5 text-brandTeal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
