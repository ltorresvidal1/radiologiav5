<div wire:ignore x-data="{ }" x-init="() => {
	$('.select2').select2();
	$('.select2').on('change', function(e) {

	let elementName = $(this).attr('id');
	@this.set(elementName, e.target.value);
		Livewire.hook('message.processed', (m, component) => {
			$('.select2').select2();
		})

	})
}">
    <select class="select2" {{$attributes}} style="width: 100%;">
        <option value="">--- Seleccionar ---</option>
        @foreach ($options as $option)
        <option value="{{$option->id}}">{{$option->nombre}}</option>
        @endforeach
    </select>
</div>