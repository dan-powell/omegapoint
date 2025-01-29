@if(count($predictions))
    <div class="Weather_prediction">
        @foreach($predictions as $prediction)
            <div class="Weather_prediction">
                <h4>{{ $prediction->start->format('Hi') }} - {{ $prediction->end->format('Hi') }}</h4>
            </div>
        @endforeach
    </div>
@endif
