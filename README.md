# KNOW POLITICS (knowpolitics.co.in)
> **Educating Everyone About Indian Democracy** • *भारतीय लोकतंत्र के प्रति जन-जागरूकता*

An open-source, civic-tech web portal for tracking elected public representatives (Members of Parliament - Lok Sabha & Members of Legislative Assembly - Vidhan Sabha), their performance report cards, developmental works, and interactive state-by-state mapping across India.

---

## 🚀 Key Features

1. **Current Official Survey of India Interactive Map (Post-2019):**
   - High-fidelity vector SVG map featuring all **28 States and 8 Union Territories**.
   - Accurately depicts post-2019 administrative boundaries, with **Ladakh (LA)** and **Jammu & Kashmir (JK)** demarcated as separate Union Territories according to the official Survey of India boundary.
   - Interactive state hover tooltips, state abbreviation labels, and one-click filtering of representatives.

2. **Public Representatives Database (MPs & MLAs):**
   - 18th Lok Sabha Members of Parliament (MPs) across India.
   - Legislative Assembly Members (MLAs) with constituency numbers, parties, and contact information.
   - Auto-fallback data architecture: Reads from **MySQL Database** when available, with automatic failover to curated **JSON seed cache**.

3. **Performance Scorecards & Work Tracker:**
   - Detailed individual report cards for representatives.
   - MPLADS / MLALADS development fund allocation, expenditure, and utilization rates.
   - Civic works catalog categorized by sector (Roads, Healthcare, Education, Rural Development, Water).

4. **Bilingual Support (English & Hindi):**
   - Full localization support with seamless one-click language toggle (`?lang=en` / `?lang=hi`).

5. **Data Export & Sharing:**
   - One-click copy/share of representative information.
   - Downloadable CSV data formats (`mlas_all.csv`, `mps_all.csv`) and MySQL SQL dumps (`knowpolitics_mlas.sql`, `knowpolitics_mps.sql`).

---

## 🛠️ Tech Stack & Architecture

- **Backend:** PHP 8.x (Zero heavy frameworks, clean native routing, instant page renders)
- **Database:** MySQL / MariaDB with PDO (prepared statements, index-optimized) + JSON Cache fallback
- **Frontend:** Tailwind CSS, responsive mobile-first grid, accessible semantic HTML5
- **Mapping:** Scalable Vector Graphics (SVG) using Conic Equal Area projection matching official Survey of India cartography

---

## 📂 Project Directory Structure

```text
KnowPolitics.co.in/
├── assets/
│   ├── css/             # Custom styles
│   └── images/          # Official brand logo and favicons
├── data/
│   ├── india_map_paths.json # 36 States/UTs vector boundary paths & centroids
│   ├── states_india.json    # State metadata (seats, capital, region)
│   ├── mlas_all.json        # MLA database seed
│   ├── mps_all_india.json   # Lok Sabha MP database seed
│   └── works_data.json      # Development works catalogue
├── database/
│   ├── import.php           # Web & CLI MySQL auto-importer
│   ├── knowpolitics_mlas.sql # SQL table & data dump for MLAs
│   └── knowpolitics_mps.sql  # SQL table & data dump for MPs
├── includes/
│   ├── config.php       # App settings & language handler
│   ├── db.php           # PDO connection & unified query layer
│   ├── header.php       # Responsive top navigation & brand bar
│   └── footer.php       # Footer links & civic disclaimer
├── lang/
│   ├── en.php           # English dictionary
│   └── hi.php           # Hindi dictionary
├── index.php            # Homepage with quick search & featured stats
├── states.php           # Interactive India Map & state directory
├── mla.php              # MLA directory & filters
├── mp.php               # MP directory & filters
├── report-card.php      # Representative scorecard & developmental works
└── search.php           # Global search for representatives and projects
```

---

## ⚙️ Quick Setup & Running Locally

### 1. Requirements
- PHP 8.0 or higher
- MySQL 5.7+ / 8.0+ (Optional; app runs on JSON fallback if MySQL is offline)

### 2. Start Built-in PHP Server
```bash
php -S localhost:8000
```
Open your browser and navigate to `http://localhost:8000`.

### 3. (Optional) Setup MySQL Database
To import the database, run:
```bash
php database/import.php
```
Or configure your environment variables in `.env` / server configuration:
- `DB_HOST`: `127.0.0.1`
- `DB_PORT`: `3306`
- `DB_NAME`: `knowpolitics`
- `DB_USER`: `root`
- `DB_PASS`: `""`

---

## 📜 License
This project is open-source under the MIT License.
