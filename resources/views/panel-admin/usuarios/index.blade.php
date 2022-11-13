@extends('layouts.panel-admin')

@section('content')
    <div class="content">
        <div class="content-wrap">
            <div class="usuarios-wrap">

                <div class="usuarios-table-wrap">
                    <table class="usuarios-table">
                        <tr>
                            <th>Nombre
                            </th>
                            <th>Email
                            </th>
                            <th>Reservas realizadas
                            </th>
                            <th>Inscripciones realizadas
                            </th>

                            <th>Fecha de creación
                            </th>
                            <th>Acciones</th>
                        </tr>


                    </table>
                </div>
                <div class="usuarios-pagination-wrap">
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
    <script src={{ Vite::asset('resources/js/panel-admin/usuarios/pizarra.js') }}></script>
@endsection
