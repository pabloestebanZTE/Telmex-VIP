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
                                        <input type="text" class="form-control" name="PrincipalCode[]" placeholder="Principal" maxlength="7">
                                    </div>
                                    <div class="col-sm-2 seccionPrincipal" style="display: none;">
                                        <button type="button" class="btn btn-success addPrincipalCode">+</button>
                                        <!--<button type="button" class="btn btn-danger" id="removePrincipalCode">-</button>-->
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="button" id="btnBackup" class="btn btn-primary col-sm-2 btnMarcaciones">Backup</button>
                                <div id="groupBackup">
                                    <div class="col-sm-8 seccionBackup" style="display: none;">
                                        <input type="text" class="form-control" name="BackupCode[]" placeholder="Backup" maxlength="7">
                                    </div>
                                    <div class="col-sm-2 seccionBackup" style="display: none;">
                                        <button type="button" class="btn btn-success addBackupCode">+</button>
                                        <!--<button type="button" class="btn btn-danger">-</button>-->
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="button" id="btnPuntoCentral" class="btn btn-primary col-sm-2 btnMarcaciones">Punto Central</button>
                                <div id="groupPuntoCentral">
                                    <div class="col-sm-8 seccionPuntoCentral" style="display: none;">
                                        <input type="text" class="form-control" name="PuntoCentralCode[]" placeholder="Punto Central" maxlength="7">
                                    </div>
                                    <div class="col-sm-2 seccionPuntoCentral" style="display: none;">
                                        <button type="button" class="btn btn-success addPuntoCentralCode">+</button>
                                        <!--<button type="button" class="btn btn-danger">-</button>-->
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="button" id="btnOtp" class="btn btn-primary col-sm-2 btnMarcaciones">OTP</button>
                                <div id="groupOtp">
                                    <div class="col-sm-8 seccionOtp" style="display: none;">
                                        <input type="text" class="form-control" name="otpCode[]" placeholder="OTP" maxlength="7">
                                    </div>
                                    <div class="col-sm-2 seccionOtp" style="display: none;">
                                        <button type="button" class="btn btn-success addOtpCode">+</button>
                                        <!--<button type="button" class="btn btn-danger">-</button>-->
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-10 col-sm-10">
                                    <button type="button" class="btn btn-success" id="btnGenerateMarkings">Generar Marcaciones</button>
                                </div>
                            </div>
                            <br/>
                        </div>
                        
                        <table class="table table-hover table-striped" style="display: none;" id="tablaMarcaciones">
                            <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Capa 2 HUAWEI ZTE</th>
                                    <th>Capa 2 ALCATEL</th>
                                    <th>Capa 3 INTERFAZ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="tdMarcaciones">NORMAL</td>
                                    <td><input type="text" class="form-control" id="huawei_normal"></td>
                                    <td><input type="text" class="form-control" id="alcatel_normal"></td>
                                    <td><input type="text" class="form-control" id="interfaz_normal"></td>
                                </tr>
                                <tr>
                                    <td>PPAL CON BACKUP</td>
                                    <td><input type="text" class="form-control" id="huawei_ppal"></td>
                                    <td><input type="text" class="form-control" id="alcatel_ppal"></td>
                                    <td><input type="text" class="form-control" id="interfaz_ppal"></td>
                                </tr>
                                <tr>
                                    <td>BACKUP</td>
                                    <td><input type="text" class="form-control" id="huawei_backup"></td>
                                    <td><input type="text" class="form-control" id="alcatel_backup"></td>
                                    <td><input type="text" class="form-control" id="interfaz_backup"></td>
                                </tr>
                                <tr>
                                    <td>TRASLADO EXTERNO</td>
                                    <td><input type="text" class="form-control" id="huawei_externo"></td>
                                    <td><input type="text" class="form-control" id="alcatel_externo"></td>
                                    <td><input type="text" class="form-control" id="interfaz_externo"></td>
                                </tr>
                                <tr>
                                    <td>TRASLADO EXTERNO BACKUP</td>
                                    <td><input type="text" class="form-control" id="huawei_externoBackup"></td>
                                    <td><input type="text" class="form-control" id="alcatel_externoBackup"></td>
                                    <td><input type="text" class="form-control" id="interfaz_externoBackup"></td>
                                </tr>
<!--                                <tr>
                                    <td>DESCONEXION TEMPORAL</td>
                                    <td><input type="text" class="form-control" id="huawei_desconexion"></td>
                                    <td><input type="text" class="form-control" id="alcatel_desconexion"></td>
                                    <td><input type="text" class="form-control" id="interfaz_desconexion"></td>
                                </tr>-->
                                <tr>
                                    <td>PUNTO CENTRAL</td>
                                    <td><input type="text" class="form-control" id="huawei_puntoCentral"></td>
                                    <td><input type="text" class="form-control" id="alcatel_puntoCentral"></td>
                                    <td><input type="text" class="form-control" id="interfaz_puntoCentral"></td>
                                </tr>
                                <tr>
                                    <td>DOS O MAS SERV DIF PREFIJO</td>
                                    <td><input type="text" class="form-control" id="huawei_difPrefijo"></td>
                                    <td><input type="text" class="form-control" id="alcatel_difPrefijo"></td>
                                    <td><input type="text" class="form-control" id="interfaz_difPrefijo"></td>
                                </tr>
                            </tbody>
                        </table>
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
        <script type="text/javascript"> var baseurl = "<?= URL::base() ?>";</script>
        <script scr="<?= URL::to("assets/plugins/sweetalert-master/dist/sweetalert.min.js") ?>" ></script>
        <script type="text/javascript" src="<?= URL::to("assets/js/modules/markings.js?v=". time()) ?>"></script>
    </body>
</html>
