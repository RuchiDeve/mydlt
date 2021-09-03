
<div class="relative flex flex-col min-w-0 bg-gray-200 w-full mb-6 shadow-lg rounded">
    <div class="rounded-t mb-0 px-4 py-3 border-0">
        <div class="flex flex-wrap items-center">
            <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                <h3 class="font-semibold text-base text-gray-800">
                    Change Password
                </h3>
            </div>

        </div>
    </div>

    <div class="block w-full overflow-x-auto ">
        <div wire:loading wire:target="changePassword" >
            @livewire('utils.loading', ['message' => 'Updating your password...'])
        </div>

        @if($changed)
            <p class="text-white bg-green-600 p-4 text-center">
                Password Changed
            </p>
        @endif

        <form wire:submit.prevent="changePassword" class="px-4 py-3">
            <div class="relative w-full mb-3 mt-8">
                <label class="block uppercase text-gray-700 text-xs font-bold mb-2"
                       for="full-name">Current Password</label>
                <input wire:model="current_password"
                       type="password"
                       class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
                       placeholder="Type your current password"
                       style="transition: all 0.15s ease 0s;"
                />
                @error('current_password') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="relative w-full mb-3 mt-8">
                <label class="block uppercase text-gray-700 text-xs font-bold mb-2"
                       for="full-name">New Password</label>
                <input wire:model="new_password"
                       type="password"
                       class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
                       placeholder="Type your new password"
                       style="transition: all 0.15s ease 0s;"
                />
                @error('new_password') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="relative w-full mb-3 mt-8">
                <label class="block uppercase text-gray-700 text-xs font-bold mb-2"
                       for="full-name">Retype Password</label>
                <input wire:model="retype_password"
                       type="password"
                       class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
                       placeholder="Type your new password"
                       style="transition: all 0.15s ease 0s;"
                />
            </div>

            <div class="text-center mt-6">

                <button
                        class="bg-pink-900 text-white active:bg-pink-700 text-sm font-bold uppercase px-4 py-2 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1"
                        type="submit"
                        style="transition: all 0.15s ease 0s;"
                >
                    Change password
                </button>

            </div>
        </form>
    </div>
</div>