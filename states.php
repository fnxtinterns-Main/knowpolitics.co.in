<?php
// states.php - All India Interactive Map & State Directory
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/db.php';

$states = json_decode(file_get_contents(__DIR__ . '/data/states_india.json'), true);
$map_data = json_decode(file_get_contents(__DIR__ . '/data/india_map_paths.json'), true);

// Selected state (default to Bihar or from URL query)
$selected_slug = isset($_GET['state']) ? strtolower(trim($_GET['state'])) : 'bihar';

// Find selected state info
$current_state_info = null;
foreach ($states as $s) {
    if ($s['id'] === $selected_slug || strtolower($s['code']) === $selected_slug || strtolower($s['name']) === strtolower(str_replace('-', ' ', $selected_slug))) {
        $current_state_info = $s;
        break;
    }
}
if (!$current_state_info) {
    $current_state_info = $states[3]; // Bihar default
}

$state_name = $current_state_info['name'];

// Fetch MPs for this state
$state_mps = get_mps($state_name)['data'];

// Fetch MLAs for this state
$state_mlas = get_mlas($state_name)['data'];

// View tab: all / mps / mlas
$active_tab = isset($_GET['tab']) ? strtolower(trim($_GET['tab'])) : 'all';

include __DIR__ . '/includes/header.php';
?>

