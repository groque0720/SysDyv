@props(['trigger'])

<div
	class="fixed top-0 left-0 h-screen w-full bg-gray-900 bg-opacity-60 flex justify-center items-center"
	x-show="{{ $trigger }}"
	x-on:click.self="{{ $trigger }} = false"
	x-on:keydown.escape.window = "{{ $trigger }} = false"
	x-cloak
	>
	<div {{ $attributes->merge(['class' => 'm-auto bg-white shadow-2xl rounded-xl p-3 flex flex-col']) }} >
		<div class="flex justify-between border-b right-3 pb-2 items-center">
			<div class="flex items-center">
				<span class="font-extrabold">{{ $titulo ?? '' }}</span>
			</div>
			<div class="flex items-center">
				<span class="border rounded p-1 px-2 cursor-pointer hover:bg-gray-300 text bg-blue-100" x-on:click="{{ $trigger }} = false">Esc</span>
			</div>
		</div>
		<div class="flex-grow">
			{{ $slot }}
		</div>
		<div class="flex justify-end border-t pt-2">
			{{ $footer ?? '' }}
		</div>
    </div>
</div>