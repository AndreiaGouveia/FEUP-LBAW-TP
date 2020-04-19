<a href="../pages/question.php" class="hiperlink-in-activity">
    <div class="activity py-4 px-4 border-top">

        @include('partials.header_activity', ['name' => $question->name, "link_profile" => $question->url, 'action' => "", 'actionInBold' => "", "date" => $question->date])
        <h5 class="title"><?= $question->title  ?></h5>
        <p class="text"><?= $question->description ?></p>
    </div>
</a>