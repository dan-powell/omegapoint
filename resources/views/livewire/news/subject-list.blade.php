<div class="SubjectList">
    <div class="SubjectList_list">
        @foreach($subjects as $subject)
            <label class="SubjectList_item">
                <input class="SubjectList_item_checkbox" type="checkbox" wire:model.live="chosenSubjects" value="{{ $subject->id }}">
                <span class="SubjectList_item_label">{{ $subject->name }}<span>
            </label>
        @endforeach
    </div>
</div>
