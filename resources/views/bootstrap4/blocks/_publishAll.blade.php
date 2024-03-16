<div class="card mt-2">
    <div class="card-body">
        <fieldset>
            <legend>Export all translations</legend>
            <button
                wire:confirm="Are you sure you want to publish all translations group? This will overwrite existing language files."
                class="btn btn-primary" wire:click="publishTranslations">
                <span wire:loading.remove wire:target="publishAll">Publish all</span>
                <span wire:loading wire:target="publishAll">Publishing..</span>
            </button>

        </fieldset>
    </div>
</div>
