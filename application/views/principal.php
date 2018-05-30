<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <body data-base="<?= URL::base() ?>">
        <?php $this->load->view('parts/generic/header'); ?>
        <!--        <div class="container autoheight p-t-20 m-t-20">
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
                </div>-->
        <!--Header section  -->
        <div id="home">
            <div class="container" >
                <div class="row ">
                    <div class="col-md-9 col-sm-9">
                        <div style="height: 400px;">
<!--                            <a><br>
                                <img class="logoz" id="logoz" src="<?php //URL::to('assets/img/logoz.png'); ?>" />
                            </a>-->
                        </div>
                        <h1 class="head-main">&nbsp;ZTE</h1>
                        <span class="head-sub-main">Proyecto Telmex VIP - Claro</span>
                        <div class="head-last"><!--texto aca--> </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Header section  -->
        <!--Services Section-->
        <section  id="services">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-8 col-md-offset-2">
                        <h2>Proyecto Telmex VIP - Claro</h2>
                    </div>
                </div>
                <div class="row text-center space-pad">
                    <div class="col-md-3 col-sm-3">
                        <div >
                            <i class="fa fa-camera fa-4x main-color"></i>
                            <h3>Ver Actividades</h3>
                            <p>Aquí se puede observar una lista de todas las actividades creadas.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div >
                            <i class="fa fa-briefcase fa-4x main-color"></i>
                            <h3>Asignar actvidades</h3>
                            <p>Herramienta para agendar y asignar actividades a los diferentes
                                ingenieros que hacen parte del proyecto.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div >
                            <i class="fa fa-desktop fa-4x main-color"></i>
                            <h3>Reportes</h3>
                            <p>Reportes y resúmenes gráficos para analizar información
                                relevante sobre el proyecto.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div>
                            <i class="fa fa-folder fa-4x main-color"></i>
                            <h3>Indicadores</h3>
                            <p>Indicadores de rendimiento de los miembros del equipo y del proyecto.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End Services Section-->
        <!--parallax one-->
        <section  id="Parallax-one">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-8 col-md-offset-2 ">
                        <h2><i class="fa fa-desktop fa-3x"></i>&nbsp;Just Space </h2>
                        <h4><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Curabitur nec nisl odio. Mauris vehicula at nunc id posuere.
                            </strong>
                        </h4>
                    </div>
                </div>
            </div>
        </section>
        <section  id="contact-sec">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div id="social-icon">
                            <strong> Visita:</strong> ztemobilecolombia.com
                            <a href="#"><i class="fa fa-facebook fa-2x"></i></a>
                            <a href="#"><i class="fa fa-twitter fa-2x"></i></a>
                            <a href="#"><i class="fa fa-linkedin fa-2x"></i></a>
                            <a href="#"><i class="fa fa-google-plus fa-2x"></i></a>
                            <a href="#"><i class="fa fa-pinterest fa-2x"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End Contact Section -->
        <!--footer Section -->
        <div class="for-full-back" id="footer">
            Zolid By ZTE Colombia | All Right Reserved
        </div>        
        <!-- CUSTOM SCRIPT   -->
        <script scr="<?= URL::to("assets/plugins/sweetalert-master/dist/sweetalert.min.js") ?>" ></script>
    </body>
</html>
