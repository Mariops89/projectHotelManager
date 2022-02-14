<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col text-end">
                        <button type="button" class="btn btn-success" id="nueva-reserva">
                            <i class="fa fa-plus"></i>
                            <a href="{{route('nueva-reserva')}}" style="color: black">Nueva reserva</a>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <table class="table table-striped table-bordered w-100" id="tabla-reservas"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-detalles">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <div id="datos-reserva">
                   <h3>Datos de la reserva</h3>
                   <div class="row">
                       <div class="col">
                           <div><label>Numero de reserva: </label> <span class="numero-reserva"></span></div>
                           <div><label>Habitación: </label> <span class="habitacion-reserva"></span></div>
                           <div><label>Fecha de entrada: </label> <span class="fecha-entrada"></span></div>
                           <div><label>Fecha de salida: </label> <span class="fecha-salida"></span></div>
                       </div>
                       <div class="col">
                           <div><label>Número de personas: </label> <span class="personas-reserva"></span></div>
                           <div><label>Precio: </label> <span class="precio-reserva"></span></div>
                           <div><label>Late ckeckout: </label> <span class="late-checkout-reserva"></span></div>
                           <div><label>Check-in: </label> <span class="check-in-reserva"></span></div>
                           <div><label>Check-out: </label> <span class="check-out-reserva"></span></div>
                       </div>
                   </div>
               </div>
                <div id="datos-cliente">
                    <h3>Datos del cliente</h3>
                    <div class="row">
                        <div class="col">
                            <div><label>DNI: </label> <span class="dni-cliente-reserva"></span></div>
                            <div><label>Nombre: </label> <span class="nombre-cliente-reserva"></span></div>
                            <div><label>Apellidos: </label> <span class="apellidos-cliente-reserva"></span></div>
                            <div><label>Teléfono: </label> <span class="telefono-cliente-reserva"></span></div>
                        </div>
                        <div class="col">
                            <div><label>Dirección: </label> <span class="direccion-cliente-reserva"></span></div>
                            <div><label>Localidad: </label> <span class="localidad-cliente-reserva"></span></div>
                            <div><label>Código postal: </label> <span class="cp-cliente-reserva"></span></div>
                            <div><label>Provincia: </label> <span class="provincia-cliente-reserva"></span></div>
                            <div><label>País: </label> <span class="pais-cliente-reserva"></span></div>
                        </div>
                    </div>
            <div class="modal-footer justify-content-between" id="detalles-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fa fa-times"></i> Cerrar
                </button>
                <button type="button" class="btn btn-success mx-auto check-in-buttom">
                    <i class="fa fa-check"></i> Checkin
                </button>
                <button type="button" class="btn btn-success check-out-buttom">
                    <i class="fa fa-check"></i> Checkout
                </button>
            </div>
        </div>
    </div>
</div>
</div>
</div> -->

<div class="modal fade" id="modal-create_edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div><label>Numero de reserva: </label> <span class="numero-reserva"></span></div>
                        <div><label>Habitación: </label> <span class="habitacion-reserva"></span></div>
                        <div><label>Factura: </label> <span class="numero-factura"></span></div>
                        <div><label>Fecha de la factura: </label> <span class="fecha-factura"></span></div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="factura-pago" class="form-label">Forma de pago</label>
                            <select class="form-control" id="factura-pago" name="forma_pago">
                                <option value="efectivo">Efectivo</option>
                                <option value="tarjeta">Tarjeta de crédito</option>
                                <option value="transferencia">Transferencia bancaria</option>
                                <option value="cheque">Cheque</option>
                            </select>
                        </div>
                    </div>
                    <hr/>
                    <div id="pago-check">
                        <label>
                            <input type="checkbox" class=pagada" value="pagada">
                            Pagada
                        </label><br>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between" id="detalles-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fa fa-times"></i> Cerrar
                </button>
            </div>
            </div>
        </div>
    </div>
