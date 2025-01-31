<div class="Weather">
    @if(count($predictions))
        <div class="Weather-track">
            @foreach($predictions as $prediction)
                <div class="Weather-prediction">
                    <h4 class="Weather-prediction-timespan">
                        {{ $prediction->start->format('Hi') }} - {{ $prediction->end->format('Hi') }}
                    </h4>

                    <div class="Weather-prediction-icon">
                        {!! file_get_contents(resource_path('/icons/news/' . $prediction->typeIcon)) !!}
                    </div>
                    <ul class="Weather-prediction-stats">
                        <li class="Weather-prediction-stat -temperature">{{ $prediction->temperature_min }} / {{ $prediction->temperature_max }}</li>
                        <li class="Weather-prediction-stat -windspeed">{{ $prediction->windspeed_min }} / {{ $prediction->windspeed_max }}</li>
                        <li class="Weather-prediction-stat -radiation">{{ $prediction->radiation_min }} / {{ $prediction->radiation_max }}</li>
                        <li class="Weather-prediction-stat -pressure">{{ $prediction->pressure_min }} / {{ $prediction->pressure_max }}</li>
                        <li class="Weather-prediction-stat -humidity">{{ $prediction->humidity_min }} / {{ $prediction->humidity_max }}</li>
                        <li class="Weather-prediction-stat -precipitation">{{ $prediction->precipitation_max }} / {{ $prediction->precipitation_max }}</li>
                    </ul>
                </div>
            @endforeach
        </div>
    @endif
</div>
