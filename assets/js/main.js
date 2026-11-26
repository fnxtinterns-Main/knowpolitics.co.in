// assets/js/main.js - Interactive client logic

document.addEventListener('DOMContentLoaded', () => {
    // 1. Mobile navigation toggler
    const mobileBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    if (mobileBtn && mobileMenu) {
        mobileBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // 2. Cascading Constituency Dropdown for Report Card Box
    const stateSelect = document.getElementById('rc-state-select');
    const constSelect = document.getElementById('rc-const-select');
    const viewReportBtn = document.getElementById('rc-view-btn');

    let constituencyData = null;

    // Fetch constituencies seed data
    fetch('data/constituencies.json')
        .then(response => response.json())
        .then(data => {
            constituencyData = data;
        })
        .catch(err => {
            console.error('Could not load constituencies:', err);
        });

    if (stateSelect && constSelect) {
        stateSelect.addEventListener('change', () => {
            const selectedState = stateSelect.value;
            constSelect.innerHTML = '<option value="">-- ' + (document.documentElement.lang === 'hi' ? 'विधानसभा / लोकसभा चुनें' : 'Select Constituency') + ' --</option>';

            if (selectedState && constituencyData && constituencyData[selectedState]) {
                const list = constituencyData[selectedState];
                const isHi = document.documentElement.lang === 'hi';

                list.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.textContent = (isHi ? item.name_hi : item.name_en) + ' (' + item.type + ')';
                    constSelect.appendChild(option);
                });
                constSelect.disabled = false;
            } else {
                constSelect.disabled = true;
            }
        });

        if (viewReportBtn) {
            viewReportBtn.addEventListener('click', () => {
                const state = stateSelect.value;
                const constId = constSelect.value;
                const isHi = document.documentElement.lang === 'hi';

                if (!state || !constId) {
                    alert(isHi ? 'कृपया पहले राज्य और विधानसभा/लोकसभा क्षेत्र चुनें।' : 'Please select both state and constituency first.');
                    return;
                }

                // Redirect to actual report card page
                const constName = constSelect.options[constSelect.selectedIndex].text.split('(')[0].trim();
                window.location.href = `report-card.php?const=${encodeURIComponent(constName)}&state=${encodeURIComponent(state)}`;
            });
        }
    }

    // 3. Search form handler - redirects to unified search page
    const heroSearchForm = document.getElementById('hero-search-form');
    if (heroSearchForm) {
        heroSearchForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const query = document.getElementById('hero-search-input').value.trim();
            const lang = document.documentElement.lang || 'en';
            if (!query) {
                alert(lang === 'hi' ? 'कृपया खोज के लिए कोई नाम या क्षेत्र दर्ज करें।' : 'Please enter a search term.');
                return;
            }
            window.location.href = `search.php?q=${encodeURIComponent(query)}&lang=${lang}`;
        });
    }
});
