<div class="card">
    <div class="card-body">
        <p>
            Warning, translations are not visible until they are exported back to the app/lang file, using
            <code>php artisan translation:export</code> command or publish button.
        </p>

        @if(!isset($group))
            <form wire:submit.prevent="importGroups" aria-label="Import">
                <div class="row mb-3">
                    <div class="col-auto">
                        <select wire:model="replace" class="form-select">
                            <option value="0">{{ __('Append new translations') }}</option>
                            <option value="1">{{ __('Replace existing translations') }}</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-success btn-block" >
                            <span wire:loading.remove wire:target="importGroups">{{ __('Import groups') }}</span>
                            <span wire:loading wire:target="importGroups">{{ __('Loading...') }}</span>
                        </button>
                    </div>
                </div>
            </form>
            <hr>
            <div class="btn-group" role="group">
                <button
                    wire:confirm="Are you sure you want to scan you app folder? All found translation keys will be added to the database."
                    wire:click="findTranslations" wire:target="findTranslations" wire:loading.class="disabled" wire:loading.
                    class="btn btn-info">
                    <span wire:loading.remove wire:target="findTranslations">{{ __('Find translations in files') }}</span>
                    <span wire:loading wire:target="findTranslations">{{ __('Searching...') }}</span>
                </button>
            </div>
        @else
            <div class="btn-group" role="group">
                <button
                    wire:click="publishTranslations"
                    wire:confirm="Are you sure you want to publish the translations group '{{ $group }}'? This will overwrite existing language files."
                    class="btn btn-info">
                    <span wire:target="publishTranslations" wire:loading.remove>{{ __('Publish translations') }}</span>
                    <span wire:target="publishTranslations" wire:loading>{{ __('Publishing...') }}</span>
                </button>
                <button class="btn btn-secondary" wire:click="$set('group', null)">{{ __('Back') }}</button>
            </div>
        @endif
    </div>
</div>
