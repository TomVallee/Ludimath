<?php require_once "includes/functions.php"; ?>

    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="/ludimath/index.php">
                    <img alt="logo" class="img-responsive" src="/Ludimath/images/logo.png">
                </a>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-target">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php if (isUserConnected()) { ?>
                    <a class="navbar-brand" href="equipe.php"><span class="glyphicon glyphicon-flag"></span> Equipe</a>
                    <a class="navbar-brand" href="cours.php"><span class="glyphicon glyphicon-book"></span> Cours</a>
                    <a class="navbar-brand" href="tops.php"><span class="glyphicon glyphicon-book"></span> Tops</a>
                    <a class="navbar-brand" href="succes.php"><span class="glyphicon glyphicon-lock"></span> Succes </a>
                    <a class="navbar-brand" href="mathematiciens.php"><span class="glyphicon glyphicon-lock"></span> Mathématiciens </a>

                    <?php if(isUserAdmin($_SESSION["id"])){ ?>
                        <a class="navbar-brand" href="admin.php"><span class="glyphicon glyphicon-pencil"></span>Administration</a>
                        <?php } } ?>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse-target">

                <ul class="nav navbar-nav navbar-right">
                    <?php if (isUserConnected()) { ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?php AfficherBadge($_SESSION['id'], 25) ?> Bienvenue,
                                    <?= $_SESSION['login'] ;?> <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="profil.php">Mon profil</a></li>
                                <li><a href="logout.php">Se déconnecter</a></li>
                            </ul>
                        </li>
                        <?php } else { ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="glyphicon glyphicon-user"></span> Non connecté <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="login.php">Se connecter</a></li>
                                    <li><a href="creation_compte.php">Créer un compte</a></li>
                                </ul>
                            </li>
                            <?php } ?>
                </ul>
            </div>
        </div>
        <!-- /.container -->
    </nav>