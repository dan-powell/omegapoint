<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <select wire:model.live="subject">
        @foreach($subjects as $subject)
            <option value="{{ $subject->id }}">
                {{ $subject->name }}
            </option>
        @endforeach
    </select>
</div>
