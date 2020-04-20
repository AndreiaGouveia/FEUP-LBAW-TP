@extends('layouts.app')

@section('stylesheets')
@parent

<link rel="stylesheet" type="text/css" href="{{ asset('css/main_page.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')

    <div class="col-md-7 mx-auto my-5">
        <h3 class="font-weight-normal mb-3"><?= $titlePage ?></h3>
        <hr class="section-break" />

        <form>
            <div class="form-group">

                <div class="content mb-4">
                    <label for="inputTitle">Titulo</label>
                    <input id="inputTitle" class="form-control" placeholder="Titulo" required="" autofocus="" value="<?= $titleQuestion ?>">
                </div>

                <div class="content mb-4">
                    <label for="textAreaDescription">Descrição</label>
                    <textarea id="textAreaDescription" class="form-control" placeholder="Descrição" required="" autofocus="" rows="6"><?= $description ?></textarea>
                </div>

                <div class="content mb-4">
                    <label for="inputTopics">Tópicos</label>
                    <input id="inputTopics" class="form-control" placeholder="Tópicos" required="" autofocus="" value="<?= $topics ?>">
                </div>

                <div class="d-flex justify-content-end d-inline">
                    <button class="btn btn-secondary mr-2">Cancelar</button>
                    <button type="submit" class="btn btn-primary"><?= $titlePage ?>
                </div>

            </div>
        </form>
    </div>

@endsection