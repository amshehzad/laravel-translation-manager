<div class="card mt-2">
    <x-translation-manager::loader/>

    <div class="card-body">
        <fieldset>
            <legend>Supported locales</legend>
            <p>Current supported locales:</p>

            <ul class="list-locales list-unstyle">
                    @foreach($locales as $locale)
                        <li class="mb-3">
                            <span class="me-2">{{ $locale }}</span>
                            <button
                                wire:confirm="Are you sure to remove this locale and all of data?"
                                wire:click="removeLocale('{{ $locale }}')"
                                type="submit" class="btn btn-light btn-sm text-danger p-0" data-disable-with="...">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                </svg>
                            </button>
                        </li>
                    @endforeach
                </ul>

            <form class="form-add-locale" wire:submit.prevent="addLocale" aria-label="Add Locale">
                <div class="form-group">
                    <p>{{ __('Enter new locale key:') }}</p>
                    <div class="row">
                        <div class="col-auto">
                            <input type="text" name="new-locale" class="form-control" wire:model="localeName"/>
                        </div>
                        <div class="col-auto">
                            <button type="submit" wire:click.prevent="addLocale" class="btn btn-block btn-outline-success" data-disable-with="Adding...">Add new locale</button>
                        </div>
                    </div>
                </div>
            </form>
        </fieldset>
    </div>
</div>
