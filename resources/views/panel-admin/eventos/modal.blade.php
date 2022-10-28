<!-- Modal -->
<div class="modal fade" id="modal-eventos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-eventos" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-eventos-titulo">Ver evento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- <div class="modal-eventos-content">
                
            </div>     -->
                <form id="eventos-form">
                    <div class="form-row d-flex justify-content-around">
                        <div class="col-md-3 mb-3">
                            <label>Nombre</label>
                            <input type="text" class="form-control" id="evento-nombre">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Límite de usuarios</label>
                            <input type="text" class="form-control" id="evento-limite">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Fecha de inicio</label>
                            <input type="text" class="form-control" id="evento-inicio">
                        </div>
                    </div>
                    <div class="form-row d-flex justify-content-around mt-2">
                        <div class="form-check form-switch">
                            <label class="form-check-label">¿Destacado?</label>
                            <input class="form-check-input" type="checkbox" role="switch" id="evento-destacado">
                        </div>
                        <div class="form-check form-switch">
                            <label class="form-check-label">¿Destacado principal?</label>
                            <input class="form-check-input" type="checkbox" role="switch" id="evento-destacado-principal">
                        </div>
                    </div>
                    <div class="form-row  d-flex justify-content-center mt-2">
                        <div class="col-6">
                            <label>Descripción</label>
                            <textarea class="form-control" id="evento-descripcion"></textarea>
                        </div>
                    </div>
                    <div class="form-row mt-3  d-flex justify-content-center">
                        <div class="col-6">
                            <label>Imagen</label>
                            @include('components.input-file', ['name' => "evento"])
                          
                        </div>
                    </div>
                    <div class="form-row mt-4  d-flex justify-content-center">
                    <input type="hidden" name="" id="record-id" data-id="0">
                        <button type="button" class="btn-actualizar" onclick="updateevento()"> Actualizar</button>
                        <button type="button" class="btn-crear" onclick="createevento()"> Crear</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
            </div>
        </div>
    </div>
</div>