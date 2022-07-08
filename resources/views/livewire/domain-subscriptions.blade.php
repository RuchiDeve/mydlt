@php

    /** @var \App\Models\User $authUser */
    $authUser = auth()->user();
@endphp


<div class="flex flex-wrap mt-4">
    <div class="w-full mb-12 xl:mb-0 px-4">
        <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
            <div class="rounded-t mb-0 px-4 py-3 border-0">
                <div class="flex flex-wrap items-center">
                    <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                        <h3 class="font-semibold text-base text-gray-800">
                            Domain Renewals
                        </h3>
                    </div>
                    <div class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">
                        @if($authUser->isMember() && !$authUser->hasPendingRenewals() && !$authUser->hasActiveSubscription())
                            <button class="bg-indigo-500 modal-open text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1" type="button" style="transition:all .15s ease">
                                Renew Domain
                            </button>
                        @endif
                    </div>
                </div>
                <div wire:loading wire:target="approve" >
                    @livewire('utils.loading', ['message' => 'Approving...'])
                </div>

                @livewire('utils.alert')
            </div>
            <div class="block w-full overflow-x-auto">
                <!-- Projects table -->

                <table class="items-center w-full bg-transparent border-collapse">
                    <thead>
                    <tr>
                        <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left">
                            Domain
                        </th>
                        <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left">
                            Amount / Expires at
                        </th>
                        <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left">
                            Status
                        </th>
                        <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left">
                            Proof
                        </th>
                        <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left">

                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($subscriptions as $subscription)
                        <tr>
                            <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4 text-left">
                                {{$subscription->user->username}}
                            </th>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4">
                                {{number_format($subscription->amount, 2)}} /
                                {{$subscription->expires_at ? $subscription->expires_at->format('jS M, Y') : '-'}}
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4">
                                @if($subscription->approved)
                                    <span class="flex rounded-full bg-green-500 uppercase px-2 py-1 text-xs font-bold mr-3">
                                    Approved
                                </span>
                                @else
                                    <span class="flex rounded-full bg-red-500 uppercase w-auto inline px-2 py-1 text-xs font-bold mr-3">
                                    Not Approved
                                </span>
                                @endif
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-2">
                                <button class="bg-gray-300 hover:bg-gray-400 text-gray-800
                                font-bold py-2 px-4 rounded inline-flex items-center"
                                        wire:click="downloadProof( '{{ $subscription->payment_proof }}' )">
                                    <svg class="fill-current w-4 h-2 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
                                    <span>Download Payment proof</span>
                                </button>
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-2">
                                @if(!$authUser->isMember())
                                    @if(!$subscription->approved)
                                        <button class="bg-indigo-800 hover:bg-indigo-700 text-gray-300
                                font-bold py-2 px-4 rounded inline-flex items-center"
                                        wire:click="approve('{{$subscription->id}}')">
                                            <i class="fas fa-check"></i>
                                            <span>Approve</span>
                                        </button>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>


@push('scripts')

    @once

    <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

            <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
                <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                </svg>
                <span class="text-sm">(Esc)</span>
            </div>

            <!-- Add margin if you want to see some of the overlay behind the modal-->
            <div class="modal-content py-4 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Renew Domain</p>
                    <div class="modal-close cursor-pointer z-50">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                        </svg>
                    </div>
                </div>

                @livewire('renew-domain-form')

            </div>
        </div>
    </div>

    <script>
        var openmodal = document.querySelectorAll('.modal-open')
        for (var i = 0; i < openmodal.length; i++) {
            openmodal[i].addEventListener('click', function(event){
                event.preventDefault()
                toggleModal()
            })
        }

        const overlay = document.querySelector('.modal-overlay')
        overlay.addEventListener('click', toggleModal)

        var closemodal = document.querySelectorAll('.modal-close')
        for (var i = 0; i < closemodal.length; i++) {
            closemodal[i].addEventListener('click', toggleModal)
        }

        document.onkeydown = function(evt) {
            evt = evt || window.event
            var isEscape = false
            if ("key" in evt) {
                isEscape = (evt.key === "Escape" || evt.key === "Esc")
            } else {
                isEscape = (evt.keyCode === 27)
            }
            if (isEscape && document.body.classList.contains('modal-active')) {
                toggleModal()
            }
        };


        function toggleModal () {
            const body = document.querySelector('body')
            const modal = document.querySelector('.modal')
            modal.classList.toggle('opacity-0')
            modal.classList.toggle('pointer-events-none')
            body.classList.toggle('modal-active')
        }

        let tabsContainer = document.querySelector("#tabs");

let tabTogglers = tabsContainer.querySelectorAll("#tabs a");

$('#domainBtn').hide();

tabTogglers.forEach(function(toggler) {
  toggler.addEventListener("click", function(e) {
    e.preventDefault();

    let tabName = this.getAttribute("href");

    let tabContents = document.querySelector("#tab-contents");

    for (let i = 0; i < tabContents.children.length; i++) {

        if(tabContents.children[i].id ==='second'){
            $('#domainBtn').show();
        }

        // if(tabContents.children[i].id ==='first'){
        //     $('#domainBtn').hide();
        // }


      tabTogglers[i].parentElement.classList.remove("border-t", "border-r", "border-l", "-mb-px", "bg-white");  tabContents.children[i].classList.remove("hidden");
      if ("#" + tabContents.children[i].id === tabName) {
        continue;
      }
      tabContents.children[i].classList.add("hidden");

    }
    e.target.parentElement.classList.add("border-t", "border-r", "border-l", "-mb-px", "bg-white");
  });
});
$('#domainBtn').hide();
    </script>

    @endonce

@endpush
