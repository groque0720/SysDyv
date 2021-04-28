@props(['disabled' => false, 'error' => ''])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 '.($error ? 'border-red-500 bg-red-50': '') ]) !!}>


@if ($error)
	<span class="text-red-400 text-xs pl-2 mt-1">
	    {{ $error }}
	</span>
@endif