<!DOCTYPE html>
<html lang="en">
   
<!-- Mirrored from themewagon.github.io/pluto/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 27 Mar 2025 14:38:17 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
         @php
           use Illuminate\Support\Facades\Auth;
          @endphp


      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title> Plateforme de gestion financière et budgétaire d'entreprise</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- site icon -->
      <link rel="icon" href="{{asset('images/fevicon.html')}}" type="image/png" />
      <!-- bootstrap css -->
      <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
      <!-- site css -->
      <link rel="stylesheet" href="{{asset('style.css')}}" />
      <!-- responsive css -->
      <link rel="stylesheet" href="{{asset('css/responsive.css')}}" />
      <!-- color css -->
      <link rel="stylesheet" href="{{asset('css/colors.html')}}" />
      <!-- select bootstrap -->
      <link rel="stylesheet" href="{{asset('css/bootstrap-select.css')}}" />
      <!-- scrollbar css -->
      <link rel="stylesheet" href="{{asset('css/perfect-scrollbar.css')}}" />
      <!-- custom css -->
      <link rel="stylesheet" href="{{asset('css/custom.css')}}" />
      
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      
   </head>
   <body class="dashboard dashboard_1">
      
      <div class="full_container">
         <div class="inner_container">
            <!-- Sidebar  -->
            <nav id="sidebar">
               <div class="sidebar_blog_1">
                  <div class="sidebar-header">
                     {{-- <div class="logo_section">
                        <a href="index-2.html"><img class="logo_icon img-responsive" src="images/logo/images.png" alt="#" /></a>
                     </div> --}}
                  </div>
                  <div class="sidebar_user_info">
                     <div class="icon_setting"></div>
                     <div class="user_profle_side">
                        {{-- <div class="user_img"><img class="img-responsive" src="images/layout_img/potho_d'identiée_dossou_pierre.jpg" alt="#" /></div> --}}
                        <div class="user_info">
                           <h6><span class="name_user">{{ Auth::user()->name }}</span></h6>
                           {{-- <p><span class="online_animation"></span> Online</p> --}}
                        </div>
                     </div>
                  </div>
               </div>
               <div class="sidebar_blog_2">
                  <h4>General</h4>
                  <ul class="list-unstyled components">

                     <!-- 🔷 Gestion des Dépenses -->
          <!-- 🔷 Gestion des Dépenses -->
<li>
   <a href="{{ route('listeDepense') }}">
       <i class="fa fa-wallet purple_color"></i> <span>Gestion des Dépenses</span>
   </a>
</li>
<!-- 🔷 Catégories des Dépenses -->
<li>
   <a href="{{ route('categories.index') }}">
       <i class="fa fa-tags purple_color me-2"></i> <span>Catégories de Dépenses</span>
   </a>
</li>


<!-- 🔷 Gestion des Recettes -->
<li>
   <a href="{{ route('listeRecette') }}">
       <i class="fa fa-money-bill-wave purple_color me-2"></i> <span>Gestion des Recettes</span>
   </a>
</li>
<!-- 🔷 Catégories des Dépenses -->
<li>
   <a href="{{ route('categories_recette.index') }}">
       <i class="fa fa-tags purple_color me-2"></i> <span>Catégories de Recettes</span>
   </a>
</li>

                       <!-- 🔷 Menu Rapport Financier -->
<li>
   <a href="{{ route('rapport.pdf') }}">
       <i class="fa fa-bar-chart text-success"></i> rapport.formulaire
   </a>
</li>

<!-- 🔷 Menu Rapport de Littérature -->
<li>
   <a href="{{ route('rapport.litterature.pdf') }}">
       <i class="fa fa-book text-primary"></i> Rapport de Littérature
   </a>
</li>

