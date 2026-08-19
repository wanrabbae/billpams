<?php
$files = [
    'resources/views/components/layouts/pwa.blade.php',
    'resources/views/layouts/guest.blade.php'
];

$headAdd = '
    <link rel="manifest" href="{{ asset(\'manifest.json\') }}">
    <meta name="theme-color" content="#1d4ed8">
    <link rel="apple-touch-icon" href="{{ asset(\'logo_billpam.png\') }}">
    <script>
        if (\'serviceWorker\' in navigator) {
            window.addEventListener(\'load\', () => {
                navigator.serviceWorker.register(\'/sw.js\');
            });
        }
    </script>
';

foreach($files as $file) {
    if(file_exists($file)) {
        $content = file_get_contents($file);
        if (strpos($content, '<link rel="manifest"') === false) {
            $content = str_replace('</title>', '</title>'.$headAdd, $content);
            file_put_contents($file, $content);
            echo "Patched $file\n";
        }
    }
}
