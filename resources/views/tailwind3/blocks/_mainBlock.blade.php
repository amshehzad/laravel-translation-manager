<div class="bg-white border border-gray-300 overflow-hidden shadow rounded-lg mt-2">
    <div class="px-4 py-5 sm:p-6">
        <p class="block text-sm text-gray-700">
            Warning, translations are not visible until they are exported back to the app/lang file, using
            <code class="text-sm text-orange-500">php artisan translation:export</code> command or publish button.
        </p>

        @if(!isset($group))
            <form wire:submit.prevent="importGroups" aria-label="Import">
                <div class="my-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <select wire:model="replace"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            <option value="0">{{ __('Append new translations') }}</option>
                            <option value="1">{{ __('Replace existing translations') }}</option>
                        </select>
                    </div>
                    <div class="sm:col-span-3">
                        <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <span wire:loading.remove wire:target="importGroups">{{ __('Import groups') }}</span>
                            <span wire:loading wire:target="importGroups">{{ __('Loading...') }}</span>
                        </button>
                    </div>
                </div>
            </form>
            <hr>
            <div class="mt-6" role="group">
                <button
                    wire:confirm="Are you sure you want to scan you app folder? All found translation keys will be added to the database."
                    wire:click="findTranslations"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                    <span wire:loading.remove wire:target="findTranslations">{{ __('Find translations in files') }}</span>
                    <span wire:loading wire:target="findTranslations">{{ __('Searching...') }}</span>
                </button>
            </div>
        @else
            <div class="mt-6" role="group">
                <button
                    wire:click="publishTranslations"
                    wire:confirm="Are you sure you want to publish the translations group '{{ $group }}'? This will overwrite existing language files."
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                    <span wire:target="publishTranslations" wire:loading.remove>{{ __('Publish translations') }}</span>
                    <span wire:target="publishTranslations" wire:loading>{{ __('Publishing...') }}</span>
                </button>
                <button wire:click="$set('group', null)"
                   class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">{{ __('Back') }}</button>
            </div>
        @endif
    </div>
</div>
