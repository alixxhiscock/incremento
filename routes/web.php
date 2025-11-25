<?php

use App\Http\Controllers\MiningController;
use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('inventory', [InventoryController::class, 'showInventoryPage'])
    ->middleware(['auth', 'verified'])
    ->name('inventory');

Route::get('show-inventory', [InventoryController::class, 'showInventoryData'])
    ->middleware(['auth', 'verified'])
    ->name('show.inventory');

Route::view('crafting', 'crafting')
    ->middleware(['auth', 'verified'])
    ->name('crafting');

Route::view('mining', 'mining')
    ->middleware(['auth', 'verified'])
    ->name('mining');

Route::post('/mine/{item}', [MiningController::class, 'mineItem'])
    ->middleware(['auth', 'verified'])
    ->name('mine.item');

Route::view('woodcutting', 'woodcutting')
    ->middleware(['auth', 'verified'])
    ->name('woodcutting');

Route::view('foraging', 'foraging')
    ->middleware(['auth', 'verified'])
    ->name('foraging');

Route::view('farming', 'farming')
    ->middleware(['auth', 'verified'])
    ->name('farming');

Route::view('fishing', 'fishing')
    ->middleware(['auth', 'verified'])
    ->name('fishing');

Route::view('brewing', 'brewing')
    ->middleware(['auth', 'verified'])
    ->name('brewing');

Route::view('alchemy', 'alchemy')
    ->middleware(['auth', 'verified'])
    ->name('alchemy');

Route::view('cooking', 'cooking')
    ->middleware(['auth', 'verified'])
    ->name('cooking');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

require __DIR__.'/auth.php';
