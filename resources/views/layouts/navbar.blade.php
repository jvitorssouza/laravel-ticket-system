<!-- NAVBAR -->
<header class="topnavbar-wrapper">
    <!-- INÍCIO NAVBAR -->
    <nav class="navbar topnavbar">
        <!-- LOGO DO SISTEMA -->
        <div class="navbar-header">
            <a class="navbar-brand">
                <div class="brand-logo">
                    <img class="img-fluid" src="assets/images/logo.png" alt="App Logo">
                </div>
                <div class="brand-logo-collapsed">
                    <img class="img-fluid" src="assets/images/logo-single.png" alt="App Logo">
                </div>
            </a>
        </div>
        <!-- END navbar header-->

        <!-- BTN OCULTAR/MOSTRAR MENU LATERAL-->
        <ul class="navbar-nav mr-auto flex-row">
            <li class="nav-item">
                <!-- Button used to collapse the left sidebar. Only visible on tablet and desktops-->
                <a class="nav-link d-none d-md-block d-lg-block d-xl-block" data-trigger-resize="" data-toggle-state="aside-collapsed">
                    <em class="fas fa-bars"></em>
                </a>
                <!-- Button to show/hide the sidebar on mobile. Visible on mobile only.-->
                <a class="nav-link sidebar-toggle d-md-none" data-toggle-state="aside-toggled" data-no-persist="true">
                    <em class="fas fa-bars"></em>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav flex-row">
            <!-- BTN TELA CHEIA -->
            <li class="nav-item d-none d-md-block">
                <a class="nav-link" data-toggle-fullscreen="">
                    <em class="fas fa-expand"></em>
                </a>
            </li>

            <!-- BTN LOGOUT -->
            <li class="nav-item d-none d-md-block">
                <a class="nav-link">
                    <em class="fas fa-sign-out-alt"></em>
                </a>
            </li>
        </ul>
    </nav>
</header>
<!-- FIM NAVBAR -->