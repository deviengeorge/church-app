<?php

namespace App\Filament\Pages;

use Filament\Facades\Filament;
use Filament\Http\Livewire\Auth\Login as FilamentLogin;


class Login extends FilamentLogin
{
    public function mount(): void
    {
        if (app()->environment('local')) {
            $this->form->fill([
                'email' => 'devien@gmail.com',
                'password' => 'devo',
                'remember' => true
            ]);
        }
    }
}
