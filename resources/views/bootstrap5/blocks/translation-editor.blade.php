<div x-on:click.away="$wire.editing = false" style="position: relative">
    <a href="#" @click.prevent="$wire.editing = !$wire.editing"
       @class([
        'text-decoration-none',
       ])
       style="border-bottom: dashed 1px #0088cc;" :class="$wire.value ? '' : 'empty-translation'"
       data-title="Enter translation">{{ $value ?: 'NULL' }}</a>

    <div x-cloak x-show="$wire.editing" class="translation-editor card shadow p-2 mb-5 ">
        <div class="arrow"></div>
        <form class="d-flex gap-1" wire:submit.prevent="update">
            <input wire:model="value" type="text" class="form-control">
            <button class="btn btn-success" type="submit"><i class="fa fa-check"></i></button>
            <button class="btn btn-secondary" x-on:click="$wire.editing = false"><i class="fa fa-times"></i></button>
        </form>
    </div>
</div>
