
            <li class="nav-item {{ request()->is('solicitar') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.solicitudesR.create') }}">
                    <span>{{ __('Reserva de Ambiente') }}</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('solicitudes') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('admin.solicitudesR.index')}}">
                    <span>{{ __('Lista de Solicitudes') }}</span>
                </a>
            </li>


            <li class="nav-item {{ request()->is('ambientes*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('admin.ambientes.index', ['tipo'=> 'all' ])}}">
                        <span>{{ __('Lista de Ambiente') }}</span>
                    </a>
            </li>


            <li class="nav-item {{ request()->is('solicitar*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('admin.docMaterias.index')}}">
                        <span>{{ __('Asignar Materia a Docente') }}</span>
                    </a>
            </li>


            <li class="nav-item  {{ request()->is('ambientesR') ? 'active' : '' }}" >
                <a class="nav-link" href="{{ route('admin.ambientes.index', ['tipo'=> 'admin']) }}">
                    <span>{{ __('Ambientes Reservadas') }}</span></a>
            </li>



            <li class="nav-item {{ request()->is('solicitar')  ? 'active' : '' }}">
                <a class="nav-link" href="#">
                    <span>{{ __('Lista Materias Reservadas') }}</span></a>
            </li>

            <li class="nav-item {{ request()->is('usuarios')  ? 'active' : ''}}">
                <a class="nav-link" href="{{route('admin.usuarios.index')}}">
                    <span>{{ __('Registrar docente ') }}</span></a>
            </li>

            <li class="nav-item {{ request()->is('notificaciones')  ? 'active' : ''}}">
                <a class="nav-link" href="{{route('admin.notificaciones.index')}}">
                    <span>{{ __('Notificaciones de Reserva') }}</span></a>
            </li>

        </ul>
