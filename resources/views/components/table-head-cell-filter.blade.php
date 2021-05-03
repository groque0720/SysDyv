@props(['sort' => '', 'sortSelect' => '' ])

<div {{ $attributes->merge(['class' => 'w-full flex justify-between items-center']) }} >
	<div class="flex-1 flex items-center justify-center">
		<span class="cursor-pointer" wire:click="newOrder('{{ $sort }}')">{{ $slot }}</span>
	</div>
	<div>
		@if ($sortSelect == $sort)
			@if ($this->order == 'asc')
				<i class="fas fa-sort-alpha-down"></i>
			@else
				<i class="fas fa-sort-alpha-up"></i>
				{{-- <i class="fas fa-sort-alpha-down-alt"></i> --}}
			@endif
		@else
			<i class="fas fa-sort"></i>
		@endif
	</div>
</div>