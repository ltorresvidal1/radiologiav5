<div>

    @if(count($tansitos)<0) @else <table id="datatableDefault" class="table text-nowrap w-100">
        <thead>
            <tr>

                <th>Paciente</th>
                <th>Admision</th>
                <th>Fecha</th>
                <th>Estudio</th>

                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tansitos as $tansito)
            <tr>
                <td>{{$tansito->nombre}}</td>
                <td>{{$tansito->admision}}</td>
                <td>{{$tansito->fecha}}</td>
                <td>{{$tansito->estudio}}</td>

                <td>
                    <a href="{{ route('rispacientes.edit', $tansito->id) }}" class="dropdown-item"><i class="fa fa-share fa-fw fa-lg"></i> Procesar</a>
                </td>
            </tr>

            @endforeach


        </tbody>
        </table>

        @endif

</div>