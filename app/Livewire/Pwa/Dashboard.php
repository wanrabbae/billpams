<?php

namespace App\Livewire\Pwa;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.pwa.dashboard')->layout('components.layouts.pwa', ['header' => 'Beranda']);
    }
}
