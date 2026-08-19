<?php
$files = [
    'app/Livewire/Admin/Pelanggan/Index.php' => ['save', 'delete', 'import'],
    'app/Livewire/Admin/Tarif/Index.php' => ['save', 'delete'],
    'app/Livewire/Admin/Meter/Create.php' => ['save'],
    'app/Livewire/Admin/Penagihan/Index.php' => ['generateTagihan'],
    'app/Livewire/Admin/Penagihan/Eksekusi.php' => ['executeAction'],
    'app/Livewire/Admin/Keuangan/Setoran/Index.php' => ['terimaSetoran', 'tolakSetoran'],
    'app/Livewire/Admin/Keuangan/Kas/Index.php' => ['save', 'voidTransaksi'],
];

foreach ($files as $file => $methods) {
    $content = file_get_contents($file);
    if (strpos($content, 'use Illuminate\Support\Facades\Auth;') === false) {
        $content = preg_replace('/namespace App\\\Livewire.*?;/s', "$0\n\nuse Illuminate\Support\Facades\Auth;", $content);
    }
    
    // Fix the previous sed mess in Pelanggan if present
    if ($file === 'app/Livewire/Admin/Pelanggan/Index.php') {
        $content = str_replace("    public function save()\n    {\n        abort_if(Auth::user()->role === \"pengawas\", 403, \"Akses Read-Only\");\n    {\n", "    public function save()\n    {\n        abort_if(\Auth::user()->role === 'pengawas', 403, 'Akses Read-Only');\n", $content);
    }

    foreach ($methods as $method) {
        if (strpos($content, "abort_if(\Auth::user()->role === 'pengawas'") === false || $file === 'app/Livewire/Admin/Pelanggan/Index.php') {
             // For methods that might have parameters
             $pattern = "/public function $method\((.*?)\)\s*\{/";
             $replacement = "public function $method($1)\n    {\n        abort_if(\Auth::user()->role === 'pengawas', 403, 'Akses Read-Only');";
             $content = preg_replace($pattern, $replacement, $content);
        }
    }
    file_put_contents($file, $content);
    echo "Patched $file\n";
}
