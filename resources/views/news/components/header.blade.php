@persist('header')
    <header class="Header">
        <h1 class="Header-logo" id="js-logo">
            <a class="Header-logo-link" href="{{ route('news.index') }}" >
                O<span class="Header-logo-dynamic">mega</span> P<span class="Header-logo-dynamic">oint</span> N<span class="Header-logo-dynamic">ews</span>
            </a>
        </h1>
        <div class="Header-controls" x-data="lang">
            <input id="language_human" type="radio" name="lang" x-model="lang" value="human" @change="change('human')">
            <label for="language_human">
                <svg class="Header-controls-button-icon" aria-hidden="true" focusable="false">
                    <use xlink:href="/news/spritesheet.svg#human"></use>
                </svg>
                Human
            </label>
            <input id="language_alien" type="radio" name="lang" x-model="lang" value="alien" @change="change('alien')">
            <label for="language_alien">
                <svg class="Header-controls-button-icon" aria-hidden="true" focusable="false">
                    <use xlink:href="/news/spritesheet.svg#alien"></use>
                </svg>
                Alien
            </label>
            <input id="language_robot" type="radio" name="lang" x-model="lang" value="robot" @change="change('robot')">
            <label for="language_robot">
                <svg class="Header-controls-button-icon" aria-hidden="true" focusable="false">
                    <use xlink:href="/news/spritesheet.svg#robot"></use>
                </svg>
                Robot
            </label>



            {{-- <button class="Header-controls-button" onclick="window.human()" title="Human Language"><span class="sronly">Human</span>
                <svg class="Header-controls-button-icon" aria-hidden="true" focusable="false">
                    <use xlink:href="/news/spritesheet.svg#human"></use>
                </svg>
            </button>
            <button class="Header-controls-button" onclick="window.alien()" title="Alien Language"><span class="sronly">Alien</span>
                <svg class="Header-controls-button-icon" aria-hidden="true" focusable="false">
                    <use xlink:href="/news/spritesheet.svg#alien"></use>
                </svg>
            </button>
            <button class="Header-controls-button" onclick="window.robot()" title="Robot Language"><span class="sronly">Robot</span>
                <svg class="Header-controls-button-icon" aria-hidden="true" focusable="false">
                    <use xlink:href="/news/spritesheet.svg#robot"></use>
                </svg>
            </button> --}}
        </div>
        <div class="Header-marquee">
            @include('news.components.marquee')
        </div>
    </header>
@endpersist