<div class="bg-white border border-gray-300 overflow-hidden shadow rounded-lg mt-2">
    <div class="px-4 py-5 sm:p-6">
        <fieldset>
            <legend class="text-xl mb-2">{{ __('Export all translations') }}</legend>
            <button
                wire:confirm="Are you sure you want to publish all translations group? This will overwrite existing language files."
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click="publishTranslations">
                <span wire:loading.remove wire:target="publishAll">{{ __('Publish all') }}</span>
                <span wire:loading wire:target="publishAll">{{ __('Publishing...') }}</span>
            </button>
        </fieldset>
    </div>
</div>
