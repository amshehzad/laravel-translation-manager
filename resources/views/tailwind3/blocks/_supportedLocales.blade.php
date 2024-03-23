<div class="bg-white border border-gray-300 overflow-hidden shadow rounded-lg mt-2">
    <div class="px-4 py-5 sm:p-6">
        <fieldset>
            <legend class="text-xl mb-2">{{ __('Supported locales') }}</legend>
            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('Current supported locales:') }}</label>

            <ul class="list-locales list-disc list-inside pl-8">
                @foreach($locales as $locale)
                    <li class="mb-3 flex items-center">
                        <span class="mr-2">{{ $locale }}</span>
                        <button
                            wire:confirm="{{ __('Are you sure to remove this locale and all of data?') }}"
                            wire:click="removeLocale('{{ $locale }}')" class="text-red-600 p-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                 viewBox="0 0 16 16">
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
                        </button>
                    </li>
                @endforeach
            </ul>
            <form wire:submit.prevent="addLocale" role="form" aria-label="Add Locale">
                <div class="my-6">
                    <label
                        class="block text-sm font-medium text-gray-700 mb-1">{{ __('Enter new locale key:') }}</label>
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <input type="text" wire:model="localeName"
                                   class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"/>
                        </div>
                        <div class="sm:col-span-3">
                            <button
                                    class="inline-flex justify-center py-2 px-4 border border-green-600 shadow-sm text-sm font-medium rounded-md text-green-700 bg-white hover:bg-green-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-300"
                                    wire:click.prevent="addLocale"
                                    data-disable-with="Adding...">{{ __('Add new locale') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </fieldset>
    </div>
</div>
