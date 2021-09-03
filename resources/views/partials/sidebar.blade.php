@php

    /** @var \App\Models\User $authUser */
    $authUser = auth()->user();
@endphp

<ul class="md:flex-col md:min-w-full flex flex-col list-none mt-4">

    <li class="items-center">
        <a class="text-gray-500 hover:text-pink-600 text-xs uppercase py-3 font-bold block"
           href="/app/dashboard">
            <i class="fas fa-tv opacity-75 mr-2 text-sm"></i>
            Dashboard
        </a>
    </li>


    @if(!$authUser->isMember())
    <li class="items-center">
        <a class="text-gray-500 hover:text-pink-600 text-xs uppercase py-3 font-bold block"
           href="{{route('app.members')}}">
            <i class="fas fa-coins opacity-75 mr-2 text-sm"></i>
            Members
        </a>
    </li>
    @endif

    <li class="items-center">
        <a class="text-gray-500 hover:text-pink-600 text-xs uppercase py-3 font-bold block"
           href="/app/domain">
            <i class="fas fa-coins opacity-75 mr-2 text-sm"></i>
            Domain
        </a>
    </li>


    <li class="items-center">
        <a class="text-gray-500 hover:text-pink-600 text-xs uppercase py-3 font-bold block"
           href="/app/sms">
            <i class="fas fa-coins opacity-75 mr-2 text-sm"></i>
            SMS
        </a>
    </li>

    <li class="items-center">
        <a class="text-gray-500 hover:text-pink-600 text-xs uppercase py-3 font-bold block"
           href="{{route('app.enquiries')}}">
            <i class="fas fa-list-alt opacity-75 mr-2 text-sm"></i>
            Enquiries
        </a>
    </li>

    <li class="items-center">
        <a class="text-gray-500 hover:text-pink-600 text-xs uppercase py-3 font-bold block"
           href="/app/settings">
            <i class="fas fa-cogs opacity-75 mr-2 text-sm"></i>
            Settings
        </a>
    </li>

</ul>