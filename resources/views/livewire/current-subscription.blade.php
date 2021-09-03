
@php

/** @var \App\Models\DomainSubscription $currentSub */
/** @var \App\Models\User $user */

$user = request()->user();

$domain_url = route('domain.page', ['member' => $user->username]);

@endphp

<div class="w-full lg:w-6/12 xl:w-3/12 px-4">
    <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
        <div class="flex-auto p-4">
            <div class="flex flex-wrap">
                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                    <h5 class="text-gray-500 uppercase font-bold text-xs">
                        Current Subscription
                    </h5>
                    <span class="font-semibold text-xl text-gray-800">
                        @if($currentSub)
                            Expires: <br>{{$currentSub->expires_at->format('jS M, Y')}}
                        @else
                            No active subscription
                            <br>
                            <a class="bg-indigo-500 modal-open text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1"
                               href="{{route('app.domain')}}">
                            Subscribe
                        </a>
                        @endif
                    </span>
                    @if($currentSub)

                        <hr class="my-3">

                        <div>
                            <label for="price" class="block text-sm leading-5 font-medium text-gray-700">
                                Domain Link:
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input class="form-input block w-full pl-7 pr-12 sm:text-sm sm:leading-5 text-gray-400"
                                       value="{{$domain_url}}">
                                <div class="absolute inset-y-0 right-0 flex items-center">
                                    <button class=" h-full py-0 pl-2 pr-3 border-transparent bg-transparent font-bold
                                    text-blue-600 sm:text-sm sm:leading-5" id="copy">
                                        copy
                                    </button>
                                </div>
                            </div>
                        </div>



                    @endif
                </div>

            </div>

        </div>
    </div>
</div>

@push('scripts')

<script>
    $('#copy').click(function(){
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val('{{$domain_url}}').select();
        document.execCommand("copy");
        $temp.remove();
        window.System.toast('copied!', 'success');
    });
</script>

@endpush