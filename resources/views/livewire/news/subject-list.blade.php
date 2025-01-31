<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    @foreach($subjects as $subject)
        <label>
            <input type="checkbox" wire:model.live="chosenSubjects" value="{{ $subject->id }}">
            {{ $subject->name }}
        </label>
    @endforeach
</div>
