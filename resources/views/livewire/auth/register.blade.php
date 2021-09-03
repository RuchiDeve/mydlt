
<form class="flex flex-col pt-3 md:pt-8" wire:submit.prevent="doRegistration">

    <div wire:loading wire:target="doRegistration" >
        @livewire('utils.loading', ['message' => 'Registering your account...'])
    </div>


    <div class="flex flex-col pt-4">
        <label for="name" class="text-lg">Name</label>
        <input type="text" id="name" placeholder="Your name"
               wire:model.defer="user.name"
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1
               leading-tight focus:outline-none focus:shadow-outline">
        @error('user.name') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <div class="flex flex-col pt-4">
        <label for="phone" class="text-lg">Phone</label>
        <input type="text" id="phone" placeholder="Your phone"
               wire:model.defer="user.phone"
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1
               leading-tight focus:outline-none focus:shadow-outline">
        @error('user.phone')<span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <div class="flex flex-col pt-4">
        <label for="username" class="text-lg">Username</label>
        <input type="text" id="username" placeholder="username..."
               wire:model.defer="user.username"
               class="shadow appearance-none border rounded w-full py-2 px-3
               text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline">
        @error('user.username') <span class="text-red-500">{{ $message }}</span> @enderror

    </div>

    <div class="flex flex-col pt-4">
        <label for="email" class="text-lg">Email</label>
        <input type="email" id="email" placeholder="your@email.com"
               wire:model.defer="user.email"
               class="shadow appearance-none border rounded w-full py-2 px-3
               text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline">
        @error('user.email') <span class="text-red-500">{{ $message }}</span> @enderror

    </div>

    <div class="flex flex-col pt-4">
        <label for="password" class="text-lg">Password</label>
        <input type="password" id="password"
               wire:model.defer="user.password"
               placeholder="Password"
               class="shadow appearance-none border rounded w-full py-2 px-3
               text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline">
        @error('user.password') <span class="text-red-500">{{ $message }}</span> @enderror

    </div>

    <div class="flex flex-col pt-4">
        <label for="confirm-password" class="text-lg">Confirm Password</label>
        <input type="password" id="confirm-password"
               wire:model.defer="confirm_password"
               placeholder="Password"
               class="shadow appearance-none border rounded w-full py-2 px-3
               text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline">

    </div>

    <input type="submit" value="Register" class="bg-black text-white font-bold text-lg hover:bg-gray-700 p-2 mt-8">

</form>