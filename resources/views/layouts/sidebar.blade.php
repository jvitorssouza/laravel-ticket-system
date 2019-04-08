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
                                    <img class="img-thumbnail rounded-circle" src="{{ asset('assets/images/user/user_default.png') }}" alt="Avatar" width="60" height="60">
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
                    <span>Menu Principal</span>
                </li>

                <li class=" {{ $rota_atual == 'dashboard.index' ? 'active' : '' }}  ">
                    <a href="{{ route('dashboard.index') }}" title="Dashboard">
                        <i class="fas fa-th"></i>
                        <span data-localize="sidebar.nav.WIDGETS">Dashboard</span>
                    </a>
                </li>

                @if(Auth::user()->can('empresas.index')  || Auth::user()->can('departamentos.index') || Auth::user()->can('fabricantes.index')  )
                <li class=" ">
                    <a href="#cadastros" title="Cadastros" data-toggle="collapse" class="" aria-expanded="true">
                        <em class="fas fa-folder"></em>
                        <span>Cadastros</span>
                    </a>
                    <ul class="sidebar-nav sidebar-subnav collapse" id="cadastros" style="">
                        <li class="sidebar-subnav-header"> Cadastros</li>

                        @can('empresa.index')
                            <li class=" {{ $rota_atual == 'empresas.index' || $rota_atual == 'empresas.edit' || $rota_atual == 'empresas.create' ? 'active' : '' }}">
                                <a href="{{ route('empresas.index') }}" title="Listagem de Empresas">
                                    <i class="fas fa-building"></i> <span> Empresas</span>
                                </a>
                            </li>
                        @endcan

                        @can('departamento.index')
                            <li class=" {{ $rota_atual == 'departamentos.index' || $rota_atual == 'departamentos.edit' || $rota_atual == 'departamentos.create' ? 'active' : '' }}">
                                <a href="{{ route('departamentos.index') }}" title="Listagem de Departamentos">
                                    <i class="fas fa-boxes"></i> <span> Departamentos</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @endif

                @if(Auth::user()->can('categorias.index')  || Auth::user()->can('helpdesk.index') )
                    <li class=" ">
                        <a href="#tickets" title="Helpdesk" data-toggle="collapse" class="" aria-expanded="true">
                            <em class="fas fa-sticky-note"></em>
                            <span>Helpdesk</span>
                        </a>
                        <ul class="sidebar-nav sidebar-subnav collapse" id="tickets" style="">
                            <li class="sidebar-subnav-header"> Helpdesk</li>

                            @can('categorias.index')
                                <li class=" {{ $rota_atual == 'categorias.index' || $rota_atual == 'categorias.edit' || $rota_atual == 'categorias.create' ? 'active' : '' }}">
                                    <a href="{{ route('categorias.index') }}" title="Listagem de Categorias">
                                        <i class="fas fa-align-justify"></i> <span> Categorias</span>
                                    </a>
                                </li>
                            @endcan

                            @can('helpdesk.index')
                                <li class=" {{ $rota_atual == 'helpdesk.index' || $rota_atual == 'helpdesk.edit' || $rota_atual == 'helpdesk.create' || $rota_atual == 'helpdesk.show' ? 'active' : '' }}">
                                    <a href="{{ route('helpdesk.index') }}" title="Listagem de Chamados">
                                        <i class="fas fa-receipt"></i> <span> Chamados</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif

                @if(Auth::user()->can('perfilacesso.index'))
                    <li class=" ">
                        <a href="#sistema" title="Helpdesk" data-toggle="collapse" class="" aria-expanded="true">
                                <i class="fas fa-cogs"></i>
                            <span>Sistema</span>
                        </a>
                        <ul class="sidebar-nav sidebar-subnav collapse" id="sistema" style="">
                            <li class="sidebar-subnav-header">Configurações</li>

                            @can('perfilacesso.index')
                                <li class=" {{ $rota_atual == 'perfilacesso.index' || $rota_atual == 'perfilacesso.edit' || $rota_atual == 'perfilacesso.create' ? 'active' : '' }}">
                                    <a href="{{ route('perfilacesso.index') }}" title="Listagem de Perfis de Acesso">
                                        <i class="fas fa-ban"></i> <span> Perfis de Acesso</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif


            </ul>
        </nav>
    </div>
</aside>
<!-- FIM DO MENU LATERAL -->
