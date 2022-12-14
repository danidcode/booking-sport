@extends('layouts.panel-admin')

@section('content')
    <div class="content">
        <div class="content-wrap">
            <div class="reservas-wrap">

                <div class="reservas-table-wrap">
                    <table class="reservas-table">
                        <tr>
                            <th>Actividad
                                <i class="fa-solid fa-arrow-up-wide-short" onclick="sort(this)" data-column="actividad_nombre"
                                    data-order="asc"></i>
                                <i class="fa-solid fa-arrow-down-wide-short" onclick="sort(this)" data-column="actividad_nombre"
                                    data-order="desc"></i>

                            </th>
                            <th>Usuario
                                <i class="fa-solid fa-arrow-up-wide-short" onclick="sort(this)" data-column="user_nombre"
                                    data-order="asc"></i>
                                <i class="fa-solid fa-arrow-down-wide-short" onclick="sort(this)" data-column="user_nombre"
                                    data-order="desc"></i>

                            </th>
                            <th>Fecha de la reserva
                                <i class="fa-solid fa-arrow-up-wide-short" onclick="sort(this)"
                                    data-column="fecha_reserva" data-order="asc"></i>
                                <i class="fa-solid fa-arrow-down-wide-short" onclick="sort(this)"
                                    data-column="fecha_reserva" data-order="desc"></i>
                            </th>
                            <th>Días restantes
                            </th>
                            <th>Estado
                            </th>
                            <th>Fecha de realización
                                <i class="fa-solid fa-arrow-up-wide-short" onclick="sort(this)"
                                data-column="created_at" data-order="asc"></i>
                            <i class="fa-solid fa-arrow-down-wide-short" onclick="sort(this)"
                                data-column="created_at" data-order="desc"></i>
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
    <script src={{ Vite::asset('resources/js/panel-admin/reservas/pizarra.js') }}></script>
@endsection
