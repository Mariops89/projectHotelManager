<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-auto">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                            <input type="text" class="form-control" id="fechas">
                        </div>
                    </div>
                    <div class="col text-end">
                        <a href="{{route('nueva-reserva')}}" class="btn btn-success">
                            <i class="fa fa-plus"></i> Nueva reserva
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <table class="table table-striped table-bordered w-100 text-nowrap" id="tabla-reservas"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-detalles">
    <div class="modal-dialog modal-lg">
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
                           <div><b>Numero de reserva: </b> <span class="numero-reserva"></span></div>
                           <div><b>Habitación: </b> <span class="habitacion-reserva"></span></div>
                           <div><b>Fecha de entrada: </b> <span class="fecha-entrada"></span></div>
                           <div><b>Fecha de salida: </b> <span class="fecha-salida"></span></div>
                       </div>
                       <div class="col">
                           <div><b>Número de personas: </b> <span class="personas-reserva"></span></div>
                           <div><b>Precio: </b> <span class="precio-reserva"></span></div>
                           <div><b>Late ckeckout: </b> <span class="late-checkout-reserva"></span></div>
                           <div><b>Check-in: </b> <span class="check-in-reserva"></span></div>
                           <div><b>Check-out: </b> <span class="check-out-reserva"></span></div>
                       </div>
                    </div>
                </div>
                <div id="datos-cliente">
                    <h3>Datos del cliente</h3>
                    <div class="row">
                        <div class="col">
                            <div><b>DNI: </b> <span class="dni-cliente-reserva"></span></div>
                            <div><b>Nombre: </b> <span class="nombre-cliente-reserva"></span></div>
                            <div><b>Apellidos: </b> <span class="apellidos-cliente-reserva"></span></div>
                            <div><b>Teléfono: </b> <span class="telefono-cliente-reserva"></span></div>
                        </div>
                        <div class="col">
                            <div><b>Dirección: </b> <span class="direccion-cliente-reserva"></span></div>
                            <div><b>Localidad: </b> <span class="localidad-cliente-reserva"></span></div>
                            <div><b>Código postal: </b> <span class="cp-cliente-reserva"></span></div>
                            <div><b>Provincia: </b> <span class="provincia-cliente-reserva"></span></div>
                            <div><b>País: </b> <span class="pais-cliente-reserva"></span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between" id="detalles-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fa fa-times"></i> Cerrar
                </button>
                <div>
                    <button type="button" class="btn btn-success mx-auto check-in-button">
                        <i class="fas fa-sign-in-alt"></i> Registrar check-in
                    </button>
                    <button type="button" class="btn btn-danger check-out-button">
                        <i class="fas fa-sign-out-alt"></i> Registrar check-out
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-factura">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div><b>Factura: </b> <span class="numero-factura"></span></div>
                        <div><b>Numero de reserva: </b> <span class="numero-reserva"></span></div>
                        <div><b>Cliente: </b> <span class="cliente"></span></div>
                    </div>
                    <div class="col">
                        <div><b>Fecha de la factura: </b> <span class="fecha-factura"></span></div>
                        <div><b>Habitación: </b> <span class="habitacion-reserva"></span></div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <table class="table table-sm" id="tabla-lineas">
                            <thead>
                            <tr>
                                <th>Concepto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Base imponible</th>
                                <th>IVA</th>
                                <th>Subtotal</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                            <th colspan="3" class="text-end"><div class="px-3">TOTALES</div></th>
                            <th class="subtotal"></th>
                            <th class="iva"></th>
                            <th class="total"></th>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <form id="form-factura">
                    <div class="row mt-3">
                        <div class="col-3">
                            <div class="mb-3">
                                <label>Pagada</label>
                                <div class="px-3">
                                    <input type="checkbox" class="pagada" name="pagada">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="factura-pago" class="form-label">Forma de pago</label>
                                <select class="form-control" id="factura-pago" name="forma_pago">
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Tarjeta">Tarjeta de crédito</option>
                                    <option value="Transferencia">Transferencia bancaria</option>
                                    <option value="Cheque">Cheque</option>
                                </select>
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
