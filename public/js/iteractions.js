function addEventListeners() {

  let responseCreator = document.querySelector('#response_form');
  if (responseCreator != null)
    responseCreator.addEventListener('submit', sendCreateResponseRequest);

  let commentCreatorArray = document.querySelectorAll('form.comment-box');
  for (commentCreator of commentCreatorArray) {
    commentCreator.addEventListener('submit', sendCreateCommentRequest);
  }

  let reportArray = document.querySelectorAll('form.report');
  for (report of reportArray) {
    report.addEventListener('submit', sendReport);
  }

  let deletePublicationArray = document.querySelectorAll('form.deletePub');
  for (deletePub of deletePublicationArray) {
    deletePub.addEventListener('submit', sendDeletePublication);
  }


  let likeButtonArray = document.querySelectorAll('.btn.like');
  for (likeButton of likeButtonArray) {
    likeButton.addEventListener('click', sendLikeRequest);
  }

  let dislikeButtonArray = document.querySelectorAll('.btn.dislike');
  for (dislikeButton of dislikeButtonArray) {
    dislikeButton.addEventListener('click', sendDislikeRequest);
  }

  let favoriteButtonArray = document.querySelectorAll('.btn.favorite');
  for (favoriteButtonArray of favoriteButtonArray) {
    favoriteButtonArray.addEventListener('click', sendFavoriteRequest);
  }
}

