<div class="DistricList">
    <div class="DistricList_list">
        @foreach($districts as $district)
            <label class="DistrictList_item">
                <input class="DistrictList_item_checkbox" type="checkbox" wire:model.live="chosenDistricts" value="{{ $district->id }}">
                <span class="DistrictList_item_label">{{ $district->name }}<span>
            </label>
        @endforeach
    </div>
</div>
