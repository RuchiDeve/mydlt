<form class="w-full" wire:submit.prevent="sendMessage">
    <div wire:loading wire:target="sendMessage" >
        @livewire('utils.loading', ['message' => 'Sending...'])
    </div>

    <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-300">
        <div class="flex-auto p-5 lg:p-10">
            <h4 class="text-2xl font-semibold">Have some more questions or orders?</h4>
            <p class="leading-relaxed mt-1 mb-4 text-gray-600">
                Complete this form and we will get back to you in 24 hours.
            </p>
            <div class="relative w-full mb-3 mt-8">
                <label class="block uppercase text-gray-700 text-xs font-bold mb-2"
                       for="full-name">Full Name</label>
                <input wire:model="name"
                       type="text"
                       class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
                       placeholder="Full Name"
                       style="transition: all 0.15s ease 0s;"
                />
                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="relative w-full mb-3">
                <label class="block uppercase text-gray-700 text-xs font-bold mb-2"
                       for="email">Email</label>
                <input wire:model="email"
                       type="email"
                       class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
                       placeholder="Email"
                       style="transition: all 0.15s ease 0s;"
                />
                @error('email') <span class="text-red-500">{{ $message }}</span> @enderror

            </div>
            <div class="relative w-full mb-3">
                <label class="block uppercase text-gray-700 text-xs font-bold mb-2"
                       for="email">Phone</label>
                <input wire:model="phone"
                       type="text"
                       class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
                       placeholder="Email"
                       style="transition: all 0.15s ease 0s;"
                />
                @error('phone') <span class="text-red-500">{{ $message }}</span> @enderror

            </div>
            <div class="relative w-full mb-3">
                <label
                        class="block uppercase text-gray-700 text-xs font-bold mb-2"
                        for="message"
                >Message</label
                ><textarea wire:model="message"
                        rows="4"
                        cols="80"
                        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
                        placeholder="Type a message..."
                ></textarea>
                @error('message') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="text-center mt-6">
                @if($sent)
                    <p class="text-white bg-green-600 p-4 text-center">
                        Message Sent
                    </p>
                    @else
                <button
                        class="bg-gray-900 text-white active:bg-gray-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1"
                        type="submit"
                        style="transition: all 0.15s ease 0s;"
                >
                    Send Message
                </button>
                    @endif

            </div>
        </div>
    </div>

</form>