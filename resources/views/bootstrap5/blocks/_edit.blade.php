<div class="card mt-2 mb-4">
    <div class="card-body">
        <form wire:submit.prevent="addKeys" role="form">
            <div class="mb-3">
                <label>{{ __('Enter a new group name and start edit translations in that group:') }}</label>
                <input type="text" class="form-control" wire:model="newGroup"/>
            </div>
            <div>{{ __('Add new keys to this group:') }}</div>
            <div class="form-floating mb-3">
                <textarea class="form-control" rows="3" style="height: 100px" id="keys" wire:model="keys"
                          placeholder="Add 1 key per line, without the group prefix"></textarea>
                <label for="keys">{{ __('Add 1 key per line, without the group prefix') }}</label>
            </div>
            <input type="submit" class="btn btn-primary">
        </form>
        <hr>
        <h4>{{ __('Total:') }} {{ $numTranslations }}, {{ __('changed:') }} {{ $changedTranslationsCount }}</h4>
        <table class="table">
            <thead>
            <tr>
                <th width="15%">Key</th>
                @foreach ($locales as $locale)
                    <th>{{ $locale }}</th>
                @endforeach
                @if ($deleteEnabled)
                    <th>&nbsp;</th>
                @endif
            </tr>
            </thead>
            <tbody>

            @foreach ($translations as $key => $translation)
                <tr id="{{ $key }}">
                    <td>{{ $key }}</td>
                    @foreach ($locales as $locale)
                        @php($t = $translation[$locale] ?? null)
                        <td>
                            <livewire:translation-editor wire:key='{{ "{$locale}_{$key}" }}' :$locale :$group :translation-key="$key" :value="$t?->value"/>
                        </td>
                    @endforeach
                    @if ($deleteEnabled)
                        <td>
                            <a href="#" wire:click="removeKey(@js($key))"
                               wire:confirm="Are you sure you want to delete the translations for '{{ $key }}'?">
                                <svg width="20" height="20" class="text-danger" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
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
