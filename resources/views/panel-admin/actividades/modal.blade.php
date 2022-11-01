<!-- Modal -->
<div class="modal fade" id="modal-actividades" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="modal-actividades" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-actividades-titulo">Ver actividad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- <div class="modal-actividades-content">
                
            </div>     -->
                <form id="actividades-form">
                    <div class="form-row d-flex justify-content-around">
                        <div class="col-md-3 mb-3">
                            <label>Nombre</label>
                            <input type="text" class="form-control" id="actividad-nombre">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Límite de usuarios</label>
                            <input type="text" class="form-control" id="actividad-limite">
                        </div>
                    </div>
                    <div class="form-row d-flex justify-content-around mt-2">
                        <div class="form-check form-switch">
                            <label class="form-check-label">¿Destacado?</label>
                            <input class="form-check-input" type="checkbox" role="switch" id="actividad-destacado">
                        </div>
                        <div class="form-check form-switch">
                            <label class="form-check-label">¿Destacado principal?</label>
                            <input class="form-check-input" type="checkbox" role="switch" id="actividad-destacado-principal">
                        </div>
                        <div class="form-check form-switch">
                            <label class="form-check-label">Activo?</label>
                            <input class="form-check-input" type="checkbox" role="switch" id="actividad-activo">
                        </div>
                    </div>
                    <div class="form-row  d-flex justify-content-center mt-2">
                        <div class="col-6">
                            <label>Descripción</label>
                            <textarea class="form-control" id="actividad-descripcion"></textarea>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <select name="states" id="example" class="form-control"  multiple="multiple" style="display: none;">
                            2
                              <option value="AL">Alabama</option>
                            3
                              <option value="AK">Alaska</option>
                            4
                              <option value="AZ">Arizona</option>
                            5
                              <option value="AR">Arkansas</option>
                            6
                              <option selectedvalue="CA">California</option>
                            7
                              ...
                            8
                            </select>
                        
                    </div>
                    <div class="form-row mt-3  d-flex justify-content-center">
                        <div class="col-6">
                            <label>Imagen</label>
                            @include('components.input-file', ['name' => "actividad"])
                          
                        </div>
                    </div>
                    <div class="form-row mt-4  d-flex justify-content-center">
                    <input type="hidden" name="" id="record-id" data-id="0">
                        <button type="button" class="btn-actualizar" onclick="updateActividad()"> Actualizar</button>
                        <button type="button" class="btn-crear" onclick="createActividad()"> Crear</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
            </div>
        </div>
    </div>
</div>