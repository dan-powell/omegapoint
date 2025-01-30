<div class="Clock" x-data="clock('{{ $time->format('d/M/Y H:i:s') }}')">
    <div class="Clock_time">
        <time class="Clock_time_time" datetime="{{ $time->format('H:i:s') }}" x-text="formatTime()">
            {{ $time->format('Hi') }}</time>
        <p class="Clock_time_zone">OPST</p>
    </div>
    <div class="Clock_stars">
        @foreach($stars as $star)
            {{ $star['rise']->format('H:i') }}
            {{ $star['set']->format('H:i') }}
        @endforeach
    </div>
    <div class="Clock_moons">
        @foreach($moons as $moon)
            {{ $moon['phase'] }}
        @endforeach
    </div>
    <div class="Clock_date">
        <time class="Clock_date_date" datetime="{{ $time->format('d/m/Y') }}" x-text="formatDate()">{{ $time->format('z|Y') }}</span>
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
            formatTime() {
                return (
                    ((this.currentTime.getHours() < 10) ? "0" + this.currentTime.getHours() : this.currentTime.getHours())
                    + '' + 
                    ((this.currentTime.getMinutes() < 10) ? "0" + this.currentTime.getMinutes() : this.currentTime.getMinutes()) 
                    + '' + 
                    ((this.currentTime.getSeconds() < 10) ? "0" + this.currentTime.getSeconds() : this.currentTime.getSeconds())
                ) 
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