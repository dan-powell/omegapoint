<header class="Header">
    <h1 class="HeaderLogo">
        <a class="HeaderLogo_link" href="{{ route('news.index') }}" >
            O<span class="HeaderLogo_dynamic">mega</span> P<span class="HeaderLogo_dynamic">oint</span> N<span class="HeaderLogo_dynamic">ews</span>
        </a>
    </h1>
    <div class="HeaderControls">
        <button class="HeaderControls_button" onclick="window.human()"><span class="sronly">Human</span>
            <svg class="HeaderControls_button_icon" width="48px" height="48px" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 20V19C5 15.134 8.13401 12 12 12V12C15.866 12 19 15.134 19 19V20" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12 12C14.2091 12 16 10.2091 16 8C16 5.79086 14.2091 4 12 4C9.79086 4 8 5.79086 8 8C8 10.2091 9.79086 12 12 12Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </button>
        <button class="HeaderControls_button" onclick="window.alien()"><span class="sronly">Alien</span>
            <svg class="HeaderControls_button_icon" width="48px" height="48px" viewBox="0 0 24 24" stroke-width="1.5" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 21C7.02944 21 3 19.2091 3 17C3 14.7909 7.02944 13 12 13C16.9706 13 21 14.7909 21 17C21 19.2091 16.9706 21 12 21Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M12 2C13.6569 2 15 3.34315 15 5V6H9V5C9 3.34315 10.3431 2 12 2Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M3.5 15.5L7.5 8.5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M20.5 15.5L16.5 8.5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </button>
        <button class="HeaderControls_button" onclick="window.robot()"><span class="u-">Robot</span>
            <svg class="HeaderControls_button_icon" width="48px" height="48px" viewBox="0 0 24 24" stroke-width="1.5" fill="none" xmlns="http://www.w3.org/2000/svg" color="#000000"><path d="M6.81815 22L6.81819 19.143C6.66235 17.592 5.63284 16.4165 4.68213 15M14.4545 22L14.4545 20.2858C19.3636 20.2858 18.8182 14.5717 18.8182 14.5717C18.8182 14.5717 21 14.5717 21 12.286L18.8182 8.8576C18.8182 4.28632 15.1094 2.04169 11.1818 2.00068C8.98139 1.97771 7.22477 2.53124 5.91201 3.5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M13 7L15 9.5L13 12" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M5 7L3 9.5L5 12" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M10 6L8 13" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </button>
    </div>
    @include('news.components.ticker')

</header>