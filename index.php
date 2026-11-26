<?php
// index.php - Main Landing Page
require_once __DIR__ . '/config.php';
include __DIR__ . '/includes/header.php';
?>

<main class="flex-grow">

    <!-- HERO SECTION -->
    <section class="relative bg-gradient-to-b from-white via-offwhite to-slate-100/60 pt-10 pb-16 overflow-hidden border-b border-borderMuted">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Left Column: Headline, Search, State Selector -->
                <div class="lg:col-span-7 space-y-6">
                    
                    <!-- Main Headline -->
                    <div>
                        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-slateNavy leading-tight">
                            <?php echo __t('hero_title_pre'); ?> 
                            <span class="text-brandOrange bg-orange-50 border border-orange-200/70 px-2.5 py-0.5 rounded-lg inline-block"><?php echo __t('hero_title_highlight'); ?></span> 
                            <?php echo __t('hero_title_post'); ?>
                        </h1>
                        <p class="mt-4 text-base sm:text-lg text-slate-600 leading-relaxed max-w-2xl font-medium">
                            <?php echo __t('hero_subtitle'); ?>
                        </p>
                    </div>

                    <!-- Trust Badges Strip -->
                    <div class="flex flex-wrap gap-2 sm:gap-4 pt-1">
                        <div class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-800 bg-emerald-50 border border-emerald-200 px-3 py-1.5 rounded-full">
                            <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span><?php echo __t('badge_verified'); ?></span>
                        </div>
                        <div class="inline-flex items-center gap-1.5 text-xs font-semibold text-blue-800 bg-blue-50 border border-blue-200 px-3 py-1.5 rounded-full">
                            <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span><?php echo __t('badge_govt'); ?></span>
                        </div>
                        <div class="inline-flex items-center gap-1.5 text-xs font-semibold text-brandNavy bg-blue-50 border border-blue-200 px-3 py-1.5 rounded-full">
                            <svg class="w-4 h-4 text-brandNavy" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span><?php echo __t('badge_updates'); ?></span>
                        </div>
                        <div class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-800 bg-slate-100 border border-slate-300 px-3 py-1.5 rounded-full">
                            <svg class="w-4 h-4 text-slate-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span><?php echo __t('badge_public'); ?></span>
                        </div>
                    </div>

                    <!-- Omni Search Bar -->
                    <form id="hero-search-form" class="relative max-w-2xl">
                        <div class="relative flex items-center bg-white rounded-xl shadow-md border border-slate-300 focus-within:border-brandTeal focus-within:ring-2 focus-within:ring-brandTeal/20 transition-all p-1.5">
                            <div class="pl-3 pr-2 text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                id="hero-search-input"
                                class="w-full bg-transparent text-slate-800 placeholder-slate-400 text-sm sm:text-base font-medium focus:outline-none py-2" 
                                placeholder="<?php echo __t('search_placeholder'); ?>"
                            >
                            <button 
                                type="submit" 
                                class="inline-flex items-center gap-1.5 bg-brandOrange hover:bg-brandOrangeDark text-white font-bold text-sm px-6 py-2.5 rounded-lg shadow transition-all flex-shrink-0"
                            >
                                <span><?php echo __t('search_btn'); ?></span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </button>
                        </div>
                    </form>

                    <!-- State Selection Fast Jump -->
                    <div class="pt-2">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-3">
                            <?php echo __t('select_state_ahead'); ?>
                        </p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-xl">
                            
                            <!-- Bihar Button -->
                            <a href="#report-card-section" onclick="document.getElementById('rc-state-select').value='bihar'; document.getElementById('rc-state-select').dispatchEvent(new Event('change'));" class="group relative flex items-center justify-between p-4 bg-stateBiharLight border-2 border-rose-200 hover:border-stateBihar rounded-xl shadow-sm hover:shadow-md transition-all">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-stateBihar text-white flex items-center justify-center font-bold text-sm shadow">
                                        BR
                                    </div>
                                    <div>
                                        <div class="text-lg font-extrabold text-stateBihar leading-tight"><?php echo __t('state_bihar'); ?></div>
                                        <div class="text-xs text-rose-700 font-medium">(<?php echo __t('state_bihar_en'); ?>) • 243 <?php echo __t('nav_mla'); ?></div>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-stateBihar group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </a>

                            <!-- Jharkhand Button -->
                            <a href="#report-card-section" onclick="document.getElementById('rc-state-select').value='jharkhand'; document.getElementById('rc-state-select').dispatchEvent(new Event('change'));" class="group relative flex items-center justify-between p-4 bg-stateJharkhandLight border-2 border-emerald-200 hover:border-stateJharkhand rounded-xl shadow-sm hover:shadow-md transition-all">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-stateJharkhand text-white flex items-center justify-center font-bold text-sm shadow">
                                        JH
                                    </div>
                                    <div>
                                        <div class="text-lg font-extrabold text-stateJharkhand leading-tight"><?php echo __t('state_jharkhand'); ?></div>
                                        <div class="text-xs text-emerald-700 font-medium">(<?php echo __t('state_jharkhand_en'); ?>) • 81 <?php echo __t('nav_mla'); ?></div>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-stateJharkhand group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </a>

                        </div>

                        <!-- All India Map Feature Banner -->
                        <div class="mt-4 max-w-xl">
                            <a href="states" class="flex items-center justify-between p-3.5 bg-gradient-to-r from-brandNavyDark via-brandNavy to-brandNavyDark text-white rounded-xl shadow-md hover:shadow-lg transition-all group border border-slate-700">
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">🗺️</span>
                                    <div>
                                        <div class="text-sm font-extrabold text-white flex items-center gap-2">
                                            <span>Interactive India Map</span>
                                            <span class="bg-brandOrange text-white text-[10px] font-black px-2 py-0.5 rounded-full uppercase">All 36 States</span>
                                        </div>
                                        <div class="text-xs text-amber-200">Click any state on map to view all MPs, MLAs, and report cards</div>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-brandOrange group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>

                </div>

                <!-- Right Column: Visual Graphic & Floating Checklist Card -->
                <div class="lg:col-span-5 relative flex justify-center">
                    
                    <!-- Decorative Graphic Container -->
                    <div class="relative w-full max-w-md bg-white border border-slate-200 rounded-2xl p-6 shadow-xl overflow-hidden">
                        
                        <!-- Header Motif: Jharkhand Vidhan Sabha Image -->
                        <div class="relative rounded-xl overflow-hidden mb-4 shadow-md group">
                            <img 
                                src="assets/images/jharkhand-vidhan-sabha-front.jpg" 
                                alt="<?php echo __t('vidhan_sabha_caption'); ?>" 
                                class="w-full h-48 sm:h-52 object-cover group-hover:scale-105 transition-transform duration-500"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/30 to-transparent"></div>
                            <div class="absolute top-3 left-3">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-emerald-600/90 text-white text-[11px] font-bold rounded-md backdrop-blur-sm shadow-sm">
                                    <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
                                    <span><?php echo __t('vidhan_sabha_tag'); ?></span>
                                </span>
                            </div>
                            <div class="absolute bottom-3 left-3 right-3 text-white">
                                <h3 class="text-base sm:text-lg font-black tracking-tight leading-snug drop-shadow-md">
                                    <?php echo __t('vidhan_sabha_caption'); ?>
                                </h3>
                                <p class="text-[11px] text-slate-200 font-medium drop-shadow flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                                    <span>कूटे, धुर्वा, राँची (Kute, Dhurwa, Ranchi)</span>
                                </p>
                            </div>
                        </div>

                        <!-- Sticky Notepad Card (from mockup) -->
                        <div class="notepad-card rounded-xl p-4 border border-amber-200">
                            <h4 class="text-xs font-black uppercase tracking-wider text-amber-900 mb-3 flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                                </svg>
                                <?php echo ($current_lang === 'hi') ? 'नागरिक ऑडिट चेकलिस्ट' : 'Citizen Audit Checklist'; ?>
                            </h4>
                            <ul class="space-y-2 text-sm font-semibold text-slate-800">
                                <li class="flex items-center gap-2">
                                    <span class="w-5 h-5 rounded bg-emerald-100 text-brandGreen flex items-center justify-center text-xs font-black">✓</span>
                                    <span><?php echo __t('check_funds'); ?></span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-5 h-5 rounded bg-emerald-100 text-brandGreen flex items-center justify-center text-xs font-black">✓</span>
                                    <span><?php echo __t('check_dev'); ?></span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-5 h-5 rounded bg-emerald-100 text-brandGreen flex items-center justify-center text-xs font-black">✓</span>
                                    <span><?php echo __t('check_assembly'); ?></span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-5 h-5 rounded bg-emerald-100 text-brandGreen flex items-center justify-center text-xs font-black">✓</span>
                                    <span><?php echo __t('check_election'); ?></span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-5 h-5 rounded bg-emerald-100 text-brandGreen flex items-center justify-center text-xs font-black">✓</span>
                                    <span><?php echo __t('check_promises'); ?></span>
                                </li>
                            </ul>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- KEY STATS METRICS STRIP -->
    <section class="bg-white border-b border-borderMuted py-8 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-6">
                
                <!-- Stat 1: Total MLAs -->
                <div class="flex items-start gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                    <div class="w-10 h-10 rounded-lg bg-cyan-100 text-cyan-800 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-2xl font-black text-slateNavy"><?php echo __t('stat_mla_num'); ?></div>
                        <div class="text-xs font-bold text-slate-800"><?php echo __t('stat_mla_label'); ?></div>
                        <div class="text-[10px] text-slate-500"><?php echo __t('stat_mla_sub'); ?></div>
                    </div>
                </div>

                <!-- Stat 2: Total MPs -->
                <div class="flex items-start gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                    <div class="w-10 h-10 rounded-lg bg-blue-100 text-blue-800 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-2xl font-black text-slateNavy"><?php echo __t('stat_mp_num'); ?></div>
                        <div class="text-xs font-bold text-slate-800"><?php echo __t('stat_mp_label'); ?></div>
                        <div class="text-[10px] text-slate-500"><?php echo __t('stat_mp_sub'); ?></div>
                    </div>
                </div>

                <!-- Stat 3: Assembly Seats -->
                <div class="flex items-start gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                    <div class="w-10 h-10 rounded-lg bg-emerald-100 text-emerald-800 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-2xl font-black text-slateNavy"><?php echo __t('stat_const_num'); ?></div>
                        <div class="text-xs font-bold text-slate-800"><?php echo __t('stat_const_label'); ?></div>
                    </div>
                </div>

                <!-- Stat 4: Total Districts -->
                <div class="flex items-start gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                    <div class="w-10 h-10 rounded-lg bg-amber-100 text-amber-800 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-2xl font-black text-slateNavy"><?php echo __t('stat_dist_num'); ?></div>
                        <div class="text-xs font-bold text-slate-800"><?php echo __t('stat_dist_label'); ?></div>
                        <div class="text-[10px] text-slate-500"><?php echo __t('stat_dist_sub'); ?></div>
                    </div>
                </div>

                <!-- Stat 5: Allocated Funds -->
                <div class="flex items-start gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                    <div class="w-10 h-10 rounded-lg bg-indigo-100 text-indigo-800 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-xl font-black text-slateNavy"><?php echo __t('stat_fund_num'); ?></div>
                        <div class="text-xs font-bold text-slate-800"><?php echo __t('stat_fund_label'); ?></div>
                        <div class="text-[10px] text-slate-500"><?php echo __t('stat_fund_sub'); ?></div>
                    </div>
                </div>

                <!-- Stat 6: Development Projects -->
                <div class="flex items-start gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                    <div class="w-10 h-10 rounded-lg bg-rose-100 text-rose-800 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-2xl font-black text-slateNavy"><?php echo __t('stat_proj_num'); ?></div>
                        <div class="text-xs font-bold text-slate-800"><?php echo __t('stat_proj_label'); ?></div>
                        <div class="text-[10px] text-slate-500"><?php echo __t('stat_proj_sub'); ?></div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- CORE FEATURES SECTION ("No Politics पर आप क्या-क्या जान सकते हैं?") -->
    <section id="features" class="py-14 bg-offwhite">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-3xl mx-auto mb-10">
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slateNavy tracking-tight">
                    <?php echo __t('features_heading'); ?>
                </h2>
                <div class="w-16 h-1 bg-brandTeal mx-auto mt-2 rounded"></div>
            </div>

            <!-- 6 Feature Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <!-- Card 1: Funds & Expenditure -->
                <div class="card-hover-effect bg-white border border-slate-200 rounded-xl p-6 shadow-sm flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-amber-50 border border-amber-200 text-amber-600 flex items-center justify-center mb-4 group-hover:bg-amber-500 group-hover:text-white transition-all shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slateNavy mb-2"><?php echo __t('feat_1_title'); ?></h3>
                        <p class="text-sm text-slate-600">MPLADS, विधायक निधि, केंद्र व राज्य प्रायोजित योजनाओं के तहत खर्च का विस्तृत ब्योरा।</p>
                    </div>
                    <div class="mt-6 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-amber-700">
                        <span>विवरण देखें</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </div>
                </div>

                <!-- Card 2: Development Projects -->
                <div class="card-hover-effect bg-white border border-slate-200 rounded-xl p-6 shadow-sm flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-cyan-50 border border-cyan-200 text-cyan-600 flex items-center justify-center mb-4 group-hover:bg-cyan-600 group-hover:text-white transition-all shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slateNavy mb-2"><?php echo __t('feat_2_title'); ?></h3>
                        <p class="text-sm text-slate-600">सड़क, पुल, स्कूल, अस्पताल और जलापूर्ति जैसी स्थानीय परियोजनाओं की जमीनी प्रगति।</p>
                    </div>
                    <div class="mt-6 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-cyan-700">
                        <span>ट्रैकर खोलें</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </div>
                </div>

                <!-- Card 3: Parliament & Assembly -->
                <div class="card-hover-effect bg-white border border-slate-200 rounded-xl p-6 shadow-sm flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-purple-50 border border-purple-200 text-purple-600 flex items-center justify-center mb-4 group-hover:bg-purple-600 group-hover:text-white transition-all shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slateNavy mb-2"><?php echo __t('feat_3_title'); ?></h3>
                        <p class="text-sm text-slate-600">सदन में उपस्थिति, पूछे गए प्रश्न, प्रस्तुत प्राइवेट मेंबर बिल और बहसों में भागीदारी।</p>
                    </div>
                    <div class="mt-6 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-purple-700">
                        <span>गतिविधि देखें</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </div>
                </div>

                <!-- Card 4: Election History -->
                <div class="card-hover-effect bg-white border border-slate-200 rounded-xl p-6 shadow-sm flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-pink-50 border border-pink-200 text-pink-600 flex items-center justify-center mb-4 group-hover:bg-pink-600 group-hover:text-white transition-all shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slateNavy mb-2"><?php echo __t('feat_4_title'); ?></h3>
                        <p class="text-sm text-slate-600">पिछले चुनावों के नतीजे, जीत का अंतर, मतदान प्रतिशत और उम्मीदवारों का तुलनात्मक ब्योरा।</p>
                    </div>
                    <div class="mt-6 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-pink-700">
                        <span>इतिहास जांचें</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </div>
                </div>

                <!-- Card 5: Promises & Progress -->
                <div class="card-hover-effect bg-white border border-slate-200 rounded-xl p-6 shadow-sm flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-teal-50 border border-teal-200 text-teal-600 flex items-center justify-center mb-4 group-hover:bg-teal-600 group-hover:text-white transition-all shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slateNavy mb-2"><?php echo __t('feat_5_title'); ?></h3>
                        <p class="text-sm text-slate-600">घोषणापत्र के वादों की वर्तमान स्थिति - कितने पूरे हुए, कितने प्रगति पर हैं और क्या लंबित है।</p>
                    </div>
                    <div class="mt-6 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-teal-700">
                        <span>वादे ट्रैक करें</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </div>
                </div>

                <!-- Card 6: Comprehensive Report Card -->
                <div class="card-hover-effect bg-white border border-slate-200 rounded-xl p-6 shadow-sm flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-blue-50 border border-blue-200 text-blue-600 flex items-center justify-center mb-4 group-hover:bg-blue-600 group-hover:text-white transition-all shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slateNavy mb-2"><?php echo __t('feat_6_title'); ?></h3>
                        <p class="text-sm text-slate-600">आपके क्षेत्र का 360-डिग्री स्कोरकार्ड - फंड, विकास कार्य, जनसुनवाई और प्रतिनिधि का मूल्यांकन।</p>
                    </div>
                    <div class="mt-6 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-blue-700">
                        <span>रिपोर्ट कार्ड देखें</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- DYNAMIC TWO-COLUMN SECTION: LATEST UPDATES & REPORT CARD LOOKUP -->
    <section id="report-card-section" class="py-14 bg-white border-y border-borderMuted">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <!-- Left Column: ताजा अपडेट (Latest Updates) -->
                <div class="lg:col-span-6 bg-offwhite border border-slate-200 rounded-2xl p-6 shadow-sm">
                    <div class="flex items-center justify-between mb-6 pb-3 border-b border-slate-200">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-red-600 animate-ping"></span>
                            <h3 class="text-xl font-extrabold text-slateNavy"><?php echo __t('updates_heading'); ?></h3>
                        </div>
                        <a href="#all-updates" class="text-xs font-bold text-brandTeal hover:underline flex items-center gap-1">
                            <span><?php echo __t('view_all'); ?></span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>

                    <!-- Updates List -->
                    <div class="space-y-4">
                        
                        <!-- Item 1: Road Project -->
                        <div class="bg-white p-4 rounded-xl border border-slate-200 hover:border-brandTeal transition-all shadow-sm">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-800 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-200">
                                    <?php echo __t('tag_proj'); ?>
                                </span>
                                <div class="flex items-center gap-2 text-xs text-slate-500 font-medium">
                                    <span>📅 <?php echo __t('upd_1_date'); ?></span>
                                    <span>📍 <?php echo __t('upd_1_loc'); ?></span>
                                </div>
                            </div>
                            <p class="text-sm font-bold text-slateNavy leading-snug">
                                <?php echo __t('upd_1_text'); ?>
                            </p>
                        </div>

                        <!-- Item 2: Parliament Activity -->
                        <div class="bg-white p-4 rounded-xl border border-slate-200 hover:border-brandTeal transition-all shadow-sm">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-[11px] font-bold uppercase tracking-wider text-blue-800 bg-blue-50 px-2.5 py-0.5 rounded-full border border-blue-200">
                                    <?php echo __t('tag_sansad'); ?>
                                </span>
                                <div class="flex items-center gap-2 text-xs text-slate-500 font-medium">
                                    <span>📅 <?php echo __t('upd_2_date'); ?></span>
                                    <span>📍 <?php echo __t('upd_2_loc'); ?></span>
                                </div>
                            </div>
                            <p class="text-sm font-bold text-slateNavy leading-snug">
                                <?php echo __t('upd_2_text'); ?>
                            </p>
                        </div>

                        <!-- Item 3: Fund Release -->
                        <div class="bg-white p-4 rounded-xl border border-slate-200 hover:border-brandTeal transition-all shadow-sm">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-[11px] font-bold uppercase tracking-wider text-amber-800 bg-amber-50 px-2.5 py-0.5 rounded-full border border-amber-200">
                                    <?php echo __t('tag_fund'); ?>
                                </span>
                                <div class="flex items-center gap-2 text-xs text-slate-500 font-medium">
                                    <span>📅 <?php echo __t('upd_3_date'); ?></span>
                                    <span>📍 <?php echo __t('upd_3_loc'); ?></span>
                                </div>
                            </div>
                            <p class="text-sm font-bold text-slateNavy leading-snug">
                                <?php echo __t('upd_3_text'); ?>
                            </p>
                        </div>

                    </div>
                </div>

                <!-- Right Column: किसी क्षेत्र का रिपोर्ट कार्ड देखें (Report Card Box) -->
                <div class="lg:col-span-6 bg-gradient-to-br from-slate-900 to-slate-800 text-white rounded-2xl p-6 sm:p-8 shadow-xl flex flex-col justify-between">
                    
                    <div>
                        <div class="flex items-center gap-2 text-amber-400 mb-2">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-xs font-bold uppercase tracking-wider"><?php echo ($current_lang === 'hi') ? 'नागरिक सेवा' : 'Citizen Service'; ?></span>
                        </div>
                        <h3 class="text-2xl font-black tracking-tight text-white mb-2">
                            <?php echo __t('rc_box_title'); ?>
                        </h3>
                        <p class="text-slate-300 text-sm leading-relaxed mb-6">
                            <?php echo __t('rc_box_subtitle'); ?>
                        </p>

                        <!-- Dynamic Cascading Selectors -->
                        <div class="space-y-4">
                            <!-- State Dropdown -->
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-300 mb-1.5"><?php echo __t('select_state_placeholder'); ?></label>
                                <select id="rc-state-select" class="w-full bg-slate-800 border border-slate-700 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-brandCyan focus:ring-1 focus:ring-brandCyan transition-colors">
                                    <option value="">-- <?php echo __t('select_state_placeholder'); ?> --</option>
                                    <option value="bihar"><?php echo __t('state_bihar'); ?> (Bihar)</option>
                                    <option value="jharkhand"><?php echo __t('state_jharkhand'); ?> (Jharkhand)</option>
                                </select>
                            </div>

                            <!-- Constituency Dropdown -->
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-300 mb-1.5"><?php echo __t('select_const_placeholder'); ?></label>
                                <select id="rc-const-select" disabled class="w-full bg-slate-800/80 border border-slate-700 text-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-brandCyan focus:ring-1 focus:ring-brandCyan transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                                    <option value="">-- <?php echo __t('select_const_placeholder'); ?> --</option>
                                </select>
                            </div>

                            <!-- CTA Button -->
                            <button id="rc-view-btn" class="w-full bg-brandOrange hover:bg-brandOrangeDark text-white font-black text-sm uppercase tracking-wider py-3.5 px-6 rounded-xl shadow-lg transition-all flex items-center justify-center gap-2 mt-2">
                                <svg class="w-5 h-5 text-slate-950" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                                <span><?php echo __t('view_report_btn'); ?></span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </button>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-800 text-[11px] text-slate-400 flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <span>सभी रिपोर्ट कार्ड आधिकारिक और संसदीय/विधानसभा दस्तावेजों पर आधारित हैं।</span>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- METHODOLOGY: "यह कैसे काम करता है?" (How It Works) -->
    <section class="py-16 bg-offwhite">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-2xl mx-auto mb-12">
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slateNavy tracking-tight">
                    <?php echo __t('how_heading'); ?>
                </h2>
                <div class="w-16 h-1 bg-brandTeal mx-auto mt-2 rounded"></div>
            </div>

            <!-- 4 Connected Steps -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 relative">
                
                <!-- Step 1 -->
                <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm relative">
                    <div class="w-10 h-10 rounded-full bg-cyan-600 text-white font-black text-sm flex items-center justify-center mb-4 shadow">
                        1
                    </div>
                    <div class="text-slate-400 mb-2">
                        <svg class="w-6 h-6 text-brandTeal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-slateNavy mb-1"><?php echo __t('step_1_title'); ?></h3>
                    <p class="text-xs text-slate-500">चुनाव आयोग, MPLADS, विधानसभा और संसद की सार्वजनिक कार्यवाहियों से डेटा प्राप्ति।</p>
                </div>

                <!-- Step 2 -->
                <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm relative">
                    <div class="w-10 h-10 rounded-full bg-emerald-600 text-white font-black text-sm flex items-center justify-center mb-4 shadow">
                        2
                    </div>
                    <div class="text-slate-400 mb-2">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-slateNavy mb-1"><?php echo __t('step_2_title'); ?></h3>
                    <p class="text-xs text-slate-500">दस्तावेजों का क्रॉस-सत्यापन, दोहराव हटाना और निष्पक्ष सांख्यिकीय विश्लेषण।</p>
                </div>

                <!-- Step 3 -->
                <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm relative">
                    <div class="w-10 h-10 rounded-full bg-blue-600 text-white font-black text-sm flex items-center justify-center mb-4 shadow">
                        3
                    </div>
                    <div class="text-slate-400 mb-2">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-slateNavy mb-1"><?php echo __t('step_3_title'); ?></h3>
                    <p class="text-xs text-slate-500">जटिल सरकारी तालिकाओं को सरल ग्राफ़, रिपोर्ट कार्ड और नक्शों में रूपांतरण।</p>
                </div>

                <!-- Step 4 -->
                <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm relative">
                    <div class="w-10 h-10 rounded-full bg-purple-600 text-white font-black text-sm flex items-center justify-center mb-4 shadow">
                        4
                    </div>
                    <div class="text-slate-400 mb-2">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-slateNavy mb-1"><?php echo __t('step_4_title'); ?></h3>
                    <p class="text-xs text-slate-500">प्रत्येक नागरिक, शोधकर्ता और पत्रकार के लिए निःशुल्क और सार्वजनिक पहुँच।</p>
                </div>

            </div>

        </div>
    </section>

</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
