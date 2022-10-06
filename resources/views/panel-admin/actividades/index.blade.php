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




<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>