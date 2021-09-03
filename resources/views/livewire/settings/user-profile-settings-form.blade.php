@php

/** @var \App\Models\User $user */

@endphp

<div class="rounded shadow-lg w-full mb-6 relative flex flex-col ">
    <div class="w-full bg-white rounded px-8 pt-6 pb-8">
        <form class="" wire:submit.prevent="updateProfile">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Name
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight
                focus:outline-none focus:shadow-outline" id="name"
                       wire:model="user.name"
                       type="text" placeholder="Full name">
                @error('user.name') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight
                focus:outline-none focus:shadow-outline" id="email"
                       wire:model="user.email"
                       type="email" placeholder="Email...">
                @error('user.email') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
                    Phone
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight
                focus:outline-none focus:shadow-outline" id="phone"
                       wire:model="user.phone"
                       type="text" placeholder="Phone">
                @error('user.phone') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4
                rounded focus:outline-none focus:shadow-outline" type="submit">
                    Update profile
                </button>
            </div>
        </form>
    </div>
</div>
