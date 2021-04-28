@props(['nombre' => 'corazon'])

<span {{ $attributes->merge(['class' => '']) }}>
	@switch($nombre)
	    @case('corazon')  &#x2665 @break //♥
	    @case('check')  &#x1f5f8  @break //🗸
	    @case('nocheck')  &#x2718  @break //✘
	    @case('editar')  &#x1f589  @break //🖉
	    @case('procesando') &#9696 @break // &#x26b2
	    @case('search') <i class="fas fa-search"></i> @break
	    @case('plus-circle') <i class="fas fa-plus-circle"></i> @break
	@endswitch
</span>