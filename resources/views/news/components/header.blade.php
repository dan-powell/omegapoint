@persist('header')
    <header class="Header">
        <h1 class="Header-logo" id="js-logo">
            <a class="Header-logo-link" href="{{ route('news.index') }}" >
                O<span class="Header-logo-dynamic">mega</span> P<span class="Header-logo-dynamic">oint</span> N<span class="Header-logo-dynamic">ews</span>
            </a>
        </h1>
        <div class="Header-lang" x-data="lang">
            <input class="Header-lang-input" id="language_human" type="radio" name="lang" x-model="lang" value="human" @change="change('human')">
            <label class="Header-lang-label" for="language_human" tab-index="0">
                <svg class="Header-lang-label-icon" aria-hidden="true" focusable="false">
                    <use xlink:href="/news/spritesheet.svg#human"></use>
                </svg>
                <span class="Header-lang-label-span sronly">Human</span>
            </label>
            <input class="Header-lang-input" id="language_alien" type="radio" name="lang" x-model="lang" value="alien" @change="change('alien')">
            <label class="Header-lang-label" for="language_alien" tab-index="0">
                <svg class="Header-lang-label-icon" aria-hidden="true" focusable="false">
                    <use xlink:href="/news/spritesheet.svg#alien"></use>
                </svg>
                <span class="Header-lang-label-span sronly">Alien</span>
            </label>
            <input class="Header-lang-input" id="language_robot" type="radio" name="lang" x-model="lang" value="robot" @change="change('robot')">
            <label class="Header-lang-label" for="language_robot" tab-index="0">
                <svg class="Header-lang-label-icon" aria-hidden="true" focusable="false">
                    <use xlink:href="/news/spritesheet.svg#robot"></use>
                </svg>
                <span class="Header-lang-label-span sronly">Robot</span>
            </label>
        </div>
        <div class="Header-marquee">
            @include('news.components.marquee')
        </div>
    </header>
@endpersist