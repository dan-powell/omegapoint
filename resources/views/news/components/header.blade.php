<header class="Header">
    <h1 class="HeaderLogo">
        <a class="HeaderLogo_link" href="{{ route('news.index') }}">
            O<span class="HeaderLogo_dynamic">mega</span> P<span class="HeaderLogo_dynamic">oint</span> N<span class="HeaderLogo_dynamic">ews</span>
        </a>
    </h1>
    <div class="HeaderControls">
        <button class="HeaderControls_button" onclick="window.human()"><span class="u-sronly">Human</span>1</button>
        <button class="HeaderControls_button" onclick="window.alien()"><span class="u-sronly">Alien</span>2</button>
        <button class="HeaderControls_button" onclick="window.robot()"><span class="u-sronly">Robot</span>3</button>
    </div>
    <div class="HeaderTicker">
        <div class="HeaderTicker_track">
            <ul class="HeaderTicker_list">
                @foreach($ticker as $article)
                    <li class="HeaderTicker_item"><a class="HeaderTicker_link" href="{{ route('news.article.show', ['id' => $article->id]) }}">{{ $article->title }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</header>