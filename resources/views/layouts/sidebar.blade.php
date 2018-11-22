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
                                <span class="user-block-name">Hello, Mike</span>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- FIM INFORMAÇÕES DO USUÁRIOS -->
                <!-- ITENS DO MENU -->
                <li class="nav-heading ">
                    <span>Main Navigation</span>
                </li>

                {{ $menu }}
            </ul>
        </nav>
    </div>
</aside>
<!-- FIM DO MENU LATERAL -->