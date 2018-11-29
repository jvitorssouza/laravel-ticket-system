<!-- MENU LATERAL-->
<aside class="aside-container">
    <div class="aside-inner">
        <nav class="sidebar" data-sidebar-anyclick-close="">
            <ul class="sidebar-nav">
                <!-- INFORMAÇÕES DO USUÁRIO -->
                <li class="has-user-block">
                    <div class="show" id="user-block">
                        <div class="item user-block">
                            <!-- FOTO DO USUÁRIO -->
                            <div class="user-block-picture">
                                <div class="user-block-status">
                                    <img class="img-thumbnail rounded-circle" src="assets/images/user/02.jpg" alt="Avatar" width="60" height="60">
                                    <div class="circle bg-success circle-lg"></div>
                                </div>
                            </div>
                            <!-- NOME DO USUÁRIO -->
                            <div class="user-block-info">
                                <span class="user-block-name">{{ Auth::user()->credencial_nome }}</span>
                                <span class="user-block-name small">{{ Auth::user()->perfil->perfil_descricao}}</span>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- FIM INFORMAÇÕES DO USUÁRIOS -->
                <!-- ITENS DO MENU -->
                <li class="nav-heading ">
                    <span>Main Navigation</span>
                </li>

                <li class=" {{ $rota_atual == 'dashboard.index' ? 'active' : '' }}  ">
                    <a href="{{ route('dashboard.index') }}" title="Dashboard">
                        <i class="fas fa-th"></i>
                        <span data-localize="sidebar.nav.WIDGETS">Dashboard</span>
                    </a>
                </li>

                <li class=" ">
                    <a href="#tickets" title="Helpdesk" data-toggle="collapse" class="" aria-expanded="true">
                        <em class="fas fa-sticky-note"></em>
                        <span>Helpdesk</span>
                    </a>

                    <ul class="sidebar-nav sidebar-subnav collapse" id="tickets" style="">
                        <li class="sidebar-subnav-header"> Helpdesk</li>
                        <li class=" {{ $rota_atual == 'categorias.index' || $rota_atual == 'categorias.edit' ? 'active' : '' }} ">
                            <a href="{{ route('categorias.index') }}" title="Listagem de Categorias">
                                <i class="fas fa-align-justify"></i> <span> Categorias</span>
                            </a>
                        </li>
                        <li class=" ">
                            <a href="dashboard_v2.html" title="Listagem de Chamados">
                                <i class="fas fa-receipt"></i> <span> Chamados</span>
                            </a>
                        </li>
                        <li class=" ">
                            <a href="dashboard_v2.html" title="Telão de Resumo dos Chamados">
                                <i class="fas fa-tv"></i> <span> Telão</span>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class=" ">
                    <a href="#servers" title="Helpdesk" data-toggle="collapse" class="" aria-expanded="true">
                        <i class="fas fa-server"></i>
                        <span>Servidores</span>
                    </a>

                    <ul class="sidebar-nav sidebar-subnav collapse" id="servers" style="">
                        <li class="sidebar-subnav-header"> Servidores</li>
                        <li class=" ">
                            <a href="dashboard_v2.html" title="Listagem de Servidores">
                                <i class="fas fa-th-list"></i> <span> Listagem</span>
                            </a>
                        </li>
                        <li class=" ">
                            <a href="dashboard.html" title="Logs de Servidores">
                                <i class="fas fa-file-alt"></i> <span> Logs</span>
                            </a>
                        </li>
                        <li class=" ">
                            <a href="dashboard.html" title="Listagem de Usuários do Active Directory">
                                <i class="fas fa-users"></i> <span> Usuários AD</span>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</aside>
<!-- FIM DO MENU LATERAL -->
