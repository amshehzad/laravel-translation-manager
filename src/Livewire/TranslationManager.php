<?php

namespace Barryvdh\TranslationManager\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Barryvdh\TranslationManager\Manager;
use Illuminate\Pagination\LengthAwarePaginator;
use Barryvdh\TranslationManager\Models\Translation;

class TranslationManager extends Component
{
    use WithPagination;

    protected Manager $manager;
    public ?string $group = null;
    public ?string $newGroup = null;

    public int $changedTranslationsCount;

    public string $notification;

    public bool $replace = false;
    public string $keys;

    public string $theme;
    public string $paginator;

    public function boot(Manager $manager): void
    {
        $this->manager = $manager;
    }

    public function mount(): void
    {
        $this->theme = $this->manager->getConfig('template');
        $this->paginator = 'tailwind3' == $this->theme ? 'tailwind' : 'bootstrap';
    }

    public function render(): View
    {
        $data = [];

        $groups = Translation::groupBy('group');
        $excludedGroups = $this->manager->getConfig('exclude_groups');
        if ($excludedGroups) {
            $groups->whereNotIn('group', $excludedGroups);
        }

        $groups = $groups->select('group')->orderBy('group')->get()->pluck('group', 'group');
        if ($groups instanceof Collection) {
            $groups = $groups->all();
        }
        $groups = ['' => 'Choose a group'] + $groups;

        $group = $this->group;

        $this->changedTranslationsCount = Translation::query()
            ->where('group', $group)
            ->where('status', Translation::STATUS_CHANGED)
            ->count();

        $allTranslations = Translation::where('group', $group)->orderBy('key', 'asc')->get();
        $numTranslations = count($allTranslations);
        $translations = [];
        foreach ($allTranslations as $translation) {
            $translations[$translation->key][$translation->locale] = $translation;
        }

        if ($this->manager->getConfig('pagination_enabled')) {
            $total = count($translations);
            $page = $this->getPage();
            $perPage = $this->manager->getConfig('per_page');
            $offSet = ($page * $perPage) - $perPage;
            $itemsForCurrentPage = array_slice($translations, $offSet, $perPage, true);
            $prefix = $this->manager->getConfig('route')['prefix'];
            $path = url("$prefix");

            $paginator = new LengthAwarePaginator($itemsForCurrentPage, $total, $perPage, $page);
            $translations = $paginator;
        }

        $data['selectedModel'] = null;
        $data['groups'] = $groups;
        $data['numTranslations'] = $numTranslations;
        $data['locales'] = $this->manager->getLocales();
        $data['deleteEnabled'] = $this->manager->getConfig('delete_enabled');
        $data['translations'] = $translations;
        $data['editUrl'] = null;

        return view('translation-manager::livewire.translation-manager', $data)
            ->extends('translation-manager::layout', [
                'paginationEnabled' => $this->manager->getConfig('pagination_enabled'),
                'translations' => $translations,
            ]);
    }

    public function findTranslations(): void
    {
        $translations = $this->manager->findTranslations();
        $this->notification = "Done searching for translations, found <strong>$translations</strong> items!";
    }

    public function importGroups(): void
    {
        $counter = $this->manager->importTranslations($this->replace);
        $this->notification = "Done importing, processed <strong>$counter</strong> items! Reload this page to refresh the groups!";
    }

    public function publishTranslations(): void
    {
        $json = false;

        if ('_json' === $this->group) {
            $json = true;
        }

        $this->manager->exportTranslations($this->group, $json);
        $this->notification = 'Done publishing the translations for all groups!';
    }

    public function addKeys(): void
    {
        $group = $this->newGroup ?? $this->group;
        $keys = explode("\n", $this->keys);

        foreach ($keys as $key) {
            $key = trim($key);
            if ($group && $key) {
                $this->manager->missingKey('*', $group, $key);
            }
        }

        $this->reset('keys', 'newGroup');
    }

    public function removeKey($key): void
    {
        if (
            $this->manager->getConfig('delete_enabled')
            && !in_array($this->group, $this->manager->getConfig('exclude_groups'), true)
        ) {
            Translation::where('group', $this->group)->where('key', $key)->delete();
        }

        $this->notification = "Translations deleted for <strong>$key</strong>!";
    }

    #[On('translationChanged')]
    public function incrementChangedTranslationCount(): void
    {
        ++$this->changedTranslationsCount;
    }
}
