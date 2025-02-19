<div class="DistrictList">
    <div class="DistrictList-list g-anim">
        @foreach($districts as $district)
            <label class="DistrictList-item g-fade">
                <input class="DistrictList-item-checkbox" type="checkbox" wire:model.live="chosenDistricts" value="{{ $district->id }}">
                <span class="DistrictList-item-label">{{ $district->name }} [{{ $district->article_count }}]<span>
            </label>
        @endforeach
    </div>
</div>
