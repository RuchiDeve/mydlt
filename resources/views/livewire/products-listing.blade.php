<div class="flex flex-wrap w-full justify-center">
    @foreach($products as $product)
        <div class="max-w-sm md:w-6/12 mx-auto {{$loop->odd ? 'pr-2': 'pl-2'}} mb-4 lg:max-w-full lg:flex ">
            <div class="h-48 lg:h-auto lg:w-48 flex-none bg-gray-300 bg-center bg-no-repeat bg-contain
            rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden"
                 style="background-image: url({{$product->feature_image}})" title="{{$product->name}}">
            </div>
            <div class="border-r border-b border-l border-gray-400 lg:border-l-0
            lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4
            flex flex-col justify-between leading-normal overflow-y-auto h-64">
                <div class="mb-8">
                    <div class="text-gray-900 font-bold text-xl mb-2">
                        {{$product->name}}
                    </div>
                    <p class="text-gray-700 text-base">
                        {!! $product->description !!}
                    </p>
                </div>
                <div class="flex items-center">
                    <div class="text-sm">
                        <p class="text-gray-900 leading-none">
                            <button class="bg-white modal-open hover:bg-gray-100 w-full text-gray-800
                            font-semibold py-2 px-4 border border-gray-400 rounded shadow"
                            data-product="{{$product->name}}" id="buy-{{$product->id}}">
                                Buy Now
                            </button>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')

            <div id="modal-{{$product->id}}"
                    class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
                <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

                <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

                    <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
                        <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                        </svg>
                        <span class="text-sm">(Esc)</span>
                    </div>

                    <!-- Add margin if you want to see some of the overlay behind the modal-->
                    <div class="modal-content">
                        @livewire('domains.enquiry-form', ['product' => $product])
                    </div>
                </div>
            </div>

            <script>
                var openmodal = document.querySelectorAll('#buy-{{$product->id}}.modal-open')
                for (var i = 0; i < openmodal.length; i++) {
                    openmodal[i].addEventListener('click', function(event){
                        event.preventDefault()
                        toggleModal()
                    })
                }

                var overlay = document.querySelector('#modal-{{$product->id}} .modal-overlay')
                overlay.addEventListener('click', toggleModal)

                var closemodal = document.querySelectorAll('#modal-{{$product->id}} .modal-close')
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
                    const modal = document.querySelector('#modal-{{$product->id}}.modal')
                    modal.classList.toggle('opacity-0')
                    modal.classList.toggle('pointer-events-none')
                    body.classList.toggle('modal-active')
                }

            </script>

        @endpush

@endforeach


</div>

