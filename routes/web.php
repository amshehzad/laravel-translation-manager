<?php

use Barryvdh\TranslationManager\Livewire\TranslationManager;

Route::group(config('translation-manager.route'), function () {
    Route::get('/', TranslationManager::class);
});
