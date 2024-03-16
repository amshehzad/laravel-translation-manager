<?php

use Barryvdh\TranslationManager\Controller;
use Barryvdh\TranslationManager\Livewire\TranslationManager;

$config = array_merge(config('translation-manager.route'));
Route::group($config, function ($router) {
    Route::get('/', TranslationManager::class);

});
