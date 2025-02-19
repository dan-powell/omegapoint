<div class="Weather">
    <div class="Weather-info -warning">
        <span class="Weather-info-icon">!</span>
        <p class="Weather-info-message">High radiation levels expected across Topside from 0700 to 0900</p>
    </div>
    @if(count($predictions))
        <div class="Weather-track">
            @foreach($predictions as $prediction)
                <div class="Weather-prediction g-anim">
                    <h4 class="Weather-prediction-timespan">
                        {{ $prediction->start->format('Hi') }} - {{ $prediction->end->format('Hi') }}
                    </h4>
                    <div class="Weather-prediction-icon">
                        {!! file_get_contents(resource_path('/icons/news/' . $prediction->typeIcon)) !!}
                    </div>
                    <ul class="Weather-prediction-stats">
                        <li class="Weather-prediction-stat -temperature g-fade">{{ $prediction->temperature_min }} / {{ $prediction->temperature_max }}</li>
                        <li class="Weather-prediction-stat -windspeed g-fade">{{ $prediction->windspeed_min }} / {{ $prediction->windspeed_max }}</li>
                        <li class="Weather-prediction-stat -radiation g-fade">{{ $prediction->radiation_min }} / {{ $prediction->radiation_max }}</li>
                        <li class="Weather-prediction-stat -pressure g-fade">{{ $prediction->pressure_min }} / {{ $prediction->pressure_max }}</li>
                        <li class="Weather-prediction-stat -humidity g-fade">{{ $prediction->humidity_min }} / {{ $prediction->humidity_max }}</li>
                        <li class="Weather-prediction-stat -precipitation g-fade">{{ $prediction->precipitation_max }} / {{ $prediction->precipitation_max }}</li>
                    </ul>
                </div>
            @endforeach
        </div>
    @endif
</div>
