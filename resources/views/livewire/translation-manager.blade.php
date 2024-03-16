<div>
    <x-translation-manager::loader/>
    @include("translation-manager::$theme._notifications")

    @include("translation-manager::$theme.blocks._mainBlock")
    @include("translation-manager::$theme.blocks._addEditGroupKeys")

    @if($group)
        @include("translation-manager::$theme.blocks._edit")
    @else
        <livewire:locale-manager/>
        @include("translation-manager::$theme.blocks._publishAll")
    @endif

    {{ $translations->links("livewire::$paginator", data: ['scrollTo' => 'table']) }}
</div>
