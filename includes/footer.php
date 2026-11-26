<?php
// includes/footer.php
?>
    <!-- Trusted Sources & Verification Bar -->
    <section class="bg-white border-t border-borderMuted py-8 mt-16 shadow-inner">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-6">
                <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-slate-500 bg-slate-100 px-3 py-1 rounded-full">
                    <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <?php echo __t('sources_heading'); ?>
                </div>
            </div>

            <!-- Partner / Official Badges -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-7 gap-3 items-center">
                <!-- ECI -->
                <div class="flex items-center gap-2 p-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-800 text-xs font-semibold hover:border-slate-300 transition-colors">
                    <span class="w-6 h-6 rounded bg-amber-500/20 text-amber-800 flex items-center justify-center font-bold text-[10px]">ECI</span>
                    <span><?php echo __t('src_eci'); ?></span>
                </div>
                <!-- Lok Sabha -->
                <div class="flex items-center gap-2 p-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-800 text-xs font-semibold hover:border-slate-300 transition-colors">
                    <span class="w-6 h-6 rounded bg-blue-500/20 text-blue-800 flex items-center justify-center font-bold text-[10px]">LS</span>
                    <span><?php echo __t('src_sansad'); ?></span>
                </div>
                <!-- Bihar Vidhan Sabha -->
                <div class="flex items-center gap-2 p-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-800 text-xs font-semibold hover:border-slate-300 transition-colors">
                    <span class="w-6 h-6 rounded bg-rose-500/20 text-rose-800 flex items-center justify-center font-bold text-[10px]">BVS</span>
                    <span><?php echo __t('src_bihar'); ?></span>
                </div>
                <!-- Jharkhand Vidhan Sabha -->
                <div class="flex items-center gap-2 p-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-800 text-xs font-semibold hover:border-slate-300 transition-colors">
                    <span class="w-6 h-6 rounded bg-emerald-500/20 text-emerald-800 flex items-center justify-center font-bold text-[10px]">JVS</span>
                    <span><?php echo __t('src_jharkhand'); ?></span>
                </div>
                <!-- MPLADS -->
                <div class="flex items-center gap-2 p-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-800 text-xs font-semibold hover:border-slate-300 transition-colors">
                    <span class="w-6 h-6 rounded bg-cyan-500/20 text-cyan-800 flex items-center justify-center font-bold text-[10px]">MP</span>
                    <span><?php echo __t('src_mplads'); ?></span>
                </div>
                <!-- ADR -->
                <div class="flex items-center gap-2 p-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-800 text-xs font-semibold hover:border-slate-300 transition-colors">
                    <span class="w-6 h-6 rounded bg-red-500/20 text-red-800 flex items-center justify-center font-bold text-[10px]">ADR</span>
                    <span><?php echo __t('src_adr'); ?></span>
                </div>
                <!-- PRS Legislative Research -->
                <div class="flex items-center gap-2 p-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-800 text-xs font-semibold hover:border-slate-300 transition-colors">
                    <span class="w-6 h-6 rounded bg-indigo-500/20 text-indigo-800 flex items-center justify-center font-bold text-[10px]">PRS</span>
                    <span>PRS India</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Footer -->
    <footer class="bg-brandNavyDark text-slate-300 py-12 mt-auto border-t-4 border-brandOrange">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                
                <!-- Brand Info -->
                <div class="md:col-span-2">
                    <div class="flex items-center gap-3 mb-3">
                        <img src="assets/images/logo.jpg" alt="Know Politics" class="h-12 w-auto object-contain rounded bg-white p-1 shadow">
                        <div>
                            <span class="text-xl font-black text-white tracking-tight flex items-center">
                                <span>KNOW</span>&nbsp;<span class="text-brandOrange">POLITICS</span>
                            </span>
                            <p class="text-[10px] font-bold text-amber-200/90 uppercase tracking-wider">
                                Educating Everyone About Indian Democracy
                            </p>
                        </div>
                    </div>
                    <p class="text-slate-300 text-sm leading-relaxed max-w-md">
                        <?php echo __t('footer_disclaimer'); ?>
                    </p>
                </div>

                <!-- Quick Navigation -->
                <div>
                    <h4 class="text-white text-sm font-bold uppercase tracking-wider mb-3">
                        <?php echo ($current_lang === 'hi') ? 'त्वरित लिंक' : 'Quick Links'; ?>
                    </h4>
                    <ul class="space-y-2 text-sm text-slate-400">
                        <li><a href="#representatives" class="hover:text-white transition-colors"><?php echo __t('nav_mla'); ?> & <?php echo __t('nav_mp'); ?></a></li>
                        <li><a href="#features" class="hover:text-white transition-colors"><?php echo __t('nav_projects'); ?></a></li>
                        <li><a href="#report-card-section" class="hover:text-white transition-colors"><?php echo __t('nav_report'); ?></a></li>
                        <li><a href="#features" class="hover:text-white transition-colors"><?php echo __t('nav_history'); ?></a></li>
                    </ul>
                </div>

                <!-- States Covered -->
                <div>
                    <h4 class="text-white text-sm font-bold uppercase tracking-wider mb-3">
                        <?php echo ($current_lang === 'hi') ? 'शामिल राज्य' : 'States Covered'; ?>
                    </h4>
                    <ul class="space-y-2 text-sm text-slate-400">
                        <li class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                            <span><?php echo __t('state_bihar'); ?> (<?php echo __t('state_bihar_en'); ?>)</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <span><?php echo __t('state_jharkhand'); ?> (<?php echo __t('state_jharkhand_en'); ?>)</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Copyright -->
            <div class="pt-6 border-t border-slate-800 flex flex-col sm:flex-row justify-between items-center text-xs text-slate-500">
                <p>&copy; <?php echo date('Y'); ?> <?php echo __t('brand_name'); ?>. <?php echo __t('footer_rights'); ?></p>
                <div class="flex space-x-4 mt-2 sm:mt-0">
                    <a href="#privacy" class="hover:text-slate-400">Privacy Policy</a>
                    <a href="#terms" class="hover:text-slate-400">Terms of Transparency</a>
                    <a href="#contact" class="hover:text-slate-400">Contact & Feedback</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="assets/js/main.js"></script>
</body>
</html>
