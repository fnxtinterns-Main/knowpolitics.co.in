<?php
// data/extract_pdf_images.php - Extract embedded JPEG streams from jharkhand_mps.pdf
$pdf_file = __DIR__ . '/jharkhand_mps.pdf';
if (!file_exists($pdf_file)) {
    die("PDF not found\n");
}

$content = file_get_contents($pdf_file);
$img_dir = dirname(__DIR__) . '/assets/images/mps';
if (!is_dir($img_dir)) {
    mkdir($img_dir, 0777, true);
}

// Search for JPEG SOI (\xFF\xD8) and EOI (\xFF\xD9)
$offset = 0;
$count = 0;
while (($start = strpos($content, "\xFF\xD8\xFF", $offset)) !== false) {
    $end = strpos($content, "\xFF\xD9", $start);
    if ($end !== false) {
        $len = ($end + 2) - $start;
        $jpeg_data = substr($content, $start, $len);
        if ($len > 3000) { // filter out thumbnails/icons
            $count++;
            $file_path = $img_dir . "/jharkhand_mp_{$count}.jpg";
            file_put_contents($file_path, $jpeg_data);
            echo "Extracted image {$count}: {$len} bytes -> {$file_path}\n";
        }
        $offset = $end + 2;
    } else {
        break;
    }
}
echo "Total extracted: {$count} images\n";
