<div class="SubjectList">
    <div class="SubjectList-list">
        @foreach($subjects as $subject)
            <label class="SubjectList-item">
                <input class="SubjectList-item-checkbox" type="checkbox" wire:model.live="chosenSubjects" value="{{ $subject->id }}">
                <span class="SubjectList-item-label">{{ $subject->name }} [{{ $subject->article_count }}]<span>
            </label>
        @endforeach
    </div>
</div>
