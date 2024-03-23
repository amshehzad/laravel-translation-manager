<?php

namespace Barryvdh\TranslationManager;

use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;
use Barryvdh\TranslationManager\Livewire\LocaleManager;
use Barryvdh\TranslationManager\Livewire\TranslationEditor;
use Barryvdh\TranslationManager\Livewire\TranslationManager;

class ManagerServiceProvider extends ServiceProvider
{
    public static function basePath(string $path): string
    {
        return __DIR__.'/..'.$path;
    }

    public function register(): void
    {
        // Register the config publish path
        $this->mergeConfigFrom(__DIR__.'/../config/translation-manager.php', 'translation-manager');
        $this->publishes([__DIR__.'/../config/translation-manager.php' => config_path('translation-manager.php')], 'config');

        $this->app->singleton('translation-manager', function ($app) {
            return $app->make(Manager::class);
        });
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'translation-manager');

        $this->registerCommands();
        $this->registerPublishables();
        $this->registerLivewireComponents();
        $this->registerRoutes();
    }

    protected function registerCommands(): void
    {
        $this->commands([
            Commands\CleanCommand::class,
            Commands\ExportCommand::class,
            Commands\FindCommand::class,
            Commands\ImportCommand::class,
        ]);
    }

    protected function registerRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }

    public function registerLivewireComponents(): self
    {
        if (!class_exists(Livewire::class)) {
            return $this;
        }

        Livewire::component('locale-manager', LocaleManager::class);
        Livewire::component('translation-manager', TranslationManager::class);
        Livewire::component('translation-editor', TranslationEditor::class);

        return $this;
    }

    protected function registerPublishables(): self
    {
        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/translation-manager'),
        ], 'views');

        $this->publishes([
            __DIR__.'/../database/migrations' => base_path('database/migrations'),
        ], 'migrations');

        return $this;
    }
}
