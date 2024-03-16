<div class="bg-white border border-gray-300 overflow-hidden shadow rounded-lg mt-2">
    <div class="px-4 py-5 sm:p-6">
        <div class="mb-3">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                {{ __('Choose a group to display the group translations. If no groups are visible, make sure you have run the migrations and imported the translations.') }}
            </label>
            <select wire:model.live="group" id="group"
                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md group-select">
                @foreach($groups as $key => $value)
                    <option value="{{ $key }}">{{$value}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
