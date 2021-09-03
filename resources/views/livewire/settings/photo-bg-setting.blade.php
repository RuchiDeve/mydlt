
<div class="rounded shadow-lg w-full mb-6 relative flex flex-col ">
    <div class="w-full">
        <form class="bg-white shadow-md rounded w-full px-8 pt-6 pb-8" wire:submit.prevent="save">
            <div wire:loading wire:target="save" >
                @livewire('utils.loading', ['message' => 'Updating...'])
            </div>

            @if ($photo)
                <div class="bg-gray-400">
                    <img class="object-cover h-48 w-full" src="{{$photo->temporaryUrl()}}">
                </div>
            @endif

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="photo-setting">
                    Background Photo
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                leading-tight focus:outline-none focus:shadow-outline" id="photo-setting" type="file"
                       placeholder="https://www.youtube.com/embed/xxxxxxxx"
                       wire:model="photo">
                @error('photo') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-between">
                @if($saved)
                    <p class="text-white bg-green-600 p-4 text-center">
                        Updated!
                    </p>
                @else
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1
                px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Set Background Photo
                    </button>
                @endif
            </div>
        </form>
    </div>
</div>