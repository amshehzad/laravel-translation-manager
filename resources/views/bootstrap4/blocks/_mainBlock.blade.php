<div class="card">
    <div class="card-body">
        <p>Warning, translations are not visible until they are exported back to the app/lang file, using <code>php artisan translation:export</code> command or publish button.</p>

        @if(!isset($group))
            <form class="form-import" wire:submit.prevent="importGroups" aria-label="Import">
                <div class="row form-group">
                    <div class="col-auto">
                        <select wire:model="replace" class="form-control">
                            <option value="0">Append new translations</option>
                            <option value="1">Replace existing translations</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-success btn-block">
                            <span wire:loading.remove wire:target="importGroups">Import groups</span>
                            <span wire:loading wire:target="importGroups">Loading...</span>
                        </button>
                    </div>
                </div>
            </form>
            <div class="btn-group" role="group">
                <button
                    wire:confirm="Are you sure you want to scan you app folder? All found translation keys will be added to the database."
                    wire:click="findTranslations" wire:target="findTranslations" wire:loading.class="disabled" wire:loading.
                    class="btn btn-info">
                    <span wire:loading.remove wire:target="findTranslations">Find translations in files</span>
                    <span wire:loading wire:target="findTranslations">Searching...</span>
                </button>
            </div>

        @else
            <div class="btn-group" role="group">
                <button
                    wire:click="publishTranslations"
                    wire:confirm="Are you sure you want to publish the translations group '{{ $group }}'? This will overwrite existing language files."
                    class="btn btn-info">
                    <span wire:target="publishTranslations" wire:loading.remove>Publish translations</span>
                    <span wire:target="publishTranslations" wire:loading>Publishing...</span>
                </button>
                <button class="btn btn-secondary" wire:click="$set('group', null)">Back</button>
            </div>

        @endif
    </div>
</div>
