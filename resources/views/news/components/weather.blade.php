<div class="Weather">
    @if(count($predictions))
        <div class="Weather_track">
            @foreach($predictions as $prediction)
                <div class="Weather_prediction">
                    <h4 class="Weather_prediction_timespan">
                        {{ $prediction->start->format('Hi') }} - {{ $prediction->end->format('Hi') }}
                    </h4>

                    <div class="Weather_prediction_icon">
                        {!! file_get_contents(resource_path('/icons/news/' . $prediction->typeIcon)) !!}
                    </div>
                    <ul class="Weather_prediction_stats">
                        <li class="Weather_prediction_stat -temperature">{{ $prediction->temperature_min }} / {{ $prediction->temperature_max }}</li>
                        <li class="Weather_prediction_stat -windspeed">{{ $prediction->windspeed_min }} / {{ $prediction->windspeed_max }}</li>
                        <li class="Weather_prediction_stat -radiation">{{ $prediction->radiation_min }} / {{ $prediction->radiation_max }}</li>
                        <li class="Weather_prediction_stat -pressure">{{ $prediction->pressure_min }} / {{ $prediction->pressure_max }}</li>
                        <li class="Weather_prediction_stat -humidity">{{ $prediction->humidity_min }} / {{ $prediction->humidity_max }}</li>
                        <li class="Weather_prediction_stat -precipitation">{{ $prediction->precipitation_max }} / {{ $prediction->precipitation_max }}</li>
                    </ul>
                </div>
            @endforeach
        </div>
    @endif
</div>
