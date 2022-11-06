@extends('layouts.panel-user')

@section('content')
    <div class="content">
        <div class="content-wrap">
            <div class="reservas-wrap">

                <div class="reservas-table-wrap">
                    <table class="reservas-table">
                        <tr>
                            <th>Actividad
                                <i class="fa-solid fa-arrow-up-wide-short" onclick="sort(this)" data-column="nombre"
                                    data-order="asc"></i>
                                <i class="fa-solid fa-arrow-down-wide-short" onclick="sort(this)" data-column="nombre"
                                    data-order="desc"></i>

                            </th>
                            <th>Fecha de la reserva
                                <i class="fa-solid fa-arrow-up-wide-short" onclick="sort(this)"
                                    data-column="limite_usuarios" data-order="asc"></i>
                                <i class="fa-solid fa-arrow-down-wide-short" onclick="sort(this)"
                                    data-column="limite_usuarios" data-order="desc"></i>
                            </th>
                            <th>Días restantes
                            </th>
                            <th>Fecha de realización
                            </th>
                            <th>Acciones</th>
                        </tr>


                    </table>
                </div>
                <div class="reservas-pagination-wrap">
                    <ul class="pagination-list">
                        <li><a href="#"><i class="fa-solid fa-chevron-left"></i></a></li>
                        <li><a href="#"><i class="fa-solid fa-chevron-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src={{ Vite::asset('resources/js/panel-user/reservas/pizarra.js') }}></script>
@endsection

{{-- @include('panel-user.reservas.modal') --}}
