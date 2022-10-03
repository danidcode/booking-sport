@extends('layouts.panel-admin')

@section('content')
<div class="content">
    <div class="content-wrap">
        <div class="actividades-wrap">
            <button class="nueva-actividad-button"> Nueva actividad <i class="fa-solid fa-plus"></i></button>

            <div class="actividades-table-wrap">
                <table class="actividades-table">
                    <tr>
                        <th>Nombre
                                <i class="fa-solid fa-arrow-up-wide-short"></i>
                                <i class="fa-solid fa-arrow-down-wide-short"></i>
                        
                        </th>
                        <th>Límite
                                <i class="fa-solid fa-arrow-up-wide-short"></i>
                                <i class="fa-solid fa-arrow-down-wide-short"></i>
                        </th>
                        <th>Horario
                                <i class="fa-solid fa-arrow-up-wide-short"></i>
                                <i class="fa-solid fa-arrow-down-wide-short"></i>
                        </th>
                        <th>Destacado
                                <i class="fa-solid fa-arrow-up-wide-short"></i>
                                <i class="fa-solid fa-arrow-down-wide-short"></i>
                        </th>
                        <th>Destacado principal
                                <i class="fa-solid fa-arrow-up-wide-short"></i>
                                <i class="fa-solid fa-arrow-down-wide-short"></i>
                        </th>
                        <th>Estatus
                                <i class="fa-solid fa-arrow-up-wide-short"></i>
                                <i class="fa-solid fa-arrow-down-wide-short"></i>
                        </th>
                        <th>Creada
                                <i class="fa-solid fa-arrow-up-wide-short"></i>
                                <i class="fa-solid fa-arrow-down-wide-short"></i>
                        </th>
                        <th>Acciones</th>
                    </tr>
                    

                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src={{ Vite::asset('resources/js/panel-admin/actividades/pizarra.js') }}></script>
@endsection