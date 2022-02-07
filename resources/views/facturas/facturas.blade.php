<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col text-end">
                        <button type="button" class="btn btn-success" id="nueva-factura">
                            <i class="fa fa-plus"></i> Nueva Factura
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <table class="table table-striped table-bordered w-100" id="tabla-facturas"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="modal-facturas">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-facturas">
                    <div class="row">
                        <div class="col-3">
                            <div class="mb-3">
                                <label for="factura-numero-reserva" class="form-label">Número de reserva</label>
                                <select class="form-control" id="factura-numero-reserva" name="id_reserva">
                                    @foreach($data['reservas'] as $reserva)
                                        <option value="{{$reserva->id}}">{{$reserva->id}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mb-3">
                                <label for="factura-pago" class="form-label">Forma de pago</label>
                                <select class="form-control" id="factura-pago" name="forma-pago">
                                    <option value="efectivo">Efectivo</option>
                                    <option value="tarjeta">Tarjeta de crédito</option>
                                    <option value="transferencia">Transferencia bancaria</option>
                                    <option value="cheque">Cheque</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-2" >
                            <div class="mb-3">
                                <label for="factura-fecha-pago" class="form-label">Fecha de pago</label>
                                <input type="text" class="form-control" id="factura-fecha-pago" name="timestamp_pago">
                                <script></script>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fa fa-times"></i> Cerrar
                </button>
                <button type="button" class="btn btn-success aceptar">
                    <i class="fa fa-check"></i> Aceptar
                </button>
            </div>
        </div>
    </div>
</div>
