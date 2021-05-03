<div {{ $attributes->merge(['class' => 'w-full flex flex-col items-center']) }}>
	<div>
        {{ $titulo ?? '' }}
    </div>
    <div class="w-full bg-white overflow-hidden">
        {{ $slot }}
    </div>
    <div class="flex justify-end border-t pt-2">
		{{ $footer ?? '' }}
	</div>
</div>
