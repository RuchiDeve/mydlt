

<form class="flex flex-col pt-3 md:pt-8" wire:submit.prevent="doLogin">

    <div wire:loading wire:target="doLogin" >
        @livewire('utils.loading', ['message' => 'Logging into your account...'])
    </div>


    <div class="flex flex-col pt-4">
        <label for="email" class="text-lg">Username</label>
        <input type="text"
               wire:model="username"
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline">
    </div>

    <div class="flex flex-col pt-4">
        <label for="password" class="text-lg">Password</label>
        <input type="password" wire:model="password" id="password" placeholder="Password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline">
    </div>

    <input type="submit" value="Log In" class="bg-black text-white font-bold text-lg hover:bg-gray-700 p-2 mt-8">

</form>