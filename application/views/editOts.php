<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <body data-base="<?= URL::base() ?>">
        <?php $this->load->view('parts/generic/header'); ?>
        <br><br>
        <div class="container autoheight p-t-20 m-t-20">
            <div class="alert alert-success alert-dismissable hidden" id="principalAlert">
                <a href="#" class="close">&times;</a>
                <p id="text" class="m-b-0 p-b-0"></p>
            </div>
            <label id="lblProgressInformation" class="hidden">0 de 0</label>
            <div class="progress hidden" id="progressProcessImportData">
                <div class="progress-bar progress-bar-striped active" role="progressbar"
                     aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                    0%
                </div>
            </div>
            <!--            <div>
                            <script type='text/javascript' src='http://181.49.46.6/javascripts/api/viz_v1.js'></script><div class='tableauPlaceholder' style='width: 100%; height: 619px;'><object class='tableauViz' width='100%' height='619' style='display:none;'><param name='host_url' value='http%3A%2F%2F181.49.46.6%2F' /> <param name='embed_code_version' value='3' /> <param name='site_root' value='' /><param name='name' value='TVIPInstalaciones&#47;EstadodeOTs' /><param name='tabs' value='no' /><param name='toolbar' value='yes' /><param name='showAppBanner' value='false' /><param name='filter' value='iframeSizedToWindow=true' /></object></div>
                        </div>-->
            <form class= 'well form-horizontal' enctype= 'multipart/form-data'>
                <fieldset>
                    <div class="row">
                        <div class="col col-md-12" style="text-align: center;">
                            <button class="btn btn-danger" id="btnOtsfiteenDays">OTs mas de 15 días</button>
                        </div>
                        <div class="col col-md-12 p-t-40">
                            <input type="hidden" value="<?= Auth::getRole() ?>" id="rol">
                            <table id="tablaEditOts" class="table table-hover table-striped" width="100%"></table>
                            <br/>
                        </div>
                    </div>
                </fieldset>
            </form>

            <!-- Modal editar OTs -->
            <div id="modalEditTicket" class="modal fade" role="dialog" >
                <div class="modal-dialog modal-lg2" style="width: 1000px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                            <h3 class="modal-title" id="myModalLabel"></h3>
                        </div>
                        <div class="modal-body">
                            <div>
                                <form class="well form-horizontal" id="formModal" action="OtHija/updateStatusOt" method="post" novalidate="novalidate">
                                    <input name="k_id_register" id="k_id_register" type="hidden">
                                    <input name="estado_orden_trabajo_hija" id="estado_orden_trabajo_hija" type="hidden">
                                    <fieldset>
                                        <div class="widget bg_white m-t-25 display-block">
                                            <fieldset class="col-md-6">
                                                <div class="form-group">
                                                    <label for="id_cliente_onyx" class="col-md-3 control-label">Id cliente onyx: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                                            <input name="id_cliente_onyx" id="id_cliente_onyx" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="nombre_cliente" class="col-md-3 control-label">Nombre cliente: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-dashboard"></i></span>
                                                            <input name="nombre_cliente" id="nombre_cliente" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="grupo_objetivo" class="col-md-3 control-label">Grupo Objetivo: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                            <input name="grupo_objetivo" id="grupo_objetivo" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <!--  fin seccion izquierda form-->

                                            <!--  inicio seccion derecha form-->
                                            <fieldset>
                                                <div class="form-group">
                                                    <label for="segmento" class="col-md-3 control-label">Segmento: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="statusColor"><i class="glyphicon glyphicon-hand-right"></i></span>
                                                            <input name="segmento" id="segmento" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="nivel_atencion" class="col-md-3 control-label">Nivel Atención: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                                            <input name="nivel_atencion" id="nivel_atencion" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="ciudad" class="col-md-3 control-label">ciudad: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                            <input name="ciudad" id="ciudad" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>                 
                                            </fieldset>
                                            <!--  fin seccion derecha form---->
                                        </div>

                                        <div class="widget bg_white m-t-25 display-block">
                                            <fieldset class="col-md-6 control-label">
                                                <div class="form-group">
                                                    <label for="departamento" class="col-md-3 control-label">departamento: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="departamento" id="departamento" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="grupo" class="col-md-3 control-label">grupo: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="grupo" id="grupo" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="consultor_comercial" class="col-md-3 control-label">Consultor Comercial: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="consultor_comercial" id="consultor_comercial" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <!--  fin seccion izquierda form---->

                                            <!--  inicio seccion derecha form---->
                                            <fieldset>
                                                <div class="form-group">
                                                    <label for="grupo2" class="col-md-3 control-label">Grupo 2: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="grupo2" id="grupo2" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="consultor_postventa" class="col-md-3 control-label">Consultor Postventa: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="consultor_postventa" id="consultor_postventa" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="proy_instalacion" class="col-md-3 control-label">Proy Instalacion: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="proy_instalacion" id="proy_instalacion" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <div class="widget bg_white m-t-25 display-block">
                                            <fieldset class="col-md-6 control-label">
                                                <div class="form-group">
                                                    <label for="ing_responsable" class="col-md-3 control-label">Ingeniero Responsable: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="ing_responsable" id="ing_responsable" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="id_enlace" class="col-md-3 control-label">Id Enlace: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="id_enlace" id="id_enlace" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="alias_enlace" class="col-md-3 control-label">Alias Enlace: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="alias_enlace" id="alias_enlace" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <!--  fin seccion izquierda form---->

                                            <!--  inicio seccion derecha form---->
                                            <fieldset>
                                                <div class="form-group">
                                                    <label for="orden_trabajo" class="col-md-3 control-label">Orden Trabajo: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="orden_trabajo" id="orden_trabajo" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="nro_ot_onyx" class="col-md-3 control-label">Nro Ot Onyx: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="nro_ot_onyx" id="nro_ot_onyx" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="servicio" class="col-md-3 control-label">Servicio: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="servicio" id="servicio" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <div class="widget bg_white m-t-25 display-block">
                                            <fieldset class="col-md-6 control-label">
                                                <div class="form-group">
                                                    <label for="familia" class="col-md-3 control-label">Familia: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="familia" id="familia" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="producto" class="col-md-3 control-label">Producto: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="producto" id="producto" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="fecha_creacion" class="col-md-3 control-label">Fecha Creacion: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="fecha_creacion" id="fecha_creacion" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <!--  fin seccion izquierda form---->

                                            <!--  inicio seccion derecha form---->
                                            <fieldset>
                                                <div class="form-group">
                                                    <label for="tiempo_incidente" class="col-md-3 control-label">Tiempo Incidente: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="tiempo_incidente" id="tiempo_incidente" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="estado_orden_trabajo" class="col-md-3 control-label">Estado Orden Trabajo: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="estado_orden_trabajo" id="estado_orden_trabajo" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tiempo_estado" class="col-md-3 control-label">Tiempo Estado: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="tiempo_estado" id="tiempo_estado" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <div class="widget bg_white m-t-25 display-block">
                                            <fieldset class="col-md-6 control-label">
                                                <div class="form-group">
                                                    <label for="ano_ingreso_estado" class="col-md-3 control-label">Año Ingreso Estado: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="ano_ingreso_estado" id="ano_ingreso_estado" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="mes_ngreso_estado" class="col-md-3 control-label">Mes Ingreso Estado: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="mes_ngreso_estado" id="mes_ngreso_estado" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="fecha_ingreso_estado" class="col-md-3 control-label">Fecha Ingreso Estado: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="fecha_ingreso_estado" id="fecha_ingreso_estado" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <!--  fin seccion izquierda form---->

                                            <!--  inicio seccion derecha form---->
                                            <fieldset>
                                                <div class="form-group">
                                                    <label for="usuario_asignado" class="col-md-3 control-label">Usuario Asignado: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="usuario_asignado" id="usuario_asignado" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="grupo_asignado" class="col-md-3 control-label">Grupo Asignado: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="grupo_asignado" id="grupo_asignado" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="ingeniero_provisioning" class="col-md-3 control-label">Ingeniero Provisioning: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="ingeniero_provisioning" id="ingeniero_provisioning" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <div class="widget bg_white m-t-25 display-block">
                                            <fieldset class="col-md-6 control-label">
                                                <div class="form-group">
                                                    <label for="cargo_arriendo" class="col-md-3 control-label">Cargo Arriendo: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="cargo_arriendo" id="cargo_arriendo" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="cargo_mensual" class="col-md-3 control-label">Cargo Mensual: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="cargo_mensual" id="cargo_mensual" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="monto_moneda_local_arriendo" class="col-md-3 control-label">Monto Moneda Local Arriendo: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="monto_moneda_local_arriendo" id="monto_moneda_local_arriendo" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <!--  fin seccion izquierda form---->

                                            <!--  inicio seccion derecha form---->
                                            <fieldset>
                                                <div class="form-group">
                                                    <label for="monto_moneda_local_cargo_mensual" class="col-md-3 control-label">Monto Moneda Local Cargo Mensual: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="monto_moneda_local_cargo_mensual" id="monto_moneda_local_cargo_mensual" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="cargo_obra_civil" class="col-md-3 control-label">Cargo Obra Civil: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="cargo_obra_civil" id="cargo_obra_civil" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="descripcion" class="col-md-3 control-label">Descripcion: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="descripcion" id="descripcion" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <div class="widget bg_white m-t-25 display-block">
                                            <fieldset class="col-md-6 control-label">
                                                <div class="form-group">
                                                    <label for="direccion_origen" class="col-md-3 control-label">Dirección Origen: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="direccion_origen" id="direccion_origen" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="ciudad_incidente" class="col-md-3 control-label">ciudad Incidente: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="ciudad_incidente" id="ciudad_incidente" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="direccion_destino" class="col-md-3 control-label">Dirección Destino: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="direccion_destino" id="direccion_destino" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <!--  fin seccion izquierda form---->

                                            <!--  inicio seccion derecha form---->
                                            <fieldset>
                                                <div class="form-group">
                                                    <label for="ciudad_incidente3" class="col-md-3 control-label">Ciudad Incidente 3: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="ciudad_incidente3" id="ciudad_incidente3" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="fecha_compromiso" class="col-md-3 control-label">Fecha Compromiso: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="fecha_compromiso" id="fecha_compromiso" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="fecha_programacion" class="col-md-3 control-label">Fecha Programación: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="fecha_programacion" id="fecha_programacion" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <div class="widget bg_white m-t-25 display-block">
                                            <fieldset class="col-md-6 control-label">
                                                <div class="form-group">
                                                    <label for="fecha_realizacion" class="col-md-3 control-label">Fecha Realización: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="fecha_realizacion" id="fecha_realizacion" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="resolucion_1" class="col-md-3 control-label">Resolución 1: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="resolucion_1" id="resolucion_1" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="resolucion_2" class="col-md-3 control-label">Resolución 2: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="resolucion_2" id="resolucion_2" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <!--  fin seccion izquierda form---->

                                            <!--  inicio seccion derecha form---->
                                            <fieldset>
                                                <div class="form-group">
                                                    <label for="resolucion_3" class="col-md-3 control-label">Resolución 3: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="resolucion_3" id="resolucion_3" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="resolucion_4" class="col-md-3 control-label">Resolución 4: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="resolucion_4" id="resolucion_4" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="fecha_creacion_ot_hija" class="col-md-3 control-label">Fecha Creación Ot Hija: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="fecha_creacion_ot_hija" id="fecha_creacion_ot_hija" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <div class="widget bg_white m-t-25 display-block">
                                            <fieldset class="col-md-6 control-label">
                                                <div class="form-group">
                                                    <label for="proveedor_ultima_milla" class="col-md-3 control-label">Proveedor Ultima Milla: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="proveedor_ultima_milla" id="proveedor_ultima_milla" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="usuario_asignado4" class="col-md-3 control-label">Usuario Asignado 4: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="usuario_asignado4" id="usuario_asignado4" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="resolucion_15" class="col-md-3 control-label">Resolución 15: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="resolucion_15" id="resolucion_15" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <!--  fin seccion izquierda form---->

                                            <!--  inicio seccion derecha form---->
                                            <fieldset>
                                                <div class="form-group">
                                                    <label for="resolucion_26" class="col-md-3 control-label">Resolución 26: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="resolucion_26" id="resolucion_26" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="resolucion_37" class="col-md-3 control-label">Resolución 37: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="resolucion_37" id="resolucion_37" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="resolucion_48" class="col-md-3 control-label">Resolución 48: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="resolucion_48" id="resolucion_48" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="fec_actualizacion_onyx_hija" class="col-md-3 control-label">Fecha Actualizacion Onyx Hija: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="fec_actualizacion_onyx_hija" id="fec_actualizacion_onyx_hija" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <div class="widget bg_white m-t-25 display-block">
                                            <fieldset class="col-md-6 control-label">
                                                <div class="form-group">
                                                    <label for="ot_hija" class="col-md-3 control-label">Ot Hija: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="ot_hija" id="ot_hija" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <!--  fin seccion izquierda form---->

                                            <!--  inicio seccion derecha form---->
                                            <fieldset>
                                                <div class="form-group">
                                                    <label for="k_id_estado_ot" class="col-md-3 control-label">Estado Orden Trabajo Hija: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <select name="k_id_estado_ot" id="k_id_estado_ot" class="form-control">                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <div class="widget bg_white m-t-25 display-block">
                                            <fieldset class="col-md-12 control-label">
                                                <div class="form-group">
                                                    <label for="observaciones" class="col-md-3 control-label">Observaciones: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <textarea name="observaciones" id="observaciones" class="form-control" rows="4" cols="100"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="form-group m-t-40 p-b-40"></div>
                                            </fieldset>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" id="mbtnCerrarModal" data-dismiss="modal"><i class='glyphicon glyphicon-remove'></i>&nbsp;Cancelar</button>
                            <button type="button" class="btn btn-info" id="btnUpdOt"><i class='glyphicon glyphicon-save'></i>&nbsp;Actualizar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal lista OTs 15 dias -->
            <div id="modalListOtsfiteenDays" class="modal fade" role="dialog" >
                <div class="modal-dialog modal-lg2" style="width: 1000px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                            <h3 class="modal-title" id="myModalLabel"></h3>
                        </div>
                        <div class="modal-body">
                            <div>
                                <form class='well form-horizontal' enctype= 'multipart/form-data'>
                                    <fieldset>
                                        <div class="row">
                                            <div class="col col-md-12 p-t-40">
                                                <table id="tablaOtsfiteenDays" class="table table-hover table-striped" width="100%"></table>
                                                <br/>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" id="mbtnCerrarModal" data-dismiss="modal"><i class='glyphicon glyphicon-remove'></i>&nbsp;Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--footer Section -->
        <div class="for-full-back" id="footer">
            Zolid By ZTE Colombia | All Right Reserved
        </div>     
        <?php $this->load->view('parts/generic/scripts'); ?>
        <!-- CUSTOM SCRIPT   -->
        <script type="text/javascript">
            var estadosOts = <?= $estadosOts ?>;
        </script>
        <script scr="<?= URL::to("assets/plugins/sweetalert-master/dist/sweetalert.min.js") ?>" ></script>
        <script type="text/javascript" src="<?= URL::to("assets/js/modules/editOts.js?v=". time()) ?>"></script>
    </body>
</html>
