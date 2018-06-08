<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <body data-base="<?= URL::base() ?>">
        <?php $this->load->view('parts/generic/header'); ?>
        <?php if (Auth::user()->n_project == 'Gestion') { ?>
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
                <div>
                    <script type='text/javascript' src='http://181.49.46.6/javascripts/api/viz_v1.js'></script><div class='tableauPlaceholder' style='width: 100%; height: 619px;'><object class='tableauViz' width='100%' height='619' style='display:none;'><param name='host_url' value='http%3A%2F%2F181.49.46.6%2F' /> <param name='embed_code_version' value='3' /> <param name='site_root' value='' /><param name='name' value='TVIPInstalaciones&#47;EstadodeOTs' /><param name='tabs' value='no' /><param name='toolbar' value='yes' /><param name='showAppBanner' value='false' /><param name='filter' value='iframeSizedToWindow=true' /></object></div>
                </div>
            </div>
            <?php
        }
        if (Auth::user()->n_project == 'Implementacion') {
            ?>
            <!--Header section  -->
            <div id="home">
                <div class="container" >
                    <div class="row ">
                        <div class="col-md-9 col-sm-9">
                            <div style="height: 400px;"></div>
                            <h1 class="head-main">&nbsp;ZTE</h1>
                            <span class="head-sub-main">Implementación de servicios - </span><img src="<?= URL::to('assets/img/logoClaro.png') ?>" width="100"/>
                            <div class="head-last"><!--texto aca--> </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <!--footer Section -->
        <div class="for-full-back" id="footer">
            Zolid By ZTE Colombia | All Right Reserved
        </div>        
        <!-- CUSTOM SCRIPT   -->
        <script scr="<?= URL::to("assets/plugins/sweetalert-master/dist/sweetalert.min.js") ?>" ></script>
    </body>
</html>
