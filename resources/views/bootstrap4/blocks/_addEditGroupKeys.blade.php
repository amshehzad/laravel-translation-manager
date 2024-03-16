<div class="card mt-2">
    <div class="card-body">
        <div class="mb-3">
            <p>Choose a group to display the group translations. If no groups are visible, make sure you have run the migrations and imported the translations.</p>
            <select wire:model.live="group" id="group" class="form-control group-select">
                @foreach($groups as $key => $value)
                    <option value="{{ $key }}">{{$value}}</option>
                @endforeach
            </select>
        </div>

    </div>
</div>
