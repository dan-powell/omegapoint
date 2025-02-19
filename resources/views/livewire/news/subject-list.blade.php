<div class="SubjectList">
    <div class="SubjectList-list g-anim">
        @foreach($subjects as $subject)
            <label class="SubjectList-item g-fade">
                <input class="SubjectList-item-checkbox" type="checkbox" wire:model.live="chosenSubjects" value="{{ $subject->id }}">
                <span class="SubjectList-item-label">{{ $subject->name }} [{{ $subject->article_count }}]<span>
            </label>
        @endforeach
    </div>
</div>
