<!DOCTYPE html>
<html lang="pt-br">

@include('layouts.head')

<body>
<div class="wrapper">
    @include('layouts.navbar')

    @include('layouts.sidebar')


    <!-- CONTEÚDO -->
    <section class="section-container">
        <!-- Page content-->
        <div class="content-wrapper">
            <div class="content-heading">
                <div>
                    @yield('titulo_pagina')
                </div>
            </div>

            <div class="row">
                <!-- START dashboard main content-->
                <div class="col-xl-12">
                    @yield('conteudo')
                </div>
            </div>
        </div>
    </section>
    <!-- FIM DO CONTEÚDO -->

    @include('layouts.footer')
</div>


@include('layouts.scripts')

</body>

</html>
