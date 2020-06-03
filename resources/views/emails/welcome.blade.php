@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])    
 
        <a class="navbar-brand px-2 mr-5" href="{{ url('home') }}">
            <img src="https://i.ibb.co/FB6qj03/logo.png"  width="35" height="42" class="d-inline-block align-center" alt="logo" />
            Papagaio
        </a>
   
        @endcomponent
    @endslot

    {{-- Body --}}

    <header class="welcome ">
            <h1 class="text-center">Bem-Vindo ao Papagaio!</h1>
            <img src="https://i.ibb.co/FB6qj03/logo.png" alt="logo" />
            <h2 class="text-center ">Entre no mundo do conhecimento Animal! 
                    Aqui vai poder esclarecer todas as suas duvidas e partilhar com os outros o seu conhecimento!!.</h2>
    </header>
   

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
        <footer >
             <p class="footer" >© 2020 Papagaio, Inc.</p>
        </footer>
        @endcomponent
    @endslot
@endcomponent