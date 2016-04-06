@foreach($blocks as $block)
<tr id="bloque{{$block->id}}" data-id-block="{{$block->id}}" class="filaAgenda">
	<th>{{$block->startBlock}} a {{$block->finishBlock}}</th>
	<th></th>
	<th></th>
	<th></th>
</tr>
@endforeach
