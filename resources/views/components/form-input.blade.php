@props(['label', 'required', 'type', 'name', 'placeholder', 'info', 'value', 'multiple' => false])

<div class="w-full px-3">
    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
        {{ $label }} <span class="text-danger text-red-700">{{ $required ?? '' }}</span>
    </label>
    <input type="{{ $type }}" name="{{ $name }}"
        {{$attributes->merge(['class'=>"appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"])}}
        placeholder="{{ $placeholder ?? $label }}" value="{{ $value ?? old($name) }}"
        @if ($type == 'number') min="1" @endif {{ $multiple ? 'multiple' : '' }}>
    <p class="text-info text-blue-600 text-xs italic">
        {{ $info ?? '' }}
    </p>


    @if ($errors->has($name))
        <p class="text-danger text-red-600" role="alert">
            <small>
                {{ $errors->first($name) }}
            </small>
        </p>
    @endif
</div>
