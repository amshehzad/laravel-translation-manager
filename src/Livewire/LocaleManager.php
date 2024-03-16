<?php

namespace Barryvdh\TranslationManager\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Contracts\View\View;
use Barryvdh\TranslationManager\Manager;

class LocaleManager extends Component
{
    protected Manager $manager;
    public array $locales = [];

    #[Validate('required|size:2')]
    public $localeName = '';

    public function boot(Manager $manager): void
    {
        $this->manager = $manager;
    }

    public function mount(): void
    {
        $this->locales = $this->manager->getLocales();
    }

    public function render(): View
    {
        $theme = $this->manager->getConfig('template');

        return view("translation-manager::$theme.blocks.locale-manager");
    }

    public function addLocale(): void
    {
        $this->validate();

        $this->manager->addLocale($this->localeName);
        $this->locales = $this->manager->getLocales();
        $this->reset('localeName');
        $this->dispatch('$refresh');
    }

    public function removeLocale($locale): void
    {
        $this->manager->removeLocale($locale);
        $this->locales = $this->manager->getLocales();
    }
}
