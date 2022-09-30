@props(['label', 'required' => false, 'info', 'name'])


<div class="w-full md:w-1/2 px-3">
    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
        {{ $label }} <span class="text-danger text-red-700">{{ $required ?? '' }}</span>
    </label>

    <select name="{{$name}}" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
        {{$slot}}
    </select>
    <p class="text-info text-blue-600 text-xs italic">
        {{ $info ?? '' }}
    </p>

</div>