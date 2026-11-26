<?php
// data/extract_flate_images.php
$content = file_get_contents(__DIR__ . '/jharkhand_mps.pdf');
$out_dir = dirname(__DIR__) . '/assets/images/mps';
if (!is_dir($out_dir)) {
    mkdir($out_dir, 0777, true);
}

// Find all Image objects
$pattern = '/<<([^>]*(?:Width\s+(\d+))[^>]*(?:Height\s+(\d+))[^>]*(?:Length\s+(\d+))[^>]*)>>\s*stream[\r\n]+(.*?)[\r\n]+endstream/s';

preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);
echo "Matched image streams: " . count($matches) . "\n";

$saved = 0;
foreach ($matches as $i => $m) {
    $header = $m[1];
    
    // Extract Width, Height, BitsPerComponent
    preg_match('/Width\s+(\d+)/', $header, $wm);
    preg_match('/Height\s+(\d+)/', $header, $hm);
    $w = (int)$wm[1];
    $h = (int)$hm[1];
    
    $stream_data = $m[5];
    $raw = @gzuncompress($stream_data);
    if ($raw === false) {
        // try with substr
        continue;
    }
    
    echo "Image $i: {$w}x{$h}, decompressed length: " . strlen($raw) . " expected: " . ($w * $h * 3) . "\n";
    
    if (strlen($raw) >= ($w * $h * 3)) {
        $img = imagecreatetruecolor($w, $h);
        $offset = 0;
        for ($y = 0; $y < $h; $y++) {
            for ($x = 0; $x < $w; $x++) {
                $r = ord($raw[$offset++]);
                $g = ord($raw[$offset++]);
                $b = ord($raw[$offset++]);
                $col = ($r << 16) | ($g << 8) | $b;
                imagesetpixel($img, $x, $y, $col);
            }
        }
        $saved++;
        $out_file = $out_dir . "/jharkhand_mp_{$saved}.jpg";
        imagejpeg($img, $out_file, 90);
        imagedestroy($img);
        echo "  -> Saved {$out_file}\n";
    }
}
echo "Total extracted: {$saved}\n";
