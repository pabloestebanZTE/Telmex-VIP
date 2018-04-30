<!-- Navigation -->
<header>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="logo" href="<?= URL::to('index.php/User/principalView') ?>"><img id="logo" src="<?= URL::to('assets/img/logo2.png'); ?>" /></a>
            </div>
            <!-- Collect the nav links for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="cam">
                        <!--<a >Bienvenid@ <?php echo Auth::user()->n_name_user . ' ' . Auth::user()->n_last_name_user; ?></a>-->
                        <div>
                            <div id="divImg"><img id="imgRol" src="<?= URL::to('assets/img/' . Auth::user()->k_id_user . '.png') ?>"/></div>
                            <div id="infoUsu">
                                <span>
                                    Bienvenid@ <?php echo Auth::user()->n_name_user . ' ' . Auth::user()->n_last_name_user; ?><br>
                                    <?php echo Auth::getRole(); ?>
                                </span>
                            </div>
                        </div>
                    </li>
                    <li class="cam"><a href="#services" style="height: 85px;">Informes</a>
                        <ul>
                            <li><a href="<?= URL::to('Service/assignService'); ?>">Agendar Actividad</a></li>
                            <li><a href="<?= URL::to('Service/listServices'); ?>">Ver Actividades</a></li>
                            <li><a href="https://accounts.google.com/ServiceLogin/signinchooser?passive=1209600&continue=https%3A%2F%2Faccounts.google.com%2FManageAccount&followup=https%3A%2F%2Faccounts.google.com%2FManageAccount&flowName=GlifWebSignIn&flowEntry=ServiceLogin" title="drive" target='_blank'>Drive</a></li>
                        </ul>
                    </li>
                    <li class="cam"><a href="<?= URL::to('User/loadInformation') ?>" style="height: 85px;">Cargar Información</a>
                    </li>
                    <li class="cam"><a href="<?= URL::to('User/markings') ?>" style="height: 85px;">Marcaciones</a>
                    </li>
                    <li class="cam"><a href="<?= URL::to('User/editOts') ?>" style="height: 85px;">Editar Ots</a>
                    </li>
                    </li>
                    <li class="cam"><a href="<?= URL::to('User/logout') ?>" style="height: 85px;">Salir</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header><br><br><br><br>
<br>
<!--End Navigation -->
