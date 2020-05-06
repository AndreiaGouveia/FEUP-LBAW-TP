@extends('layouts.app')

@section('stylesheets')
@parent

<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}">

@endsection

@section('content')

    <div class="col-md-7 mx-auto">
        <div class=" mt-5">
            <h1 class="font-weight-normal mb-3">Sobre Nós</h1>
            <hr class="section-break" />

        </div>


        <div class=" mt-5" id="about-text">
            <p>
                O objetivo deste projeto foi desenvolver uma aplicação web de perguntas e respostas sobre animais.
                Esta aplicação consiste numa plataforma na qual todos os utilizadores podem deixar as suas perguntas e vê-las serem respondidas e/ou comentadas por outros membros da comunidade.
                Desta maneira, a aplicação suportar uma grande variedade de perguntas e repostas que satisfazem a curiosidade de todos os amantes de animais.
                Após uma breve pesquisa online, verificámos que apesar de já existirem diversos sites de perguntas e respostas, tanto gerais como específicos para o reino animal, existe uma falha no mercado de uma aplicação web deste género que seja user-friendly.
                Deste modo, resolvemos criar a nossa aplicação que consististe numa interface simples, mas muito completa, para que os utilizadores possam ver respondidas as suas curiosidades relativas ao reino animal.
            </p>
        </div>

        <div class="bg-transparent">
            <div class="py-5 ">
                <div class="row mb-4">
                    <div class="col-lg-5">
                        <h2 class="display-5 font-weight-light" style="font-size: 1.5rem;">A nossa equipa:</h2>
                    </div>
                </div>

                <div class="row text-center ">
                    <!-- Team item-->
                    <div class="col-xl-3 col-sm-6 mb-5 ">
                        <div class="bg-white rounded shadow-sm py-5 px-4 border border-color-secondary"><img src="https://res.cloudinary.com/mhmd/image/upload/v1556834132/avatar-4_ozhrib.png"" alt="" width=" 100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                            <h5 class="mb-0">Ana Filipa Senra</h5><span class="small text-uppercase text-muted">CEO - Founder</span>
                        </div>
                    </div>
                    <!-- End-->

                    <!-- Team item-->
                    <div class="col-xl-3 col-sm-6 mb-5 ">
                        <div class="bg-white rounded shadow-sm py-5 px-4 border border-color-secondary">
                            <img src="https://res.cloudinary.com/mhmd/image/upload/v1556834130/avatar-3_hzlize.png" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                            <h5 class="mb-0">Andreia Gouveia</h5><span class="small text-uppercase text-muted">CEO - Founder</span>
                        </div>
                    </div>
                    <!-- End-->

                    <!-- Team item-->
                    <div class="col-xl-3 col-sm-6 mb-5 ">
                        <div class="bg-white rounded shadow-sm py-5 px-4 border border-color-secondary">
                            <img src="https://res.cloudinary.com/mhmd/image/upload/v1556834133/avatar-2_f8dowd.png" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                            <h5 class="mb-0">Cláudia Martins</h5><span class="small text-uppercase text-muted">CEO - Founder</span>
                        </div>
                    </div>
                    <!-- End-->

                    <!-- Team item-->
                    <div class="col-xl-3 col-sm-6 mb-5 ">
                        <div class="bg-white rounded shadow-sm py-5 px-4 border border-color-secondary"><img src="https://res.cloudinary.com/mhmd/image/upload/v1556834133/avatar-1_s02nlg.png" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                            <h5 class="mb-0">Margarida Pinho</h5><span class="small text-uppercase text-muted">CEO - Founder</span>
                        </div>
                    </div>
                    <!-- End-->

                </div>
            </div>
        </div>

    </div>


@endsection