function encodeForAjax(data) {
  if (data == null) return null;
  return Object.keys(data).map(function (k) {
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}

function sendAjaxRequest(method, url, data, handler, extraInfo) {
  let request = new XMLHttpRequest();

  request.open(method, url, true);
  request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.extraInfo = extraInfo;
  request.addEventListener('load', handler);
  request.send(encodeForAjax(data));
}

function updateCounters(input) {

  input.classList.add('active');
  input.lastChild.nodeValue = parseInt(input.lastChild.nodeValue) + 1;
  input.lastChild.nodeValue = "\n" + input.lastChild.nodeValue + "\n";

  if (input.nextElementSibling) {

    if (input.nextElementSibling.classList.contains('active')) {

      input.nextElementSibling.classList.remove('active');
      input.nextElementSibling.lastChild.nodeValue = parseInt(input.nextElementSibling.lastChild.nodeValue) - 1;
      input.nextElementSibling.lastChild.nodeValue = "\n" + input.nextElementSibling.lastChild.nodeValue + "\n";
    }
  }
  else {
    if (input.previousElementSibling.classList.contains('active')) {


      input.previousElementSibling.classList.remove('active');
      input.previousElementSibling.lastChild.nodeValue = parseInt(input.previousElementSibling.lastChild.nodeValue) - 1;
      input.previousElementSibling.lastChild.nodeValue = "\n" + input.previousElementSibling.lastChild.nodeValue + "\n";
    }
  }
}


function sendLikeRequest(event) {

  event.stopImmediatePropagation();
  event.preventDefault();

  //When button is already selected
  if (this.classList.contains('active')) {

    let parentDiv = this.parentElement;
    let id_publication = parentDiv.dataset.publicationId;

    if (id_publication)
      sendAjaxRequest('POST', '/api/publications/' + id_publication + '/likes/delete', { like: true }, likeRemovedHandler, this);

    event.preventDefault();
  }

  let parentDiv = this.parentElement;
  let id_publication = parentDiv.dataset.publicationId;

  if (id_publication)
    sendAjaxRequest('POST', '/api/publications/' + id_publication + '/likes', { like: true }, likeAddedHandler, this);

}

function sendDislikeRequest(event) {


  event.stopImmediatePropagation();
  event.preventDefault();

  //When button is already selected
  if (this.classList.contains('active')) {

    let parentDiv = this.parentElement;
    let id_publication = parentDiv.dataset.publicationId;
    if (id_publication)
      sendAjaxRequest('POST', '/api/publications/' + id_publication + '/likes/delete', { like: false }, likeRemovedHandler, this);

      event.preventDefault();
  }

  let parentDiv = this.parentElement;
  let id_publication = parentDiv.dataset.publicationId;

  if (id_publication)
    sendAjaxRequest('POST', '/api/publications/' + id_publication + '/likes', { like: false }, likeAddedHandler, this);

}

function sendFavoriteRequest(event) {

  event.stopImmediatePropagation();
  event.preventDefault();

  //When button is already selected
  if (this.classList.contains('active')) {

    let parentDiv = this.parentElement;
    let id_publication = parentDiv.dataset.publicationId;

    if (id_publication)
      sendAjaxRequest('POST', '/api/publications/' + id_publication + '/favorites/delete', {}, favoriteRemovedHandler, this);

      event.preventDefault();
  }

  let parentDiv = this.parentElement;
  let id_publication = parentDiv.dataset.publicationId;

  if (id_publication)
    sendAjaxRequest('POST', '/api/publications/' + id_publication + '/favorites', {}, favoriteAddedHandler, this);


}

function favoriteAddedHandler() {

  console.log(this);

  if (this.status == 403) {

    return;
  }

  if (this.status != 200) {

    return;
  }

  this.extraInfo.classList.add('active');
}

function likeAddedHandler() {

  console.log(this);

  if (this.status == 403) {

    return;
  }

  if (this.status != 200) {

    return;
  }

  let input = this.extraInfo;
  updateCounters(input);

  console.log(input);


}

function favoriteRemovedHandler() {

  if (this.status == 403) {

    console.log(this);
    return;
  }

  if (this.status != 200) {

    console.log(this);

    return;
  }

  this.extraInfo.classList.remove('active');

}

function likeRemovedHandler() {


  if (this.status == 403) {

    console.log(this);
    return;
  }

  if (this.status != 200) {

    console.log(this);

    return;
  }

  let input = this.extraInfo;
  input.classList.remove('active');
  input.lastChild.nodeValue = parseInt(input.lastChild.nodeValue) - 1;
  input.lastChild.nodeValue = "\n" + input.lastChild.nodeValue + "\n";
}

function sendCreateResponseRequest(event) {
  let id_question = this.querySelector('#id_question').value;
  let response_text = this.querySelector('#response_text').value;

  if (response_text != '')
    sendAjaxRequest('POST', '/api/questions/' + id_question + '/answers', { description: response_text }, responseAddedHandler, event.target);

  event.preventDefault();
}

function sendCreateCommentRequest(event) {

  let id_publication = this.dataset.publicationId;
  let comment_text = this.querySelector('input[name=comment_text]').value;

  console.log(id_publication)

  if (comment_text != '')
    sendAjaxRequest('POST', '/api/publications/' + id_publication + '/comments', { description: comment_text }, commentAddedHandler, event.target);

  event.preventDefault();

}

function sendReport(event) {

  console.log("AQUIreport");


  let id_publication = this.dataset.publicationId;
  let motive = event.target.querySelector('input:checked').value;

  sendAjaxRequest('POST', '/api/publications/' + id_publication + '/report', { motive: motive }, reportAddedHandler, event.target);

  event.preventDefault();
}

function sendDeletePublication(event) {

  let id_publication = this.dataset.publicationId;

  sendAjaxRequest('POST', '/api/publications/' + id_publication + '/delete', {}, publicationDeletedHandler, event.target);

  event.preventDefault();
}

function responseAddedHandler() {

  console.log(this);

  if (this.status == 403) {

    createErrorMessage("You need to login before you answer!", this.extraInfo);

    return;
  }

  if (this.status != 200) {

    createErrorMessage("Not able to create a answer!", this.extraInfo);
    return;
  }

  deletingPreviousErrorMessage(this.extraInfo);
  let info = JSON.parse(this.response);

  let new_response = createResponse(info.publication, info.person, info.photo);

  let response_section = document.querySelector('#response_section');
  let textarea = document.querySelector('#response_text');
  textarea.value = "";

  response_section.appendChild(new_response);

  //Add event listener to response comment section form
  let commentCreator = document.querySelector('#commentSection' + info.publication.id + " form");
  commentCreator.addEventListener('submit', sendCreateCommentRequest);
  console.log(commentCreator);


  let number_anwers = document.querySelector('#number_answers');
  number_anwers.innerHTML = parseInt(number_anwers.innerHTML) + 1;

  let likeButton = response_section.querySelector("#like" + info.publication.id);
  likeButton.addEventListener('click', sendLikeRequest);

  let dislikeButton = response_section.querySelector("#dislike" + info.publication.id);
  dislikeButton.addEventListener('click', sendDislikeRequest);

  let favoriteButton = response_section.querySelector("#favorite" + info.publication.id);
  favoriteButton.addEventListener('click', sendFavoriteRequest);


}

function publicationDeletedHandler() {

  console.log(this);

  if (this.status != 200) {

    createErrorMessage("Not able to delete the publication!", this.extraInfo.querySelector('.content'));
    return;
  }

  createSucessMessage("Publication was deleted with sucess", document.querySelector('#content div div'));
  this.extraInfo.querySelector(".dismiss").click();
}

function reportAddedHandler() {

  console.log(this);


  if (this.status == 403) {

    createErrorMessage("You need to login before you report a publication!", this.extraInfo.querySelector('.content'));

    return;
  }

  if (this.status != 200) {

    createErrorMessage("Not able to create the report!", this.extraInfo.querySelector('.content'));
    return;
  }

  createSucessMessage("Publication was reported with success", document.querySelector('#content div div'));
  this.extraInfo.querySelector(".dismiss").click();

}

function commentAddedHandler() {


  console.log(this);


  if (this.status == 403) {

    createErrorMessage("You need to login before you comment!", this.extraInfo);

    return;
  }

  if (this.status != 200) {

    createErrorMessage("Not able to create a comment!", this.extraInfo);
    return;
  }


  deletingPreviousErrorMessage(this.extraInfo);
  let info = JSON.parse(this.response);

  let new_comment = createComment(info.publication, info.person, info.photo);

  let form = document.querySelector('form[name=comment-box' + info.comment.id_commentable_publication + ']');
  form.value = "";

  let comment_section = form.parentElement;
  comment_section.insertBefore(new_comment, form);

}

function createComment(publication, person, photo) {

  let link_image = (photo != null) ? 'storage/app/' + photo.url : "https://i.stack.imgur.com/l60Hf.png";

  let new_comment = document.createElement('div');
  new_comment.className = "p-2"
  new_comment.innerHTML = `
    <img src="` + link_image + `" class="img-comment mr-2 mt-1" alt="profilePictureUser">
    <div class="card comment-section">
        <div class="p-1 d-flex justify-content-between">
            <div>
                <p class="font-weight-bold d-inline">` + person.name + `</p>
                <p class="d-inline">` + publication.description + `</p>
            </div>
            <div class="info row justify-content-end align-items-center mx-0" data-publication-id="` + publication.id + `">
                <div class="dropdown">
                    <button class="btn px-1 py-0 ml-2" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">

                            <a class="dropdown-item" href="/comment/` + publication.id + `/edit">Editar</a>
                            <a class="dropdown-item" data-toggle="modal" data-target="#deletingPublicationPopUp`+ publication.id + `">Eliminar</a>
                            <div class="dropdown-divider"></div>

                        <a class="dropdown-item" data-toggle="modal" data-target="#popUpReport`+ publication.id + `">Reportar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>`;

  return new_comment;
}

function createResponse(publication, person, photo) {

  let link_image = (photo != null) ? 'storage/app/' + photo.url : "https://i.stack.imgur.com/l60Hf.png";

  let header_ativity = `
  <div class="header-card mb-3">
  <img src="`+ link_image + `" class="img_inside mr-2" alt="profilePictureUser">
    <div class="header-text">
      <p class="name-and-action font-weight-bold d-inline">`+ person.name + `</p><br>
      <p><small>` + publication.date + `</small></p>
    </div>
  </div>`;

  let like_buttons =
    `<div class="like-buttons ml-4 btn-group btn-group-toggle" data-toggle="buttons" data-publication-id="` + publication.id + `">
    <label class="btn btn-secondary px-1 py-0 like" id="like` + publication.id + `">
        <input type="radio" name="options">
        <i class="far fa-thumbs-up"></i>
        0
    </label>
    <label class="btn btn-secondary px-1 py-0 ml-2 dislike" id="dislike` + publication.id + `">
        <input type="radio" name="options">
        <i class="far fa-thumbs-down d-inline"></i>
        0
    </label>
</div>`;


  let info_content = `
  <button class="btn px-2 py-0 comment-button" type="button" data-toggle="collapse" data-target="#commentSection`+ publication.id + `" aria-controls="commentSection` + publication.id + `" aria-expanded="false" toggle="" data-placement="bottom" title="Deixe o seu comentário" aria-expanded="false" >
          <i class="far fa-comment"></i>
          <label style="margin-bottom: 0px" class="pl-1">Comentar</label>
        </button>`

    + like_buttons +

    `<div class="save-button ml-4 btn-group btn-group-toggle" data-toggle="buttons" data-publication-id="` + publication.id + ` ">
    <label class="btn btn-secondary px-1 py-0 favorite" id="favorite` + publication.id + `" toggle="" data-placement="bottom" title="Guardar" >
        <i class="far fa-star"></i>
        <input type="checkbox" name="save" id="save" autocomplete="off" >
    </label>
    </div>

        <div class="dropdown">
          <button class="btn px-1 py-0 ml-2" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-h"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="/response/`+ publication.id + `/edit">Editar</a>
            <a class="dropdown-item" data-toggle="modal" data-target="#deletingPublicationPopUp`+ publication.id + `">Eliminar</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" data-toggle="modal" data-target="#popUpReport`+ publication.id + `">Reportar</a>
          </div>
        </div>`;

  let new_response = document.createElement('div');
  new_response.className = "p-2"
  new_response.innerHTML = `
  <div class="py-2">
          ` + header_ativity +
    `<p class="card-text">` + publication.description + `</p>
          <div class="info row justify-content-end mx-0">`
    + info_content +
    `     </div>
        </div>

        <div class="commentSection collapse" id="commentSection`+ publication.id + `">
          <div class="comment-block border-top pl-3 pt-2 pb-3">

            <form class="form-inline comment-box mt-3" name="comment-box`+ publication.id + `" data-publication-id="` + publication.id + `">
              <input type="hidden" name="id_publication" value="`+ publication.id + `">
                <img src="`+ link_image + `" class="img-comment mr-2 mt-1" alt="profilePictureUser">
                  <input class="form-control flex-fill" name="comment_text" required="" type="text"></input>
                  <button type="submit" class="btn btn-primary ml-1">Comentar</button>
    </form>
  </div>
</div>

            <hr class="section-break" />`;

  return new_response;
}

function deletingPreviousErrorMessage(parent) {
  var paras = parent.querySelector('.alert.alert-danger');

  if (paras)
    paras.remove();

}

function createErrorMessage(message, parent) {

  console.log(parent);
  deletingPreviousErrorMessage(parent);

  let error_message = document.createElement('div');
  error_message.className = "alert alert-danger mt-2 py-1";
  error_message.role = "alert";
  error_message.innerHTML = message;

  parent.parentElement.insertBefore(error_message, parent);
}

function createSucessMessage(message, parent) {

  console.log(parent);

  let sucess_message = document.createElement('div');
  sucess_message.className = "alert alert-success mt-2 py-1";
  sucess_message.role = "alert";
  sucess_message.innerHTML = message;

  parent.parentElement.insertBefore(sucess_message, parent);
}


addEventListeners();