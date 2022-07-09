<div>
    <form method="post" action="{{ route('app.sms.purchase') }}" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-col pt-4">
            <label for="" class="text-lg">Units</label>
            <input type="number" id="unit" name="units" wire:model="units"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1
                   leading-tight focus:outline-none focus:shadow-outline">
            <span>
                Cost: NGN{{ number_format($this->cost, 2) }}

                <input type="hidden" id="amount" value="{{ $this->cost * 100 }}" name="amount" />

            </span>
        </div>

        {{-- <h2 class="pt-2">Pay NGN{{ number_format($this->cost, 2) }} into this account below </h2> --}}
        <div class="flex flex-col pt-2">

            <!-- Tabs -->
            <ul id="tabs" class="inline-flex pt-2 px-1 w-full border-2">
                <li class="px-4 text-white-800  m-3 font-semibold p-3 rounded-t border-2"><a
                        id="default-tab" href="#first"> Online Payment </a></li>
                <li class="px-4 text-white-800  m-3 font-semibold p-3 rounded-t border-2"><a href="#second">Bank Transfer </a></li>
            </ul>

            <!-- Tab Contents -->
            <div id="tab-contents">
                <div id="first" class="p-4">


                    <div onclick="payWithPaystack()"
                        class="bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                        Pay with Paystack
                    </div>


                </div>
                <div id="second" class="hidden p-4">

                    <hr>
                    <label for="" class="text-lg">ACCOUNT NAME :<strong> BNIT CONSULT LIMITED</strong></label>
                    <label for="" class="text-lg">ACCOUNT NUMBER: <strong>0643860619 </strong></label>
                    <label for="" class="text-lg">BANK NAME: <strong> Trust Bank</strong></label>
                    <hr>

                    <label for="" class="text-lg pt-4">Upload Proof Payment (image, pdf)</label>
                    <input type="file" name="proof" wire:model="proof" accept="application/pdf, image/*"
                        class="shadow appearance-none border rounded w-full py-2 px-3
                   text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline">
                    @error('proof')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror


                </div>
            </div>


        </div>

        <div class="flex flex-col pt-4">


        </div>

        <!--Footer-->
        <div class="flex justify-end pt-2">
            <button id="domainBtn" class="px-4 bg-indigo-500 py-1 rounded-lg text-gray-100 hover:bg-indigo-400 hover:text-white mr-2">
                Submit
            </button>
        </div>

    </form>
</div>

@push('scripts')
    <script src="https://js.paystack.co/v1/inline.js"></script>

    <script>
        // function payWithPaystack() {

        // }
        //const paymentForm = document.getElementById('paymentForm');
        //paymentForm.addEventListener("submit", payWithPaystack, false);
        function payWithPaystack() {
            //e.preventDefault();
            let handler = PaystackPop.setup({
                key: 'pk_live_036013ff9241213fc1ace2504181d9a1981ea791', // Replace with your public key
                email: "{{ auth()->user()->email }}",
                label: "For " + document.getElementById("unit").value + ' units',
                amount: document.getElementById("amount").value,
                metadata: {
                    'paymentFor': 'sms',
                    'email': '{{ auth()->user()->email }}',
                    'unit': document.getElementById("unit").value
                },
                ref: '' + Math.floor((Math.random() * 1000000000) +
                1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                // label: "Optional string that replaces customer email"
                onClose: function() {
                    alert('Window closed.');
                },
                callback: function(response) {
                    let message = 'Payment complete! Reference: ' + response.reference;
                    // alert(message);
                    window.location = response.redirecturl;

                    console.log(response);
                }
            });
            handler.openIframe();
        }
    </script>
@endpush
