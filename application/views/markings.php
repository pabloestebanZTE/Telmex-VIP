<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <body data-base="<?= URL::base() ?>">
        <?php $this->load->view('parts/generic/header'); ?>
        <div class="container autoheight p-t-20 m-t-20">
            <div class="alert alert-success alert-dismissable hidden" id="principalAlert">
                <a href="#" class="close">&times;</a>
                <p id="text" class="m-b-0 p-b-0"></p>
            </div>
            <form class= 'well form-horizontal' action='' method='post'  id='markings' name='markings' enctype= 'multipart/form-data'>
                <fieldset>
                    <div class="row">
                        <div class="col col-md-12 p-t-40">
                            <input type="hidden" value="<?= Auth::getRole() ?>" id="rol">
                            <div class="form-group">
                                <label for="nombre_empresa" class="col-sm-2 control-label">NOMBRE EMPRESA</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" placeholder="Nombre Empresa">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">CODIGOS DE SERVICIO</label>
                            </div>
                            <div class="form-group">
                                <button type="button" id="btnPrincipal" class="btn btn-primary col-sm-2 btnMarcaciones">Principal</button>
                                <div id="groupPrincipal">
                                    <div class="col-sm-8 seccionPrincipal" style="display: none;">
                                        <input type="text" class="form-control" id="nombre_empresa" placeholder="Principal">
                                    </div>
                                    <div class="col-sm-2 seccionPrincipal" style="display: none;">
                                        <button type="button" class="btn btn-success addPrincipalCode" id="addPrincipalCode">+</button>
                                        <button type="button" class="btn btn-danger" id="removePrincipalCode">-</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="button" id="btnBackup" class="btn btn-primary col-sm-2 btnMarcaciones">Backup</button>
                                <div class="col-sm-8 seccionBackup" style="display: none;">
                                    <input type="text" class="form-control" id="nombre_empresa" placeholder="Backup">
                                </div>
                                <div class="col-sm-2 seccionBackup" style="display: none;">
                                    <button type="button" class="btn btn-success">+</button>
                                    <button type="button" class="btn btn-danger">-</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="button" id="btnPuntoCentral" class="btn btn-primary col-sm-2 btnMarcaciones">Punto Central</button>
                                <div class="col-sm-8 seccionPuntoCentral" style="display: none;">
                                    <input type="text" class="form-control" id="nombre_empresa" placeholder="Punto Central">
                                </div>
                                <div class="col-sm-2 seccionPuntoCentral" style="display: none;">
                                    <button type="button" class="btn btn-success">+</button>
                                    <button type="button" class="btn btn-danger">-</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="button" class="btn btn-success">Generar Marcaciones</button>
                                </div>
                            </div>
                            <br/>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <!--footer Section -->
        <div class="for-full-back" id="footer">
            Zolid By ZTE Colombia | All Right Reserved
        </div>     
        <?php $this->load->view('parts/generic/scripts'); ?>
        <!-- CUSTOM SCRIPT   -->
        <script scr="<?= URL::to("assets/plugins/sweetalert-master/dist/sweetalert.min.js") ?>" ></script>
        <script type="text/javascript" src="<?= URL::to("assets/js/modules/markings.js") ?>"></script>
    </body>
</html>
