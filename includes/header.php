<?php
// includes/header.php
global $current_lang;
$other_lang = ($current_lang === 'hi') ? 'en' : 'hi';
$other_lang_label = ($current_lang === 'hi') ? 'English' : 'हिंदी';
?>
<!DOCTYPE html>
<html lang="<?php echo $current_lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo __t('brand_name'); ?> - <?php echo __t('tagline'); ?></title>
    <!-- Tailwind CSS (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        offwhite: '#F5F4F0',
                        surface: '#FFFFFF',
                        borderMuted: '#E2DFD6',
                        slateNavy: '#152B5D',
                        brandNavy: '#152B5D',
                        brandNavyDark: '#0D1C3E',
                        brandNavyLight: '#EDF2F9',
                        brandOrange: '#E3771C',
                        brandOrangeDark: '#C86412',
                        brandOrangeLight: '#FFF4E8',
                        brandGreen: '#2D643D',
                        brandGreenDark: '#204A2C',
                        brandGreenLight: '#EBF5EE',
                        textMuted: '#5C6B84',
                        brandTeal: '#E3771C',
                        brandTealHover: '#C86412',
                        brandCyan: '#152B5D',
                        stateBihar: '#991B1B',
                        stateBiharLight: '#FFF1F2',
                        stateJharkhand: '#2D643D',
                        stateJharkhandLight: '#EBF5EE',
                    },
                    fontFamily: {
                        sans: ['Inter', 'Noto Sans Devanagari', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/images/favicon.png">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="assets/images/favicon.png">

    <!-- Google Fonts: Inter & Noto Sans Devanagari for pristine Hindi & English typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Noto+Sans+Devanagari:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-offwhite text-slateNavy font-sans antialiased min-h-screen flex flex-col">

    <!-- Top Navigation Bar -->
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-borderMuted shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20 sm:h-24 py-1.5">
                
                <!-- Logo & Brand (Enlarged) -->
                <div class="flex items-center">
                    <a href="index.php?lang=<?php echo $current_lang; ?>" class="flex items-center group" title="Know Politics">
                        <img src="assets/images/logo.jpg" alt="Know Politics Logo" class="h-16 sm:h-20 max-h-20 w-auto object-contain rounded-lg shadow-sm border border-slate-200/80 bg-white p-1 group-hover:scale-105 transition-transform">
                    </a>
                </div>

                <!-- Desktop Navigation Links -->
                <nav class="hidden lg:flex items-center space-x-1">
                    <a href="index.php?lang=<?php echo $current_lang; ?>" class="px-3 py-2 text-sm font-bold text-brandTeal border-b-2 border-brandTeal transition-colors">
                        <?php echo __t('nav_home'); ?>
                    </a>
                    <a href="states.php?lang=<?php echo $current_lang; ?>" class="px-3 py-2 text-sm font-medium text-slate-700 hover:text-brandTeal transition-colors flex items-center gap-1">
                        <span>🗺️ India Map</span>
                    </a>
                    <a href="mla.php?lang=<?php echo $current_lang; ?>" class="px-3 py-2 text-sm font-medium text-slate-700 hover:text-brandTeal transition-colors">
                        <?php echo __t('nav_mla'); ?>
                    </a>
                    <a href="mp.php?lang=<?php echo $current_lang; ?>" class="px-3 py-2 text-sm font-medium text-slate-700 hover:text-brandTeal transition-colors">
                        <?php echo __t('nav_mp'); ?>
                    </a>
                    <a href="search.php?tab=works&lang=<?php echo $current_lang; ?>" class="px-3 py-2 text-sm font-medium text-slate-700 hover:text-brandTeal transition-colors">
                        <?php echo __t('nav_projects'); ?>
                    </a>
                    <a href="report-card.php?lang=<?php echo $current_lang; ?>" class="px-3 py-2 text-sm font-medium text-slate-700 hover:text-brandTeal transition-colors">
                        <?php echo __t('nav_report'); ?>
                    </a>
                </nav>

                <!-- Right Utilities: Language Switcher, Search, Alerts, Auth, Contribute -->
                <div class="flex items-center space-x-3">
                    
                    <!-- Language Toggle Pill -->
                    <a href="?lang=<?php echo $other_lang; ?>" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold border border-slate-300 bg-slate-50 hover:bg-slate-100 text-slate-800 transition-all shadow-sm">
                        <svg class="w-3.5 h-3.5 text-brandOrange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                        </svg>
                        <span><?php echo $other_lang_label; ?></span>
                    </a>

                    <!-- Contribute Button -->
                    <a href="#contribute" class="inline-flex items-center gap-1.5 bg-brandOrange hover:bg-brandOrangeDark text-white text-sm font-bold px-4 py-2 rounded-lg shadow-sm hover:shadow transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <span><?php echo __t('contribute'); ?></span>
                    </a>

                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-btn" class="lg:hidden p-2 text-slate-700 rounded-md hover:bg-slate-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Nav Menu (Collapsible) -->
        <div id="mobile-menu" class="hidden lg:hidden border-t border-slate-200 bg-white px-4 pt-2 pb-4 space-y-1">
            <a href="index.php?lang=<?php echo $current_lang; ?>" class="block px-3 py-2 text-base font-semibold text-brandTeal"><?php echo __t('nav_home'); ?></a>
            <a href="states.php?lang=<?php echo $current_lang; ?>" class="block px-3 py-2 text-base font-medium text-slate-700">🗺️ India Map & States</a>
            <a href="mla.php?lang=<?php echo $current_lang; ?>" class="block px-3 py-2 text-base font-medium text-slate-700"><?php echo __t('nav_mla'); ?></a>
            <a href="mp.php?lang=<?php echo $current_lang; ?>" class="block px-3 py-2 text-base font-medium text-slate-700"><?php echo __t('nav_mp'); ?></a>
            <a href="search.php?tab=works&lang=<?php echo $current_lang; ?>" class="block px-3 py-2 text-base font-medium text-slate-700"><?php echo __t('nav_projects'); ?></a>
            <a href="report-card.php?lang=<?php echo $current_lang; ?>" class="block px-3 py-2 text-base font-medium text-slate-700"><?php echo __t('nav_report'); ?></a>
            <a href="#features" class="block px-3 py-2 text-base font-medium text-slate-700"><?php echo __t('nav_analysis'); ?></a>
            <div class="pt-2 border-t border-slate-100 flex justify-end items-center">
                <a href="?lang=<?php echo $other_lang; ?>" class="text-xs font-bold text-brandOrange"><?php echo $other_lang_label; ?></a>
            </div>
        </div>
    </header>
