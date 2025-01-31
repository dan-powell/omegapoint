<div class="DistricList">
    <div class="DistricList-list">
        @foreach($districts as $district)
            <label class="DistrictList-item">
                <input class="DistrictList-item-checkbox" type="checkbox" wire:model.live="chosenDistricts" value="{{ $district->id }}">
                <span class="DistrictList-item-label">{{ $district->name }}<span>
            </label>
        @endforeach
    </div>
</div>
