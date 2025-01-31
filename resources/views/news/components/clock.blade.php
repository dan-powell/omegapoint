<div class="Clock" x-data="clock('{{ $time->format('d/M/Y H:i:s') }}')">
    <div class="Clock-time">
        <time class="Clock-time-time" datetime="{{ $time->format('H:i:s') }}">
            <span class="Clock-time-unit" x-text="formatHours()">{{ $time->format('H') }}</span>
            <span class="Clock-time-unit" x-text="formatMinutes()">{{ $time->format('i') }}</span>
            <span class="Clock-time-unit" x-text="formatSeconds()">{{ $time->format('s') }}</span>
        </time>
        <p class="Clock-time-zone">OPST</p>
    </div>
    <div class="Clock-stars">
        @foreach($stars as $star)
            {{ $star['rise']->format('H:i') }}
            {{ $star['set']->format('H:i') }}
        @endforeach
    </div>
    <div class="Clock-moons">
        @foreach($moons as $moon)
            {{ $moon['phase'] }}
        @endforeach
    </div>
    <div class="Clock-date">
        <time class="Clock-date-date" datetime="{{ $time->format('d/m/Y') }}" x-text="formatDate()">{{ $time->format('z|Y') }}</span>
    </div>
</div>

<script>
    function clock(date) {
        let currentTime = new Date(date);
        return {
            // Initialize the current time
            currentTime,

            // Methods to format date and time
            formatDate() {
                return ((Date.UTC(this.currentTime.getFullYear(), this.currentTime.getMonth(), this.currentTime.getDate()) - Date.UTC(this.currentTime.getFullYear(), 0, 0)) / 24 / 60 / 60 / 1000) + '|' + this.currentTime.getFullYear();
            },
            formatHours() {
                return (((this.currentTime.getHours() < 10) ? "0" + this.currentTime.getHours() : this.currentTime.getHours()))
            },
            formatMinutes() {
                return ((this.currentTime.getMinutes() < 10) ? "0" + this.currentTime.getMinutes() : this.currentTime.getMinutes())
            },
            formatSeconds() {
                return ((this.currentTime.getSeconds() < 10) ? "0" + this.currentTime.getSeconds() : this.currentTime.getSeconds())
            },

            // Update the time every second
            init() {
                const vm = this;
                vm.timer = setInterval(() => {
                    vm.currentTime = new Date(vm.currentTime.setSeconds(vm.currentTime.getSeconds() + 1));
                }, 1000);
            },

            destroy() {
                if (this.timer) clearInterval(this.timer);
            }
        };
    }

    // Initialize the clock component
    // document.addEventListener('alpine:init', () => {
    //     Alpine.data('clock', clock);
    // });
</script>