<main class="flex-grow bg-offwhite py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Page Title & Stats Overview -->
        <div class="mb-8">
            <div class="flex items-center gap-2 text-xs text-textMuted font-bold uppercase tracking-wider mb-2">
                <a href="index.php?lang=<?php echo $current_lang; ?>" class="hover:text-brandTeal"><?php echo __t('nav_home'); ?></a>
                <span>/</span>
                <span class="text-slateNavy">Interactive India Map</span>
            </div>
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-slateNavy tracking-tight">
                        Explore India: State Representatives & Report Cards
                    </h1>
                    <p class="text-sm text-slate-600 mt-1">
                        Select any of India's 28 States or 8 Union Territories to view all MPs, MLAs, and their performance scorecards.
                    </p>
                </div>
                
                <!-- National Aggregates -->
                <div class="flex flex-wrap gap-2 text-xs font-bold">
                    <span class="bg-white border border-slate-300 px-3 py-1.5 rounded-xl shadow-sm text-slateNavy">
                        🇮🇳 543 Lok Sabha Seats
                    </span>
                    <span class="bg-white border border-slate-300 px-3 py-1.5 rounded-xl shadow-sm text-slateNavy">
                        🏛️ 4,123 Assembly Seats
                    </span>
                    <span class="bg-white border border-slate-300 px-3 py-1.5 rounded-xl shadow-sm text-brandTeal">
                        36 States & UTs
                    </span>
                </div>
            </div>
        </div>

        <!-- INTERACTIVE INDIA MAP & STATE SELECTOR ROW -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-10 items-start">
            
            <!-- Left: Interactive Vector Map -->
            <div class="lg:col-span-7 bg-white border border-slate-200 rounded-3xl p-6 sm:p-8 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-brandOrange animate-pulse"></span>
                        <h2 class="text-lg font-black text-slateNavy uppercase tracking-wider">
                            Interactive India Map
                        </h2>
                    </div>
                    <span class="text-xs text-slate-500 font-medium">Click any state to load data</span>
                </div>

                <!-- Interactive SVG Map of India (Current Official Survey of India Post-2019 Map) -->
                <div class="relative w-full aspect-[800/900] max-h-[620px] mx-auto flex items-center justify-center p-2 bg-slate-50/80 rounded-2xl border border-slate-200 overflow-hidden shadow-inner">
                    <svg viewBox="<?php echo htmlspecialchars($map_data['viewBox'] ?? '0 0 800 900'); ?>" class="w-full h-full drop-shadow select-none" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <filter id="state-hover-glow" x="-20%" y="-20%" width="140%" height="140%">
                                <feDropShadow dx="0" dy="2" stdDeviation="3" flood-color="#E3771C" flood-opacity="0.4"/>
                            </filter>
                        </defs>
                        
                        <!-- ALL 36 INDIAN STATES & UTs AS OFFICIAL SURVEY OF INDIA VECTOR PATHS -->
                        <g id="india-states">
                            <?php 
                            $state_palette = [
                                'ladakh' => '#dcfce7',
                                'jammu-and-kashmir' => '#f3e8ff',
                                'himachal-pradesh' => '#fef08a',
                                'punjab' => '#fed7aa',
                                'uttarakhand' => '#e0e7ff',
                                'haryana' => '#fce7f3',
                                'delhi' => '#ef4444',
                                'rajasthan' => '#fef9c3',
                                'uttar-pradesh' => '#ffedd5',
                                'bihar' => '#fee2e2',
                                'jharkhand' => '#dcfce7',
                                'west-bengal' => '#e0f2fe',
                                'sikkim' => '#fef08a',
                                'assam' => '#fef08a',
                                'arunachal-pradesh' => '#f3e8ff',
                                'nagaland' => '#fbcfe8',
                                'manipur' => '#fed7aa',
                                'mizoram' => '#dcfce7',
                                'tripura' => '#fed7aa',
                                'meghalaya' => '#e0e7ff',
                                'gujarat' => '#bae6fd',
                                'madhya-pradesh' => '#fef08a',
                                'chhattisgarh' => '#f3e8ff',
                                'odisha' => '#fef9c3',
                                'maharashtra' => '#fed7aa',
                                'goa' => '#f472b6',
                                'karnataka' => '#fef08a',
                                'telangana' => '#fce7f3',
                                'andhra-pradesh' => '#fed7aa',
                                'tamil-nadu' => '#dcfce7',
                                'kerala' => '#bae6fd',
                                'andaman-and-nicobar' => '#bae6fd',
                                'lakshadweep' => '#bae6fd',
                                'puducherry' => '#f43f5e',
                                'chandigarh' => '#ef4444',
                                'dadra-and-nagar-haveli' => '#bae6fd'
                            ];

                            foreach ($map_data['states'] as $st): 
                                $is_selected = ($st['slug'] === $current_state_info['id']);
                                $base_color = $state_palette[$st['slug']] ?? '#f1f5f9';
                                
                                if ($is_selected) {
                                    $fill_style = 'fill="#152B5D" stroke="#0D1C3E" stroke-width="2" filter="url(#state-hover-glow)"';
                                    $extra_class = 'brightness-105';
                                } else {
                                    $fill_style = 'fill="' . $base_color . '" stroke="#475569" stroke-width="0.9"';
                                    $extra_class = 'hover:fill-[#E3771C] hover:stroke-[#0f172a] hover:stroke-[1.8]';
                                }
                            ?>
                                <path 
                                    id="state-<?php echo htmlspecialchars($st['id']); ?>" 
                                    data-id="<?php echo htmlspecialchars($st['slug']); ?>" 
                                    data-name="<?php echo htmlspecialchars($st['name']); ?>" 
                                    d="<?php echo $st['d']; ?>" 
                                    <?php echo $fill_style; ?>
                                    class="state-path cursor-pointer transition-all duration-150 stroke-linejoin-round <?php echo $extra_class; ?>"
                                >
                                    <title><?php echo htmlspecialchars($st['name']); ?></title>
                                </path>
                            <?php endforeach; ?>
                        </g>

                        <!-- STATE LABELS LAYER -->
                        <g id="state-labels" class="pointer-events-none select-none">
                            <?php 
                            $hide_small_labels = ['chandigarh', 'puducherry', 'dadra-and-nagar-haveli', 'delhi'];
                            foreach ($map_data['states'] as $st): 
                                if (!empty($st['labelX']) && !empty($st['labelY']) && !in_array($st['slug'], $hide_small_labels)):
                                    $is_selected = ($st['slug'] === $current_state_info['id']);
                                    $text_fill = $is_selected ? '#ffffff' : '#1e293b';
                                    $font_size = in_array($st['slug'], ['goa', 'sikkim', 'tripura']) ? '9' : '10.5';
                            ?>
                                <text 
                                    x="<?php echo $st['labelX']; ?>" 
                                    y="<?php echo $st['labelY']; ?>" 
                                    text-anchor="middle" 
                                    dominant-baseline="central" 
                                    font-family="system-ui, -apple-system, sans-serif" 
                                    font-weight="<?php echo $is_selected ? '900' : '700'; ?>" 
                                    font-size="<?php echo $font_size; ?>" 
                                    fill="<?php echo $text_fill; ?>"
                                    stroke="<?php echo $is_selected ? '#152B5D' : '#ffffff'; ?>"
                                    stroke-width="<?php echo $is_selected ? '0' : '0.5'; ?>"
                                    paint-order="stroke fill"
                                >
                                    <?php echo htmlspecialchars($st['code']); ?>
                                </text>
                            <?php 
                                endif;
                            endforeach; 
                            ?>
                        </g>
                    </svg>

                    <!-- Floating Interactive Hover Tooltip -->
                    <div id="map-tooltip" class="absolute pointer-events-none opacity-0 transition-opacity duration-150 bg-slate-900/95 text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow-xl border border-slate-700 z-30 whitespace-nowrap">
                        <div id="tooltip-name" class="font-black text-brandOrange text-sm"></div>
                        <div class="text-[11px] text-slate-300 font-medium">Click to view MPs & MLAs</div>
                    </div>
                </div>
            </div>

            <!-- Right: State Selector & Active State Scorecard -->
            <div class="lg:col-span-5 space-y-6">
                
                <!-- Fast Dropdown Selector -->
                <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                    <label class="block text-xs font-black uppercase text-slate-500 tracking-wider mb-2">
                        Select Any State / Union Territory
                    </label>
                    <select id="state-select-dropdown" onchange="window.location.href='states?state=' + this.value;" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm font-bold text-slateNavy focus:outline-none focus:border-brandTeal">
                        <?php foreach ($states as $s): ?>
                            <option value="<?php echo $s['id']; ?>" <?php echo $s['id'] === $current_state_info['id'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($s['name']); ?> (<?php echo htmlspecialchars($s['name_hi']); ?>) • <?php echo $s['ls_seats']; ?> Lok Sabha
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Active State Dossier Card -->
                <div class="bg-gradient-to-br from-brandNavyDark via-brandNavy to-brandNavyDark text-white rounded-3xl p-6 sm:p-7 shadow-lg space-y-4 border border-brandNavy/60">
                    <div class="flex items-center justify-between">
                        <span class="px-3 py-1 rounded-full text-xs font-black uppercase bg-brandOrange text-white shadow-sm">
                            State Overview
                        </span>
                        <span class="text-xs text-slate-300 font-semibold">Region: <?php echo $current_state_info['region']; ?></span>
                    </div>

                    <div>
                        <h2 class="text-3xl font-black text-white">
                            <?php echo htmlspecialchars($current_state_info['name']); ?>
                        </h2>
                        <p class="text-base font-bold text-amber-200">
                            <?php echo htmlspecialchars($current_state_info['name_hi']); ?> • Capital: <?php echo $current_state_info['capital']; ?>
                        </p>
                    </div>

                    <!-- Metrics Badges -->
                    <div class="grid grid-cols-2 gap-3 pt-2">
                        <div class="bg-white/10 p-3.5 rounded-2xl border border-white/10 text-center">
                            <div class="text-2xl font-black text-white"><?php echo $current_state_info['ls_seats']; ?></div>
                            <div class="text-[11px] font-bold text-slate-300 uppercase">Lok Sabha MPs</div>
                        </div>
                        <div class="bg-white/10 p-3.5 rounded-2xl border border-white/10 text-center">
                            <div class="text-2xl font-black text-white"><?php echo $current_state_info['vs_seats']; ?></div>
                            <div class="text-[11px] font-bold text-slate-300 uppercase">Vidhan Sabha MLAs</div>
                        </div>
                    </div>

                    <!-- Quick Action Links -->
                    <div class="pt-2 flex gap-2">
                        <a href="mp?state=<?php echo urlencode($current_state_info['name']); ?>" class="flex-1 text-center bg-brandOrange hover:bg-brandOrangeDark text-white text-xs font-black py-2.5 rounded-xl transition-all shadow">
                            View All MPs (<?php echo $current_state_info['ls_seats']; ?>)
                        </a>
                        <?php if ($current_state_info['vs_seats'] > 0): ?>
                            <a href="mla?state=<?php echo urlencode($current_state_info['name']); ?>" class="flex-1 text-center bg-white/20 hover:bg-white/30 text-white text-xs font-bold py-2.5 rounded-xl transition-all">
                                View MLAs (<?php echo $current_state_info['vs_seats']; ?>)
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

            </div>

        </div>

        <!-- REPRESENTATIVES OF SELECTED STATE WITH PHOTOS & REPORT CARDS -->
        <div class="bg-white border border-slate-200 rounded-3xl p-6 sm:p-8 shadow-sm">
            
            <!-- Tab Controls -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 pb-4 border-b border-slate-200">
                <div>
                    <h3 class="text-2xl font-black text-slateNavy">
                        Elected Representatives from <?php echo htmlspecialchars($current_state_info['name']); ?>
                    </h3>
                    <p class="text-xs text-slate-500 mt-0.5">
                        Click on any representative to inspect their verified photos, fund expenditure, and development works report.
                    </p>
                </div>

                <!-- Tabs -->
                <div class="flex rounded-xl p-1 bg-slate-100 border border-slate-200">
                    <a href="states.php?state=<?php echo $selected_slug; ?>&tab=all" class="px-4 py-1.5 text-xs font-bold rounded-lg transition-all <?php echo $active_tab==='all'?'bg-white text-slateNavy shadow':'text-slate-600'; ?>">
                        All (<?php echo count($state_mps) + count($state_mlas); ?>)
                    </a>
                    <a href="states.php?state=<?php echo $selected_slug; ?>&tab=mps" class="px-4 py-1.5 text-xs font-bold rounded-lg transition-all <?php echo $active_tab==='mps'?'bg-brandTeal text-white shadow':'text-slate-600'; ?>">
                        MPs (<?php echo count($state_mps); ?>)
                    </a>
                    <?php if (count($state_mlas) > 0): ?>
                        <a href="states.php?state=<?php echo $selected_slug; ?>&tab=mlas" class="px-4 py-1.5 text-xs font-bold rounded-lg transition-all <?php echo $active_tab==='mlas'?'bg-brandTeal text-white shadow':'text-slate-600'; ?>">
                            MLAs (<?php echo count($state_mlas); ?>)
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- List Grid -->
            <?php 
            $display_reps = [];
            if ($active_tab === 'all') {
                foreach ($state_mps as $m) { $m['house'] = 'Lok Sabha MP'; $display_reps[] = $m; }
                foreach ($state_mlas as $m) { $m['house'] = 'Vidhan Sabha MLA'; $display_reps[] = $m; }
            } elseif ($active_tab === 'mps') {
                foreach ($state_mps as $m) { $m['house'] = 'Lok Sabha MP'; $display_reps[] = $m; }
            } else {
                foreach ($state_mlas as $m) { $m['house'] = 'Vidhan Sabha MLA'; $display_reps[] = $m; }
            }
            ?>

            <?php if (empty($display_reps)): ?>
                <div class="p-8 text-center text-slate-500">
                    <p class="font-bold">Full database sync for <?php echo htmlspecialchars($current_state_info['name']); ?> in progress.</p>
                    <p class="text-xs mt-1">Browse Bihar and Jharkhand for complete seat-by-seat live data.</p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <?php foreach ($display_reps as $rep): 
                        $photo = !empty($rep['image']) ? $rep['image'] : '';
                    ?>
                        <div class="card-hover-effect bg-white border border-slate-200 rounded-2xl p-5 shadow-sm flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between mb-3">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-black uppercase tracking-wider <?php echo strpos($rep['house'], 'MP') !== false ? 'bg-blue-100 text-blue-800' : 'bg-emerald-100 text-emerald-800'; ?>">
                                        <?php echo $rep['house']; ?>
                                    </span>
                                    <span class="text-[11px] font-bold text-slate-500">
                                        #<?php echo $rep['no'] ?? $rep['constituency_no'] ?? '1'; ?>
                                    </span>
                                </div>

                                <div class="flex items-start gap-3 mb-3">
                                    <?php if (!empty($photo)): ?>
                                        <img 
                                            src="<?php echo htmlspecialchars($photo); ?>" 
                                            alt="<?php echo htmlspecialchars($rep['name']); ?>" 
                                            class="w-14 h-16 rounded-xl object-cover border-2 border-slate-200 shadow-sm flex-shrink-0 bg-slate-100"
                                            onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=<?php echo urlencode($rep['name']); ?>&background=0891b2&color=fff';"
                                        >
                                    <?php else: ?>
                                        <div class="w-14 h-16 rounded-xl bg-slate-100 text-brandTeal font-black text-xl flex items-center justify-center border-2 border-slate-200 shadow-sm flex-shrink-0">
                                            <?php echo mb_substr($rep['name'], 0, 1); ?>
                                        </div>
                                    <?php endif; ?>

                                    <div>
                                        <h4 class="font-extrabold text-slateNavy text-base leading-snug">
                                            <?php echo htmlspecialchars($rep['name']); ?>
                                        </h4>
                                        <div class="text-xs font-bold text-slate-500 mt-0.5">
                                            📍 <?php echo htmlspecialchars($rep['constituency']); ?>
                                        </div>
                                        <?php if (!empty($rep['party'])): ?>
                                            <div class="inline-block mt-1 text-[11px] font-semibold text-slate-700 bg-slate-50 px-2 py-0.5 rounded border border-slate-200">
                                                <?php echo htmlspecialchars($rep['party']); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 pt-3 border-t border-slate-100">
                                <a 
                                    href="report-card?name=<?php echo urlencode($rep['name']); ?>&const=<?php echo urlencode($rep['constituency']); ?>" 
                                    class="w-full inline-flex items-center justify-center gap-1.5 bg-brandOrange hover:bg-brandOrangeDark text-white text-xs font-bold py-2.5 rounded-xl transition-all shadow-sm"
                                >
                                    <span>View Scorecard & Works</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>

    </div>
</main>

<script>
// Handle SVG interactive state hover tooltip and clicks
document.addEventListener('DOMContentLoaded', () => {
    const paths = document.querySelectorAll('.state-path');
    const tooltip = document.getElementById('map-tooltip');
    const tooltipName = document.getElementById('tooltip-name');
    const mapContainer = tooltip ? tooltip.parentElement : null;

    paths.forEach(p => {
        p.addEventListener('click', () => {
            const stateId = p.getAttribute('data-id');
            if (stateId) {
                window.location.href = 'states?state=' + encodeURIComponent(stateId);
            }
        });

        p.addEventListener('mouseenter', (e) => {
            const name = p.getAttribute('data-name');
            if (tooltip && tooltipName) {
                tooltipName.textContent = name;
                tooltip.classList.remove('opacity-0');
                tooltip.classList.add('opacity-100');
            }
        });

        p.addEventListener('mousemove', (e) => {
            if (tooltip && mapContainer) {
                const rect = mapContainer.getBoundingClientRect();
                const x = e.clientX - rect.left + 14;
                const y = e.clientY - rect.top - 36;
                tooltip.style.left = Math.max(10, Math.min(x, rect.width - 180)) + 'px';
                tooltip.style.top = Math.max(10, y) + 'px';
            }
        });

        p.addEventListener('mouseleave', () => {
            if (tooltip) {
                tooltip.classList.remove('opacity-100');
                tooltip.classList.add('opacity-0');
            }
        });
    });
});
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
