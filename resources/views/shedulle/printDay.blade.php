@extends('printLayout')

@section('content')
<div class="panel-body">
  <h2>
    Atenciones sala {{$room}} fecha {{$day}}/{{$month}}/{{$year}}
  </h2>
  <table class="table table-hover table-bordered">
    <thead>
      <tr>
        <th>Bloque</th>
        <th>Paciente</th>
        <th>Atencion</th>
        <th>Profecional</th>
        <th>Estado</th>
      </tr>
    </thead>
    <tbody>
      {!! $filas !!}
    </tbody>
  </table>
</div>
@endsection