{{-- <!-- 📩 Menu Contact -->
<li>
   <a href="contact.html">
       <i class="fa fa-paper-plane red_color"></i> <span>Contact</span>
   </a>
</li>

<!-- 👤 Menu Profil -->
<li>
   <a href="#additional_page" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
       <i class="fa fa-user-circle yellow_color"></i> <span>Profil</span>
       <i class="fa fa-chevron-down float-right"></i>
   </a>
   <ul class="collapse list-unstyled" id="additional_page">
       <!-- autres sous-liens si nécessaire -->
   </ul>
</li> --}}

                     <li><a href="{{ route('visualisation') }}"><i class="fa fa-bar-chart-o green_color"></i> <span>visualisation </span></a></li>
                     <li>
                        @auth
                        @if(auth()->user()->type === 'admin')
                            <a href="#gestionAdmins" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <i class="fa fa-user-shield yellow_color"></i>
                                <span>Gestion des admins</span>
                            </a>
                            <ul class="collapse list-unstyled" id="gestionAdmins">
                                <li><a href="{{ route('utilisateur.create') }}"><span>Créer un compte pour admins</span></a></li>
                                <li><a href="{{ route('utilisateurs.liste') }}"><span>Liste des admins</span></a></li>
                                <li><a href="{{ route('depenses.archivees') }}"><span>Liste des archives des dépenses</span></a></li>
                                <li><a href="{{ route('recettes.archivees') }}"><span>Liste des archives des recettes</span></a></li>
                               <li> <a href="{{ route('archives.pdf') }}" >
                                 <i class="fas fa-file-pdf"></i> <span>Générer Rapport PDF</span></a></li>
                            </ul>
                        @endif
                    @endauth
                    
                    
                     </li>
                      
               </div>
            </nav>
            <!-- end sidebar -->
            <!-- right content -->
            <div id="content">
               <!-- topbar -->
               <div class="topbar">
                  <nav class="navbar navbar-expand-lg navbar-light">
                     <div class="full">
                        <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
                        <div class="logo_section">
                           {{-- <a href="index-2.html"><img class="img-responsive" src="images/logo/logos.jpg" alt="#" /></a> --}}
                        </div>
                        <div class="right_topbar">
                           <div class="icon_info">
                              {{-- <ul>
                                 <li><a href="#"><i class="fa fa-bell-o"></i><span class="badge">2</span></a></li>
                                 <li><a href="#"><i class="fa fa-question-circle"></i></a></li>
                                 <li><a href="#"><i class="fa fa-envelope-o"></i><span class="badge">3</span></a></li>
                              </ul> --}}
                              <ul class="user_profile_dd">
                                 <li>
                                    
                                     <a class="dropdown-toggle" data-toggle="dropdown">
                                         {{-- <img class="img-responsive rounded-circle" src="images/layout_img/potho_d'identiée_dossou_pierre.jpg" alt="Profile Image" /> --}}
                                         <span class="name_user">{{ Auth::user()->name }}</span>
                                     </a>
                                     <div class="dropdown-menu">
                                         <a class="dropdown-item" href="user"></a>
                                         <a class="dropdown-item" href="settings.html"></a>
                                         <a class="dropdown-item" href="help.html"></a>
                             
                                         <!-- Formulaire caché pour la déconnexion -->
                                         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                             @csrf
                                         </form>
                                         
                                         <!-- Bouton qui déclenche la soumission du formulaire -->
                                         <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                             <span>Log Out</span> <i class="fa fa-sign-out"></i>
                                         </a>
                                     </div>
                                 </li>
                             </ul>                             
                           </div>
                        </div>
                     </div>
                  </nav>
               </div>
               <!-- end topbar -->
               <!-- dashboard inner -->
               <div class="midde_cont">
                  <div class="container-fluid">
                     <div class="row column_title">
                        <div class="col-md-12">
                           <div class="page_title">
                              <h2>Plateforme de gestion financière et budgétaire d'entreprise</h2>
                           </div>
                           <style>
                              .page_title h2 {
    white-space: nowrap; /* Pour empêcher le texte de se couper sur plusieurs lignes */
    overflow: hidden;
    display: block;
    width: 100%;
    animation: defilement 10s linear infinite;
}

