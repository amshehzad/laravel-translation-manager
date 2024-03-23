<?php

namespace Barryvdh\TranslationManager\Livewire;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use Barryvdh\TranslationManager\Manager;
use Barryvdh\TranslationManager\Models\Translation;

class TranslationEditor extends Component
{
    protected Manager $manager;

    public string $locale;
    public string $group;
    public string $translationKey;

    public Translation $translation;
    public ?string $value;

    public bool $editing = false;

    public function boot(Manager $manager): void
    {
        $this->manager = $manager;
    }

    public function mount(string $locale, string $group, string $translationKey, ?string $value): void
    {
        $this->locale = $locale;
        $this->group = $group;
        $this->translationKey = $translationKey;
        $this->value = $value ? htmlentities($value, ENT_QUOTES, 'UTF-8', false) : '';
    }

    public function render(): View
    {
        $theme = $this->manager->getConfig('template');

        return view("translation-manager::$theme.blocks.translation-editor");
    }

    public function update(): void
    {
        $translation = Translation::firstOrCreate([
            'locale' => $this->locale,
            'group' => $this->group,
            'key' => $this->translationKey,
        ]);

        $translation->value = $this->value ?: null;
        $translation->status = Translation::STATUS_CHANGED;
        $translation->save();
        $this->editing = false;

        $this->dispatch('translationChanged');
    }
}
