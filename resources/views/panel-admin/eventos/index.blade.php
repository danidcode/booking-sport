@extends('layouts.panel-admin')

@section('content')
    <div class="content">
        <div class="content-wrap">
            <div class="eventos-wrap">
                <button class="nuevo-evento-button"> Nuevo evento <i class="fa-solid fa-plus"></i></button>

                <div class="eventos-table-wrap">
                    <table class="eventos-table">
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
                            <th>Fecha de inicio
                                <i class="fa-solid fa-arrow-up-wide-short" onclick="sort(this)" data-column="fecha-inicio"
                                    data-order="asc"></i>
                                <i class="fa-solid fa-arrow-down-wide-short" onclick="sort(this)" data-column="fecha-inicio"
                                    data-order="desc"></i>
                            </th>
                            <th>Destacado
                                <i class="fa-solid fa-arrow-up-wide-short" onclick="sort(this)" data-column="destacado"
                                    data-order="asc"></i>
                                <i class="fa-solid fa-arrow-down-wide-short" onclick="sort(this)" data-column="destacado"
                                    data-order="desc"></i>
                            </th>
                            <th>Destacado principal
                                <i class="fa-solid fa-arrow-up-wide-short" onclick="sort(this)"
                                    data-column="destacado_principal" data-order="asc"></i>
                                <i class="fa-solid fa-arrow-down-wide-short" onclick="sort(this)"
                                    data-column="destacado_principal" data-order="desc"></i>
                            </th>
                            <th>Creado
                                <i class="fa-solid fa-arrow-up-wide-short" onclick="sort(this)" data-column="created_at"
                                    data-order="asc"></i>
                                <i class="fa-solid fa-arrow-down-wide-short" onclick="sort(this)" data-column="created_at"
                                    data-order="desc"></i>
                            </th>
                            <th>Acciones</th>
                        </tr>


                    </table>
                </div>
                <div class="eventos-pagination-wrap">
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
    <script src={{ Vite::asset('resources/js/panel-admin/eventos/pizarra.js') }}></script>
@endsection


@include('panel-admin.eventos.modal')
