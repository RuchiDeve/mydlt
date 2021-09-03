<div>
    <form method="post" action="{{route('app.domain.purchase')}}"
          enctype="multipart/form-data">
        @csrf
        <div class="flex flex-col pt-4">
            <input type="hidden" name="amount" value="{{$domain_rate}}">
            <span>
                Cost: NGN{{ number_format($domain_rate, 2) }}
            </span>
        </div>

        <div class="flex flex-col pt-4">
            <label for="" class="text-lg">Proof of payment</label>
            <input type="file" name="proof" wire:model="proof" accept="application/pdf, image/*"
                   class="shadow appearance-none border rounded w-full py-2 px-3
                   text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline">
            @error('proof') <span class="text-red-500">{{ $message }}</span> @enderror

        </div>

        <!--Footer-->
        <div class="flex justify-end pt-2">
            <button class="px-4 bg-indigo-500 py-1 rounded-lg text-gray-100 hover:bg-indigo-400 hover:text-white mr-2">
                Submit
            </button>
        </div>

    </form>
</div>