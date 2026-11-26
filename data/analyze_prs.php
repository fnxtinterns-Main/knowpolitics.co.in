<?php
// data/analyze_prs.php
$ctx = stream_context_create([
    'ssl' => ['verify_peer' => false, 'verify_peer_name' => false],
    'http' => ['header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)\r\n", 'timeout' => 20]
]);

$html = @file_get_contents("https://prsindia.org/", false, $ctx);
if ($html === false) {
    die("Failed to fetch PRS India\n");
}

echo "PRS India Homepage size: " . strlen($html) . " bytes\n";
file_put_contents(__DIR__ . '/prs_home.html', $html);

// Extract color codes or key design classes
preg_match_all('/#[a-fA-F0-9]{3,6}/', $html, $colors);
echo "Unique colors found in HTML: " . count(array_unique($colors[0])) . "\n";

// Extract primary navigation items
preg_match_all('/<nav[^>]*>(.*?)<\/nav>/is', $html, $navs);
echo "Navbars found: " . count($navs[0]) . "\n";

// Extract section headings
preg_match_all('/<h[234][^>]*>(.*?)<\/h[234]>/is', $html, $headings);
echo "Headings found:\n";
foreach (array_slice($headings[1], 0, 10) as $h) {
    echo "  - " . trim(preg_replace('/\s+/', ' ', strip_tags($h))) . "\n";
}
