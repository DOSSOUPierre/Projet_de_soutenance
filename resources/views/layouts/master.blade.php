<!DOCTYPE html>
<html lang="fr">
<head>
    @php use Illuminate\Support\Facades\Auth; @endphp

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Plateforme de gestion financière et budgétaire d'entreprise</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/fevicon.png') }}" type="image/png" />

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <!-- Scripts pour compatibilité IE -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.0/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <style>
        .scrollable-content {
            overflow-x: auto;
            overflow-y: hidden;
            white-space: nowrap;
            max-width: 100%;
            padding-bottom: 20px;
        }

        .midde_cont {
            min-height: calc(100vh - 100px);
            background-color: white;
            padding: 20px;
            overflow: hidden;
        }

        #content {
            width: 100%;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background-color: #fff;
            border: 1px solid #ddd;
            z-index: 1000;
        }
    </style>
</head>

<body class="dashboard dashboard_1">
<div class="full_container">
    <div class="inner_container">

        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar_blog_1">
                <div class="sidebar-header">
                    <div class="logo_section">
                        <a href="{{ route('dashboard') }}">
                            <img class="logo_icon img-responsive" src="{{ asset('images/logo/images.png') }}" alt="Logo" />
                        </a>
                    </div>
                </div>

                <div class="sidebar_user_info">
                    <div class="icon_setting"></div>
                    <div class="user_profle_side">
                        <div class="user_img">
                            <img class="img-responsive" src="{{ asset('images/layout_img/photo_identite_pierre.jpg') }}" alt="User Image" />
                        </div>
                        <div class="user_info">
                            <h6><span class="name_user">{{ Auth::user()->name }}</span></h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sidebar_blog_2">
                <h4>General</h4>
                <ul class="list-unstyled components">
                    <li><a href="{{ route('listeDepense') }}"><i class="fa fa-wallet purple_color"></i> Gestion des Dépenses</a></li>
                    <li><a href="{{ route('categories.index') }}"><i class="fa fa-tags purple_color me-2"></i> <span>Catégories de Dépense</span></a></li>
                    <li><a href="{{ route('listeRecette') }}"><i class="fa fa-money-bill-wave purple_color"></i> Gestion des Recettes</a></li>
                    <li><a href="{{ route('categories_recette.index') }}"><i class="fa fa-tags purple_color me-2"></i> <span>Catégories de Recette</span></a></li>
                    <li><a href="{{ route('rapport.pdf') }}"><i class="fa fa-bar-chart text-success"></i> Rapport Financier</a></li>
                    <li><a href="{{ route('rapport.litterature.pdf') }}"><i class="fa fa-book text-primary"></i> Rapport de Littérature</a></li>
                    <li><a href="{{ route('visualisation') }}"><i class="fa fa-bar-chart-o green_color"></i> Visualisation</a></li>

                    @auth
                        @if(auth()->user()->type === 'admin')
                            <li>
                                <a href="#gestionAdmins" data-bs-toggle="collapse" class="dropdown-toggle">
                                    <i class="fa fa-user-shield yellow_color"></i> Gestion des admins
                                </a>
                                <ul class="collapse list-unstyled" id="gestionAdmins">
                                    <li><a href="{{ route('utilisateur.create') }}">Créer un compte pour admins</a></li>
                                    <li><a href="{{ route('utilisateurs.liste') }}">Liste des admins</a></li>
                                    <li><a href="{{ route('depenses.archivees') }}">Liste des archives des dépenses</a></li>
                                    <li><a href="{{ route('recettes.archivees') }}">Liste des archives des recettes</a></li>
                                    <li><a href="{{ route('archives.pdf') }}"><i class="fas fa-file-pdf"></i> Générer Rapport PDF</a></li>
                                </ul>
                            </li>
                        @endif
                    @endauth
                </ul>
            </div>
        </nav>
        <!-- End Sidebar -->

        <!-- Content -->
        <div id="content">
            <!-- Topbar -->
            <div class="topbar">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="full">
                        <button type="button" id="sidebarCollapse" class="sidebar_toggle">
                            <i class="fa fa-bars"></i>
                        </button>

                        <div class="right_topbar">
                            <div class="icon_info">
                                <ul>
                                    <li><a href="#"><i class="fa fa-bell-o"></i><span class="badge">2</span></a></li>
                                    <li><a href="#"><i class="fa fa-question-circle"></i></a></li>
                                    <li><a href="#"><i class="fa fa-envelope-o"></i><span class="badge">3</span></a></li>
                                </ul>

                                <ul class="user_profile_dd">
                                    <li>
                                        <a class="dropdown-toggle" href="#">
                                            <img class="img-responsive rounded-circle" src="{{ asset('images/layout_img/photo_identite_pierre.jpg') }}" alt="Profile Image" />
                                            <span class="name_user">{{ Auth::user()->name }}</span>
                                        </a>
                                        <div class="dropdown-menu">
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <span>Déconnexion</span> <i class="fa fa-sign-out"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <!-- End Topbar -->

            <!-- Dashboard content -->
            <div class="midde_cont">
                <div class="container-fluid">
                    <div class="row column_title">
                        <div class="col-md-12">
                            <div class="page_title">
                                <h2>Plateforme de gestion financière et budgétaire d'entreprise</h2>
                            </div>
                        </div>
                    </div>

                    <!-- Zone scrollable -->
                    <div class="scrollable-content">
                        @yield("contenu")
                    </div>

                </div>

                <!-- Footer -->
                <div class="container-fluid">
                    <div class="footer">
                        <p>Copyright © 2025 DOSSOU Pierre</p>
                    </div>
                </div>
            </div>
            <!-- End Dashboard content -->
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/bootstrap-select.js') }}"></script>
<script src="{{ asset('js/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

<script>
    var ps = new PerfectScrollbar('#sidebar');

    document.addEventListener("DOMContentLoaded", function () {
        const profile = document.querySelector(".user_profile_dd > li > a");
        const menu = document.querySelector(".user_profile_dd .dropdown-menu");

        profile.addEventListener("click", function (event) {
            event.preventDefault();
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
</html>
