<!DOCTYPE html>
<html>
<head lang="fr">
    <meta charset="utf-8">
    <meta content="origin-when-cross-origin" name="referrer">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="title" content="BIT - Best Innovation of Technology">
    <meta name="description" content="BIT est une entreprise qui met &agrave; votre port&eacute;e de meilleures prestations de service satisfaisantes et des solutions ad&eacute;quates pour vous assister dans le d&eacute;veloppement de vos projets" />
    <meta name="keywords" content="technology,digital,marketing,infographie,t&eacute;l&eacute;communication,r&eacute;seau,informatique,prestation,service,&eacute;lectricit&eacute;,maintenance" />
    <meta name="robots" content="index,follow" />
    <meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width">
    <meta name="apple-mobile-web-app-capable" content="yes" /> 
    <meta name="author" content="BIT">
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="BIT">
    <meta property="og:image" content="./assets/images/logo-bit.png">
    <meta property="og:description" content="BIT est une entreprise qui met &agrave; votre port&eacute;e de meilleures prestations de service satisfaisantes et des solutions ad&eacute;quates pour vous assister dans le d&eacute;veloppement de vos projets">
    <meta property="og:title" content="BIT - Best Innovation of Technology">
    <meta property="og:url" content="https://www.bit3ch.com">
    <link rel="canonical" href="https://www.bit3ch.com">
    <link rel="shortcut icon" type="image/x-icon" href="./assets/images/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link type="text/css" rel="stylesheet" href="./assets/css/bit.css">
	<title>BIT - we make life better</title>
    <style type="text/css">
        .our-advantage .card-body .card{
            position: relative;
            box-shadow: 0 0 1rem rgb(33, 37, 41);
            z-index: 1;
        }

        .custom-shape-divider-bottom-1658149813 {
          bottom: 0px;
        }

        #ep-tab[role="tab"]:disabled{
          cursor: not-allowed;
          pointer-events: all;
        }

        .section-devis .toast-feedback{
            display: flex;
            position: fixed;
            left: 4px;
            bottom: 4px;
            z-index: 9999;
            align-items: center;
            padding: 0.5rem;
        }

        .section-devis .toast-feedback>div{
            display: flex;
            align-items: center;
            color: #fff;
        }
    </style>
