@extends('layouts.panel-user')

@section('content')
    <div class="content">
        <div class="content-wrap">
            <div class="inscripciones-wrap">

                <div class="inscripciones-table-wrap">
                    <table class="inscripciones-table">
                        <tr>
                            <th>Evento
                            </th>
                            <th>Fecha del evento
                            </th>
                            <th>Días restantes
                            </th>
                            <th>Fecha de realización
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
    <script src={{ Vite::asset('resources/js/panel-user/inscripciones/pizarra.js') }}></script>
@endsection