@keyframes defilement {
    0% {
        transform: translateX(100%); /* Début hors de l'écran à droite */
    }
    100% {
        transform: translateX(-100%); /* Fin hors de l'écran à gauche */
    }
}

                           </style>
                        </div>
                     </div>
                     <style>
                        .icon-wrapper {
                            width: 80px;
                            height: 80px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            border-radius: 50%;
                            background-color: #f8f9fa;
                            transition: transform 0.3s ease;
                            animation: fadeInUp 0.6s ease-in-out both;
                            margin: auto;
                            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
                        }
                    
                        .icon-wrapper i {
                            font-size: 38px;
                            transition: transform 0.3s ease;
                        }
                    
                        .icon-wrapper:hover i {
                            transform: rotate(15deg) scale(1.2);
                        }
                    
                        @keyframes fadeInUp {
                            from {
                                opacity: 0;
                                transform: translateY(20px);
                            }
                            to {
                                opacity: 1;
                                transform: translateY(0);
                            }
                        }
                    
                        .total_no {
                            font-size: 20px;
                            font-weight: bold;
                        }
                    
                        .head_couter {
                            font-size: 14px;
                            color: #555;
                        }
                    
                        /* Alignement horizontal des icônes */
                        .row.column1 {
                            display: flex;
                            justify-content: space-between;
                            align-items: flex-start;
                            flex-wrap: nowrap; /* Empêche le retour à la ligne */
                        }
                    
                        .col-md-6, .col-lg-3 {
                            flex: 1;
                            max-width: 18%; /* Limiter la largeur à environ 20% pour 5 éléments */
                            margin-bottom: 30px;
                        }
                    
                        .counter_section {
                            display: flex;
                            flex-direction: column;
                            justify-content: center;
                            align-items: center;
                            text-align: center;
                            padding: 10px;
                            border-radius: 10px;
                            border: 1px solid #f0f0f0;
                            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
                        }
                    
                        .counter_section .couter_icon {
                            margin-bottom: 10px; /* Espacement entre l'icône et les textes */
                        }
                    
                        .counter_section .counter_no {
                            margin-top: 10px; /* Espacement entre le nombre et le texte */
                        }
                    
                        /* Pour éviter le débordement du texte */
                        .counter_section .counter_no p {
                            overflow: hidden;
                            text-overflow: ellipsis;
                            white-space: nowrap;
                        }
                    </style>
                    
                    <div class="row column1">
                        <div class="col-md-6 col-lg-3">
                           <div class="full counter_section margin_bottom_30">
                              <div class="couter_icon">
                                 <div> 
                                    <i class="fa fa-user yellow_color"></i>
                                 </div>
                              </div>
                              <div class="counter_no">
                                 <div>
                                    <p class="total_no">2500</p>
                                    <p class="head_couter">Welcome</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                    
                        <div class="col-md-6 col-lg-3">
                            <div class="full counter_section margin_bottom_30">
                                <div class="couter_icon">
                                    <div class="icon-wrapper">
                                        <i class="fas fa-coins text-danger"></i>
                                    </div>
                                </div>
                                <div class="counter_no">
                                    <p class="total_no counter" data-target="{{ $totalDepenses }}">0</p>
                                    <p class="head_couter">Dépenses (FCFA)</p>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-md-6 col-lg-3">
                            <div class="full counter_section margin_bottom_30">
                                <div class="couter_icon">
                                    <div class="icon-wrapper">
                                        <i class="fas fa-hand-holding-usd text-primary"></i>
                                    </div>
                                </div>
                                <div class="counter_no">
                                    <p class="total_no counter" data-target="{{ $totalRecettes }}">0</p>
                                    <p class="head_couter">Recettes (FCFA)</p>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-md-6 col-lg-3">
                            <div class="full counter_section margin_bottom_30">
                                <div class="couter_icon">
                                    <div class="icon-wrapper">
                                        <i class="fas fa-file-invoice-dollar text-success"></i>
                                    </div>
                                </div>
                                <div class="counter_no">
                                    <p class="total_no counter" data-target="{{ $totalRapports }}">0</p>
                                    <p class="head_couter">Rapports</p>
                                </div>
                            </div>
                        </div>
                    
                        <!-- Icône pour la visualisation -->
                        <div class="col-md-6 col-lg-3">
                            <div class="full counter_section margin_bottom_30">
                                <div class="couter_icon">
                                    <div class="icon-wrapper">
                                        <i class="fas fa-chart-line text-info"></i>
                                    </div>
                                </div>
                                <div class="counter_no">
                                    <p class="total_no counter" data-target="{{ $totalVisualisations }}">0</p>
                                    <p class="head_couter">Visualisations</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <script>
                        // Effet compteur animé
                        document.addEventListener("DOMContentLoaded", function () {
                            const counters = document.querySelectorAll('.counter');
                            counters.forEach(counter => {
                                const target = parseFloat(counter.getAttribute('data-target'));
                                const isCurrency = counter.textContent.includes('FCFA');
                                let current = 0;
                                const increment = target / 60;
                    
                                const updateCounter = () => {
                                    if (current < target) {
                                        current += increment;
                                        if (isCurrency) {
                                            counter.textContent = formatNumber(current) + " FCFA";
                                        } else {
                                            counter.textContent = Math.floor(current);
                                        }
                                        requestAnimationFrame(updateCounter);
                                    } else {
                                        counter.textContent = isCurrency
                                            ? formatNumber(target) + " FCFA"
                                            : target;
                                    }
                                };
                                updateCounter();
                            });
                    
                            function formatNumber(n) {
                                return n.toLocaleString('fr-FR', {
                                    minimumFractionDigits: 2, 
                                    maximumFractionDigits: 2
                                });
                            }
                        });
                    </script>
                    
                    
                    <div class="row g-4 modern-stats">
                     <!-- Croissance trimestrielle -->
                     <div class="col-md-6 col-lg-4 col-xl-2">
                       <div class="modern-card border-start border-info border-4 shadow-sm">
                         <div class="card-body text-center">
                           <div class="icon-circle bg-info text-white mb-3">
                             <i class="fas fa-seedling"></i>
                           </div>
                           <div>
                             <h6 class="card-title text-muted">Croissance trimestrielle</h6>
                             <p class="card-value text-info fw-bold">+30.4%</p>
                           </div>
                         </div>
                       </div>
                     </div>
                   
                     <!-- Trésorerie disponible -->
                     <div class="col-md-6 col-lg-4 col-xl-2">
                       <div class="modern-card border-start border-success border-4 shadow-sm">
                         <div class="card-body text-center">
                           <div class="icon-circle bg-success text-white mb-3">
                             <i class="fas fa-wallet"></i>
                           </div>
                           <div>
                             <h6 class="card-title text-muted">Trésorerie disponible</h6>
                             <p class="card-value text-success fw-bold">84 560 (FCFA)</p>
                           </div>
                         </div>
                       </div>
                     </div>
                   
                     <!-- Projets en cours -->
                     <div class="col-md-6 col-lg-4 col-xl-2">
                       <div class="modern-card border-start border-warning border-4 shadow-sm">
                         <div class="card-body text-center">
                           <div class="icon-circle bg-warning text-white mb-3">
                             <i class="fas fa-project-diagram"></i>
                           </div>
                           <div>
                             <h6 class="card-title text-muted">Projets en cours</h6>
                             <p class="card-value text-warning fw-bold">9</p>
                           </div>
                         </div>
                       </div>
                     </div>
                   
                     <!-- Incidents critiques -->
                     <div class="col-md-6 col-lg-4 col-xl-2">
                       <div class="modern-card border-start border-danger border-4 shadow-sm">
                         <div class="card-body text-center">
                           <div class="icon-circle bg-danger text-white mb-3">
                             <i class="fas fa-bug"></i>
                           </div>
                           <div>
                             <h6 class="card-title text-muted">Incidents critiques</h6>
                             <p class="card-value text-danger fw-bold">2</p>
                           </div>
                         </div>
                       </div>
                     </div>
                   
                     <!-- Taux de rentabilité -->
                     <div class="col-md-6 col-lg-4 col-xl-2">
                       <div class="modern-card border-start border-primary border-4 shadow-sm">
                         <div class="card-body text-center">
                           <div class="icon-circle bg-primary text-white mb-3">
                             <i class="fas fa-chart-line"></i>
                           </div>
                           <div>
                             <h6 class="card-title text-muted">Taux de rentabilité</h6>
                             <p class="card-value text-primary fw-bold">12.5%</p>
                           </div>
                         </div>
                       </div>
                     </div>
                   
                     <!-- Factures en attente -->
                     <div class="col-md-6 col-lg-4 col-xl-2">
                       <div class="modern-card border-start border-secondary border-4 shadow-sm">
                         <div class="card-body text-center">
                           <div class="icon-circle bg-secondary text-white mb-3">
                             <i class="fas fa-file-invoice-dollar"></i>
                           </div>
                           <div>
                             <h6 class="card-title text-muted">Factures en attente</h6>
                             <p class="card-value text-secondary fw-bold">5</p>
                           </div>
                         </div>
                       </div>
                     </div>
                   </div>
                   
                   <style>
                     .modern-card {
                       border-radius: 12px;
                       background: #fff;
                       transition: transform 0.2s ease;
                       min-height: 160px;
                     }
                   
                     .modern-card:hover {
                       transform: translateY(-3px);
                     }
                   
                     .icon-circle {
                       width: 60px;
                       height: 60px;
                       border-radius: 50%;
                       font-size: 24px;
                       display: flex;
                       align-items: center;
                       justify-content: center;
                       margin: 0 auto;
                       box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                     }
                   
                     .card-title {
                       font-size: 14px;
                       margin-top: 8px;
                       text-transform: uppercase;
                       letter-spacing: 0.5px;
                     }
                   
                     .card-value {
                       font-size: 20px;
                       margin: 5px 0 0;
                     }
                   </style>
                   
                     <!-- graph -->
                     {{-- <div class="row column2 graph margin_bottom_30">
                        <div class="col-md-l2 col-lg-12">
                           <div class="white_shd full">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>Extra Area Chart</h2>
                                 </div>
                              </div>
                              <div class="full graph_revenue">
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="content">
                                          <div class="area_chart">
                                             <canvas height="120" id="canvas"></canvas>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- end graph -->
                     <div class="row column3">
                        <!-- testimonial -->
                        <div class="col-md-6">
                           <div class="dark_bg full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>Testimonial</h2>
                                 </div>
                              </div>
                              <div class="full graph_revenue">
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="content testimonial">
                                          <div id="testimonial_slider" class="carousel slide" data-ride="carousel">
                                             <!-- Wrapper for carousel items -->
                                             <div class="carousel-inner">
                                                <div class="item carousel-item active">
                                                   <div class="img-box"><img src="images/layout_img/potho_d'identiée_dossou_pierre.jpg" alt=""></div>
                                                   <p class="testimonial">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae..</p>
                                                   <p class="overview"><b>Michael Stuart</b>Seo Founder</p>
                                                </div>
                                                <div class="item carousel-item">
                                                   <div class="img-box"><img src="images/layout_img/potho_d'identiée_dossou_pierre.jpg" alt=""></div>
                                                   <p class="testimonial">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae..</p>
                                                   <p class="overview"><b>Michael Stuart</b>Seo Founder</p>
                                                </div>
                                                <div class="item carousel-item">
                                                   <div class="img-box"><img src="images/layout_img/potho_d'identiée_dossou_pierre.jpg" alt=""></div>
                                                   <p class="testimonial">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae..</p>
                                                   <p class="overview"><b>Michael Stuart</b>Seo Founder</p>
                                                </div>
                                             </div>
                                             <!-- Carousel controls -->
                                             <a class="carousel-control left carousel-control-prev" href="#testimonial_slider" data-slide="prev">
                                             <i class="fa fa-angle-left"></i>
                                             </a>
                                             <a class="carousel-control right carousel-control-next" href="#testimonial_slider" data-slide="next">
                                             <i class="fa fa-angle-right"></i>
                                             </a>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- end testimonial -->
                        <!-- progress bar -->
                        <div class="col-md-6">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>Progress Bar</h2>
                                 </div>
                              </div>
                              <div class="full progress_bar_inner">
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="progress_bar">
                                          <!-- Skill Bars -->
                                          <span class="skill" style="width:73%;">Facebook <span class="info_valume">73%</span></span>                  
                                          <div class="progress skill-bar ">
                                             <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="73" aria-valuemin="0" aria-valuemax="100" style="width: 73%;">
                                             </div>
                                          </div>
                                          <span class="skill" style="width:62%;">Twitter <span class="info_valume">62%</span></span>   
                                          <div class="progress skill-bar">
                                             <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%;">
                                             </div>
                                          </div>
                                          <span class="skill" style="width:54%;">Instagram <span class="info_valume">54%</span></span>
                                          <div class="progress skill-bar">
                                             <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="54" aria-valuemin="0" aria-valuemax="100" style="width: 54%;">
                                             </div>
                                          </div>
                                          <span class="skill" style="width:82%;">Google plus <span class="info_valume">82%</span></span>
                                          <div class="progress skill-bar">
                                             <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100" style="width: 82%;">
                                             </div>
                                          </div>
                                          <span class="skill" style="width:48%;">Other <span class="info_valume">48%</span></span>
                                          <div class="progress skill-bar">
                                             <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100" style="width: 48%;">
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- end progress bar -->
                     </div>
                     <div class="row column4 graph">
                        <div class="col-md-6 margin_bottom_30">
                           <div class="dash_blog">
                              <div class="dash_blog_inner">
                                 <div class="dash_head">
                                    <h3><span><i class="fa fa-calendar"></i> 6 July 2018</span><span class="plus_green_bt"><a href="#">+</a></span></h3>
                                 </div>
                                 <div class="list_cont">
                                    <p>Today Tasks for Ronney Jack</p>
                                 </div>
                                 <div class="task_list_main">
                                    <ul class="task_list">
                                       <li><a href="#">Meeting about plan for Admin Template 2018</a><br><strong>10:00 AM</strong></li>
                                       <li><a href="#">Create new task for Dashboard</a><br><strong>10:00 AM</strong></li>
                                       <li><a href="#">Meeting about plan for Admin Template 2018</a><br><strong>11:00 AM</strong></li>
                                       <li><a href="#">Create new task for Dashboard</a><br><strong>10:00 AM</strong></li>
                                       <li><a href="#">Meeting about plan for Admin Template 2018</a><br><strong>02:00 PM</strong></li>
                                    </ul>
                                 </div>
                                 <div class="read_more">
                                    <div class="center"><a class="main_bt read_bt" href="#">Read More</a></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="dash_blog">
                              <div class="dash_blog_inner">
                                 <div class="dash_head">
                                    <h3><span><i class="fa fa-comments-o"></i> Updates</span><span class="plus_green_bt"><a href="#">+</a></span></h3>
                                 </div>
                                 <div class="list_cont">
                                    <p>User confirmation</p>
                                 </div>
                                 <div class="msg_list_main">
                                    <ul class="msg_list">
                                       <li>
                                          <span><img src="images/layout_img/msg2.png" class="img-responsive" alt="#" /></span>
                                          <span>
                                          <span class="name_user">Herman Beck</span>
                                          <span class="msg_user">Sed ut perspiciatis unde omnis.</span>
                                          <span class="time_ago">12 min ago</span>
                                          </span>
                                       </li>
                                       <li>
                                          <span><img src="images/layout_img/msg3.png" class="img-responsive" alt="#" /></span>
                                          <span>
                                          <span class="name_user">John Smith</span>
                                          <span class="msg_user">On the other hand, we denounce.</span>
                                          <span class="time_ago">12 min ago</span>
                                          </span>
                                       </li>
                                       <li>
                                          <span><img src="images/layout_img/msg2.png" class="img-responsive" alt="#" /></span>
                                          <span>
                                          <span class="name_user">John Smith</span>
                                          <span class="msg_user">Sed ut perspiciatis unde omnis.</span>
                                          <span class="time_ago">12 min ago</span>
                                          </span>
                                       </li>
                                       <li>
                                          <span><img src="images/layout_img/msg3.png" class="img-responsive" alt="#" /></span>
                                          <span>
                                          <span class="name_user">John Smith</span>
                                          <span class="msg_user">On the other hand, we denounce.</span>
                                          <span class="time_ago">12 min ago</span>
                                          </span>
                                       </li>
                                    </ul>
                                 </div>
                                 <div class="read_more">
                                    <div class="center"><a class="main_bt read_bt" href="#">Read More</a></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div> --}}
                  </div>
                  <!-- footer -->
                  <div class="container-fluid">
                     <div class="footer">
                        <p>Copyright © 2025 DOSSOU Pierre
                        </p>
                     </div>
                  </div>
               </div>
               <!-- end dashboard inner -->
            </div>
         </div>
      </div>
      <!-- jQuery -->
      <script src="{{asset('js/jquery.min.js')}}"></script>
      <script src="{{asset('s/popper.min.js')}}j"></script>
      <script src="{{asset('bootstrap.min.js')}}js/"></script>
      <!-- wow animation -->
      <script src="{{asset('js/animate.js')}}"></script>
      <!-- select country -->
      <script src="{{asset('js/bootstrap-select.js')}}"></script>
      <!-- owl carousel -->
      <script src="{{asset('js/owl.carousel.js')}}"></script> 
      <!-- chart js -->
      <script src="{{asset('js/Chart.min.js')}}"></script>
      <script src="{{asset('js/Chart.bundle.min.js')}}"></script>
      <script src="{{asset('js/utils.js')}}"></script>
      <script src="{{asset('js/analyser.js')}}"></script>
      <!-- nice scrollbar -->
      <script src="{{asset('js/perfect-scrollbar.min.js')}}"></script>
      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>
      <!-- custom js -->
      <script src="{{asset('js/custom.js')}}"></script>
      <script src="{{asset('js/chart_custom_style1.js')}}"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function(){
        $('.dropdown-toggle').click(function(){
            var target = $(this).attr('href');
            $(target).collapse('toggle');
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
    var profile = document.querySelector(".user_profile_dd > li > a");
    var menu = document.querySelector(".dropdown-menu");

    profile.addEventListener("click", function (event) {
        event.preventDefault(); // Empêche le lien de changer de page
        menu.style.display = (menu.style.display === "block") ? "none" : "block";
    });

    document.addEventListener("click", function (event) {
        if (!profile.contains(event.target) && !menu.contains(event.target)) {
            menu.style.display = "none";
        }
    });
});
     </script>
     

   </body>

<!-- Mirrored from themewagon.github.io/pluto/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 27 Mar 2025 14:38:32 GMT -->
</html>