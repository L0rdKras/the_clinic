@foreach($reservations as $reservation)
	<tr class="detalleBusqueda">
		<td>
      {{$reservation->reservationDate}}
    </td>
		<td>
      <ul>
        @foreach($reservation->ReservationsInfo as $info)
        <li>
          {{$info->Block->startBlock}} - {{$info->Block->finishBlock}}
        </li>
        @endforeach
      </ul>
    </td>
		<td>
		  {{$reservation->Medic->name}}
		</td>
    <td class="{{$reservation->status}}">
      {{$reservation->status}}
    </td>
	</tr>
@endforeach
