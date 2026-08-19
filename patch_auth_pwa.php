<?php
$file = 'resources/views/components/layouts/auth.blade.php';
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

if(file_exists($file)) {
    $content = file_get_contents($file);
    if (strpos($content, '<link rel="manifest"') === false) {
        $content = str_replace('</title>', '</title>'.$headAdd, $content);
        file_put_contents($file, $content);
        echo "Patched $file\n";
    }
}
