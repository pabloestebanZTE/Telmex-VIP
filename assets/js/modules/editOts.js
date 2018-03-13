$(function () {
    var ini = {
        timers: [],
        init: function () {
            ini.events();
            ini.listVmAssigned();
        },
        //Eventos de la ventana.
        events: function () {
            //Al darle clic a una fila llama la funcion onClickTrTablaEditOts
            $('#tablaEditOts').on('click', 'tr', ini.onClickTrTablaEditOts);
        },
        // Capturo los valores de la fila a la que le doy clic
        onClickTrTablaEditOts: function () {
            var tr = $(this);
            ini.tr = tr;
            if (ini.tablaEditOts) {
                var registro = ini.tablaEditOts.row(tr).data();
                //si selecciona el header de la tabla no se muestre el modal
                if (registro != undefined) {
                    ini.modalEditar(registro);
                }
            }

        },
        //llama el modal
        modalEditar: function (registro) {
            //mostrar modal
            $('#modalEditTicket').modal('show');
        },
        /**
         * Listará las actividades de los usuarios que ingresan al sistema...
         */
        listVmAssigned: function () {
            //Invoca fillTable para configurar la TABLA.
            // ini.fillTable([]);
            //Realiza la petición AJAX para traer los datos...
            var alert = dom.printAlert('Consultando registros, por favor espere.', 'loading', $('#principalAlert'));
            app.post('OtHija/getOtsAssigned')
                    .complete(function () {
                        alert.hide();
                        $('.contentPrincipal').removeClass('hidden');
                    })
                    .success(function (response) {
                        console.log(response);
                        if (app.successResponse(response)) {
                            ini.fillTable(response.data);
                        } else {
                            ini.fillTable([]);
                        }
                    }).error(function (e) {
                console.error(e);
            }).send();
        },
        //Temporalmente...
        fillNA: function () {
            return "N/A";
        },
        fillTable: function (data) {
            if (ini.tablaEditOts) {
                dom.refreshTable(ini.tablaEditOts, data);
                return;
            }
            ini.tablaEditOts = $('#tablaEditOts').DataTable(dom.configTable(data,
                    [
                        {title: "Id Cliente Onyx", data: "id_cliente_onyx"},
                        {title: "Nombre Cliente", data: "nombre_cliente"},
                        {title: "Id Orden Trabajo Hija", data: "id_orden_trabajo_hija"},
                        {title: "Ot Hija", data: "ot_hija"},
                        {title: "Estado Orden Trabajo Hija", data: "estado_orden_trabajo_hija"},
                        {title: "Dias", data: "n_days"},
                    ],
                    ));
        }
    };

    ini.init();
});