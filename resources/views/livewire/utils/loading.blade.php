<div class="text-white px-2 py-2 border-0 rounded relative mb-4 bg-blue-500 mt-5">

    <div class="loader ease-linear rounded-full border-2 border-t-1 border-gray-200 inline-block mr-7 h-4 w-4 align-middle"></div>

    <span class="inline-block align-middle mr-8">
    <b class="capitalize">Loading!</b>
        {{$message ?? ''}}
  </span>
    {{--<button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none">
        <span>×</span>
    </button>--}}
</div>


@once
<style>
    .loader {
        border-top-color: #3498db;
        -webkit-animation: spinner 1.5s linear infinite;
        animation: spinner 1.5s linear infinite;
    }

    @-webkit-keyframes spinner {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spinner {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
@endonce