</head>
<body class="container-fluid p-0">
    <!-- Preloader -->
    <?php require_once('assets/inc/preloader.php'); ?>

    <!-- Include header -->
    <?php require_once('assets/inc/header.php'); ?>

    <section class="body-content row mx-0">
        <section class="banner overflow-hidden position-relative px-0" role="banner">
            <div class="card border-0 rounded-0">
                <img class="card-img rounded-0" src="assets/images/pexels-rfstudio-3811082.jpg">
                <div class="card-img-overlay d-flex align-items-end">
                    <div class="card-text text-white">
                        <h1 class="card-title fw-semibold">DEVIS</h1>                            
                        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;); color: #ffffff;" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="./">ACCUEIL</a></li>
                                <li class="breadcrumb-item active  text-white" aria-current="page">DEVIS GRATUIT</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="custom-shape-divider-bottom-1658150098">
                <div class="custom-shape-divider-bottom-1658150298">
                    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                        <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="shape-fill"></path>
                    </svg>
                </div>
            </div>
        </section>

        <div class="section-devis my-5">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs" role="tablist">
                                    <li class="nav-item"><button type="button" id="ip-tab" class="nav-link" data-bs-toggle="tab" data-bs-target="#info-perso" aria-controls="info-perso" aria-selected="true" role="tab">Informations personnelles</button></li>
                                    <li class="nav-item"><button type="button" id="ep-tab" class="nav-link" data-bs-toggle="tab" data-bs-target="#eval-proj" aria-controls="eval-proj" aria-selected="false" role="tab">Evaluation de votre projet</button></li>
                                </ul>
                            </div>
                            <div class="card-body tab-content p-4">
                                <div id="info-perso" class="tab-pane fade" role="tabpanel" arial-labelledby="ip-tab">
                                    <form class="form p-2">
                                        <div class="mb-3 row">
                                            <div class="col-sm-12 col-md-6">
                                                <label class="form-label">Nom</label>
                                                <input class="form-control" type="text" name="nom" placeholder="Votre nom" required>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <label class="form-label">Prénom</label>
                                                <input class="form-control" type="text" name="prenom" placeholder="Votre prénom" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-sm-12 col-md-6">
                                                <label class="form-label">Adresse e-mail</label>
                                                <input class="form-control" type="email" name="email" placeholder="xyz@example.com" required>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <label class="form-label">Numéro de téléphone</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">+237</span>
                                                    <input class="form-control" type="tel" name="tel" placeholder="XXXXXXXXX" maxlength="9">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-12">
                                                <label class="form-label">Ville</label><br>
                                                <input class="form-control" type="text" name="ville" placeholder="Votre ville" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-sm-12 col-md-6">
                                                <label class="form-label">Site web</label>
                                                <input class="form-control" type="url" name="url" placeholder="https://www.example.com">
                                            </div> 
                                            <div class="col-sm-12 col-md-6">
                                                <label class="form-label">Secteur d'activité</label>                                   
                                                <select class="form-select" name="activity">
                                                    <option>Salarié</option>
                                                    <option>Homme d'affaires</option>
                                                    <option>Société</option>
                                                    <option>ONG / Association</option>
                                                    <option>Etat / Gouvernement</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="btn-group">
                                            <button class="btn btn-primary" type="button" role="button">Suivant <span class="bi-arrow-right"></span></button>
                                        </div>
                                    </form>
                                </div>
                                <div id="eval-proj" class="tab-pane fade" role="tabpanel" arial-labelledby="ep-tab">
                                    <form class="form p-2">
                                        <div class="mb-3"> 
                                            <label class="form-label">S&eacute;lectionner domaine</label>                                   
                                            <select class="form-select" name="domain">
                                                <option value="Digital marketing" aria-selected="true" selected>Digital marketing</option>
                                                <option value="Réseau et télécommunication">Réseau et télécommunication</option>
                                                <option value="Electricité">Electricité</option>
                                                <option value="Maintenance informatique">Maintenance informatique</option>
                                            </select>
                                        </div>
                                        <fieldset class="mb-3">
                                            <legend>digital marketing</legend>
                                            <p class="form-text">Quel service ?</p>
                                            <div class="row">
                                                <div class="form-check col-12 col-md-6">
                                                    <input class="form-check-input" type="radio" name="domain" aria-checked="true" checked>
                                                    <label class="form-label">D&eacute;veloppement Web</label>
                                                </div>
                                                <div class="form-check col-12 col-md-6">
                                                    <input class="form-check-input" type="radio" name="domain">
                                                    <label class="form-label">SEO</label>
                                                </div>
                                                <div class="form-check col-12 col-md-6">
                                                    <input class="form-check-input" type="radio" name="domain">
                                                    <label class="form-label">Community manager</label>
                                                </div>
                                                <div class="form-check col-12 col-md-6">
                                                    <input class="form-check-input" type="radio" name="domain">
                                                    <label class="form-label">Infographie</label>
                                                </div>
                                            </div>
                                        </fieldset>

                                        <div class="input-group row row-cols-xs-1 row-cols-sm-1 row-cols-md-2 mb-3">
                                            <div class="col">
                                                <label class="form-label">Date d&eacute;but</label><br>
                                                <input class="form-control" type="date" name="date_debut" required>
                                            </div>
                                            <div class="col">
                                                <label class="form-label">Date fin</label><br>
                                                <input class="form-control" type="date" name="date_fin" required>
                                            </div>
                                        </div>

                                        <div class="row row-cols-xs-1 row-cols-sm-1 row-cols-md-2 mb-3">
                                            <div class="col">
                                                <label class="form-label">Budget approximatif</label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="devise">FCFA</span>
                                                    <input class="form-control" type="text" name="budget" aria-describedby="devise" required>
                                                </div>
                                            </div> 
                                            <div class="col">
                                                <label class="form-label">Ajouter votre plan</label>        
                                                <input id="plan" class="form-control mb-1" type="file" name="file">
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 0;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" name="details" style="height: 130px;" placeholder="Votre suggestion" id="tagTextarea" required aria-required="true"></textarea>
                                            <label for="tagTextarea">Une brève description de votre projet</label>
                                        </div>
                                        
                                        <div class="btn-group">
                                            <button class="btn btn-primary" type="button" role="button">Envoyer <span class="bi-send"></span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-xs-none d-sm-none d-md-block col-md-4 summary">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="modal-title h3">Récapitulatif</h3>
                            </div>
                            <div class="card-body">
    							<p class="card-text text-info text-center">Les informations que vous avez renseignées s'afficheront ici</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- feedback form receive -->
        <div class="toast toast-feedback bg-secondary" role="status" aria-live="polite" aria-atomic="true">
            <div class="d-flex">
                <span class="bi-info-circle-fill fs-2 text-primary"></span>
                <p class="text-white">Nous vous ferons parvenir votre devis dès son élaboration. Merci pour votre confiance</p>
            </div>
        </div>

        <div class="section-about-us our-advantage col-12 bg-dark py-2">
            <div class="container">
                <div class="card bg-transparent border-0">
                    <div class="card-header border-0">
                        <h1 class="card-title text-white fw-bold"><span class="bi-slack fs-4"></span> NOS VALEURS</h1>
                    </div>
                    <div class="card-body mt-4">
                        <div class="row row-cols-xs-1 row-cols-sm-1 row-cols-md-3 g-4">
                            <div class="col">
                                    <div class="card border-0 text-center">
                                        <figure class="figure m-3"><img class="figure-img card-img-top img-fluid" src="./assets/images/undraw_Time_management_re_tk5w.png" alt="#"></figure>
                                        <div class="card-body">
                                            <h3 class="card-subtitle fw-lighter lh-base">Exactitude</h3>
                                            <p class="card-text text-muted">
                                                Nous nous attelons à respecter minitieusement nos engagements contractuels dans les délais accordés
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card text-center border-0">
                                        <figure class="figure"><img class="figure-img card-img-top img-fluid" src="./assets/images/undraw_Data_report_re_p4so.png" alt="#"></figure>
                                        <div class="card-body">
                                            <h3 class="card-subtitle fw-lighter lh-base">Excellence</h3>
                                            <p class="card-text text-muted">
                                                Nous nous impliquons dans la proposition de service concurrentielle bien au-del&agrave; de vos attentes
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card text-center border-0">
                                        <figure class="figure m-3"><img class="figure-img card-img-top img-fluid" src="./assets/images/undraw_Done_re_oak4.png" alt="#"></figure>
                                        <div class="card-body">
                                            <h3 class="card-subtitle fw-lighter lh-base">Efficacit&eacute;</h3>
                                            <p class="card-text text-muted">
                                                Notre impératif est de fournir une solution optimale et adéquate à la problématique posée 
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-shape-divider-bottom-1658149813">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M598.97 114.72L0 0 0 120 1200 120 1200 0 598.97 114.72z" class="shape-fill"></path>
                </svg>
            </div>
        </div>

        
        <!-- include modal -->
        <?php require_once('assets/inc/modal.php'); ?>
    </section>
    <!-- include footer -->
    <?php require_once('assets/inc/footer.php'); ?>
    
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script type="text/javascript" src="assets/js/plugins.js"></script> 
    <script type="text/javascript" src="assets/js/bit.js"></script> 
    <script type="text/javascript" src="assets/js/devis.js"></script>
    <script type="text/javascript">
        $(function(){

            $(window).load(function(){
                $('#eval-proj .form-select').trigger('change');
            });

            $('#eval-proj .form-select').change(function(){
                var xhr = new XMLHttpRequest,
                    data = this.options[this.selectedIndex].value,
                    fieldset = $(this).parent().next('fieldset').get(0);
                xhr.open('GET', 'server/server.php?do=get-service&domain=' + encodeURIComponent(data));
                xhr.onreadystatechange = function(){
                    var resp = null;
                    if(xhr.readyState == xhr.DONE && xhr.status == 200){
                        resp = JSON.parse(xhr.responseText);
                        if(resp.status){
                            var tab = $.map(resp.return, function(elt, ind){
                                return `<div class="form-check col-12 col-md-6">
                                            <input class="form-check-input" type="radio" name="service" id="${elt.tag}" value="${elt.designation}">
                                            <label for="${elt.tag}" class="form-label">${elt.designation}</label>
                                        </div>`;
                            });

                            $(fieldset).find('legend').text(data);
                            $(fieldset.lastElementChild).fadeOut(300, function(){
                                $(this).html(tab.join('')).fadeIn(300, function(){
                                    $(this).find(':radio:first').prop('checked', true);
                                });
                            });
                        }
                    }else if(xhr.readyState == xhr.DONE && xhr.status != 200){
                        xhr.abort();
                    }
                };
                xhr.send(null);
            });
            
        });
    </script>
</body>
</html>