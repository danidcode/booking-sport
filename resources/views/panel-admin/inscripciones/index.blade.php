@extends('layouts.panel-admin')

@section('content')
    <div class="content">
        <div class="content-wrap">
            <div class="inscripciones-wrap">

                <div class="inscripciones-table-wrap">
                    <table class="inscripciones-table">
                        <tr>
                            <th>Evento
                                <i class="fa-solid fa-arrow-up-wide-short" onclick="sort(this)" data-column="evento_nombre"
                                    data-order="asc"></i>
                                <i class="fa-solid fa-arrow-down-wide-short" onclick="sort(this)" data-column="evento_nombre"
                                    data-order="desc"></i>

                            </th>
                            <th>Usuario
                                <i class="fa-solid fa-arrow-up-wide-short" onclick="sort(this)" data-column="user_nombre"
                                    data-order="asc"></i>
                                <i class="fa-solid fa-arrow-down-wide-short" onclick="sort(this)" data-column="user_nombre"
                                    data-order="desc"></i>

                            </th>
                            <th>Fecha del evento
                                <i class="fa-solid fa-arrow-up-wide-short" onclick="sort(this)"
                                    data-column="evento_fecha_inicio" data-order="asc"></i>
                                <i class="fa-solid fa-arrow-down-wide-short" onclick="sort(this)"
                                    data-column="evento_fecha_inicio" data-order="desc"></i>
                            </th>
                            <th>Días restantes
                            </th>
                            <th>Estado
                            </th>
                            <th>Fecha de realización
                                <i class="fa-solid fa-arrow-up-wide-short" onclick="sort(this)"
                                    data-column="evento_fecha_inicio" data-order="asc"></i>
                                <i class="fa-solid fa-arrow-down-wide-short" onclick="sort(this)"
                                    data-column="evento_fecha_inicio" data-order="desc"></i>
                            </th>
                            <th>Acciones</th>
                        </tr>


                    </table>
                </div>
                <div class="inscripciones-pagination-wrap">
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
    <script src={{ Vite::asset('resources/js/panel-admin/inscripciones/pizarra.js') }}></script>
@endsection
