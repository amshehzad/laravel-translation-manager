<div class="bg-white border border-gray-300 overflow-hidden shadow rounded-lg my-2">
    <div class="px-4 py-5 sm:p-6">
        <form wire:submit.prevent="addKeys" role="form" class="mb-4">
            <div class="mb-3">
                <label
                    class="block text-sm font-medium text-gray-700 mb-1">{{ __('Enter a new group name and start edit translations in that group:') }}</label>
                <input type="text"
                       class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                       wire:model="newGroup"/>
            </div>

            <div class="block text-sm font-medium text-gray-700 mb-1">{{ __('Add new keys to this group:') }}</div>
            <div class="form-floating mb-3">
                <textarea
                    class="form-control shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                    rows="3" style="height: 100px" id="keys" wire:model="keys">{{ old('keys') }}</textarea>
                <label for="keys" class="text-sm font-medium">{{ __('Add 1 key per line, without the group prefix') }}</label>
            </div>
            <input type="submit" value="Add keys"
                   class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        </form>
        <hr>
        <h4 class="font-medium text-xl my-4">{{ __('Total:') }} {{ $numTranslations }}, changed: {{ $changedTranslationsCount }}</h4>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th scope="col" width="15%"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Key') }}
                </th>
                @foreach ($locales as $locale)
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ $locale }}</th>
                @endforeach
                @if ($deleteEnabled)
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">&nbsp;
                    </th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach ($translations as $key => $translation)
                <tr id="{{ $key }}" class="{{ $loop->index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }}">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $key }}</td>
                    @foreach ($locales as $locale)
                        @php($t = $translation[$locale] ?? null)
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">
                            <livewire:translation-editor
                                wire:key='{{ "{$locale}_{$key}" }}'
                                :$locale :$group :translation-key="$key" :value="$t?->value"
                            />
                        </td>
                    @endforeach
                    @if ($deleteEnabled)
                        <td class="text-right">
                            <a href="#" wire:click="removeKey(@js($key))"
                               wire:confirm="Are you sure you want to delete the translations for '{{ $key }}'?"
                               class="delete-key inline-flex justify-center py-2 px-4 border border-transparent text-sm font-medium text-red-600 hover:text-red-700 focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </a>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>