<div x-on:click.away="$wire.editing = false" style="position: relative">

    <a href="#" @click.prevent="$wire.editing = !$wire.editing"
       @class([
        'no-underline',
        'text-indigo-500'
       ])
       style="border-bottom: dashed 1px #0088cc;" :class="$wire.value ? '' : 'empty-translation'"
       >{{ $value ?: 'NULL' }}</a>

    <div x-cloak x-show="$wire.editing" class="translation-editor card shadow p-2 mb-5 ">
        <div class="arrow"></div>
        <form class="flex gap-1" wire:submit.prevent="update">
            <input wire:model="value" type="text" class="flex-1 shadow-sm text-black focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
            <button class="rounded-[4px] px-4 py-1 bg-green-600 text-white hover:bg-green-500" type="submit">
                <i class="fa fa-check"></i>
            </button>
            <button class="rounded-[4px] px-4 bg-gray-600 text-white hover:bg-gray-500" x-on:click="$wire.editing = false">
                <i class="fa fa-times"></i>
            </button>
        </form>
    </div>
</div>
