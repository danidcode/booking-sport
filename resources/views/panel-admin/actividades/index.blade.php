@extends('layouts.panel-admin')

@section('content')
    <div class="content">
        <div class="content-wrap">
            <div class="actividades-wrap">
                <button class="nueva-actividad-button"> Nueva actividad <i class="fa-solid fa-plus"></i></button>

                <div class="actividades-table-wrap">
                    <table class="actividades-table">
                        <tr>
                            <th>Imagen
                            </th>
                            <th>Nombre
                                <i class="fa-solid fa-arrow-up-wide-short" onclick="sort(this)" data-column="nombre"
                                    data-order="asc"></i>
                                <i class="fa-solid fa-arrow-down-wide-short" onclick="sort(this)" data-column="nombre"
                                    data-order="desc"></i>

                            </th>
                            <th>Límite
                                <i class="fa-solid fa-arrow-up-wide-short" onclick="sort(this)"
                                    data-column="limite_usuarios" data-order="asc"></i>
                                <i class="fa-solid fa-arrow-down-wide-short" onclick="sort(this)"
                                    data-column="limite_usuarios" data-order="desc"></i>
                            </th>
                            <th>Días activa
                            </th>
                            <th>Nº de reservas
                            </th>
                            <th>Destacado
                                <i class="fa-solid fa-arrow-up-wide-short" onclick="sort(this)" data-column="destacado"
                                    data-order="asc"></i>
                                <i class="fa-solid fa-arrow-down-wide-short" onclick="sort(this)" data-column="destacado"
                                    data-order="desc"></i>
                            </th>
                            <th>Estatus
                                <i class="fa-solid fa-arrow-up-wide-short" onclick="sort(this)" data-column="activo"
                                    data-order="asc"></i>
                                <i class="fa-solid fa-arrow-down-wide-short" onclick="sort(this)" data-column="activo"
                                    data-order="desc"></i>
                            </th>
                            <th>Creada
                                <i class="fa-solid fa-arrow-up-wide-short" onclick="sort(this)" data-column="created_at"
                                    data-order="asc"></i>
                                <i class="fa-solid fa-arrow-down-wide-short" onclick="sort(this)" data-column="created_at"
                                    data-order="desc"></i>
                            </th>
                            <th>Acciones</th>
                        </tr>


                    </table>
                </div>
                <div class="actividades-pagination-wrap">
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
    <script src={{ Vite::asset('resources/js/panel-admin/actividades/pizarra.js') }}></script>
@endsection


@include('panel-admin.actividades.modal')
