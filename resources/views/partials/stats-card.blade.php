<div class="flex flex-wrap">
    @if(!auth()->user()->isMember())
        @livewire('member-stat-card')

        @livewire('sms-balance-card')
    @endif

    @if(auth()->user()->isMember())

                    @livewire('current-subscription')

                    @livewire('my-sms-balance')

    @endif
</div>