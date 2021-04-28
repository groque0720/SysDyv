@props(['items', 'multiple' => false, 'disabled' => false, 'error' => ''])

<Select {{ $multiple ? 'multiple' : '' }} {{ $attributes->merge(['class' => "rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"]) }}>
	{{-- @foreach ($items as $key => $item)
		<option value="{{ $item }}">{{ $item }}</option>
	@endforeach --}}
	{{ $slot }}
</Select>

@if ($error)
	<span class="text-red-400 text-xs pl-2 mt-1">
	    {{ $error }}
	</span>
@endif