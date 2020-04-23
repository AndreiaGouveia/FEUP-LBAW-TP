function addEventListeners() {

  let responseCreator = document.querySelector('#response_form');
  if (responseCreator != null)
    responseCreator.addEventListener('submit', sendCreateResponseRequest);

  let commentCreatorArray = document.querySelectorAll('form.comment-box');
  for (commentCreator of commentCreatorArray) {
    commentCreator.addEventListener('submit', sendCreateCommentRequest);
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

function sendCreateResponseRequest(event) {
  let id_question = this.querySelector('#id_question').value;
  let response_text = this.querySelector('#response_text').value;

  if (response_text != '')
    sendAjaxRequest('POST', '/api/answers', { id_question: id_question, response_text: response_text }, responseAddedHandler, event.target);

  event.preventDefault();
}

function sendCreateCommentRequest(event) {
  let id_publication = this.querySelector('input[name=id_publication]').value;
  let comment_text = this.querySelector('input[name=comment_text]').value;

  if (comment_text != '')
    sendAjaxRequest('POST', '/api/comments', { id_publication: id_publication, comment_text: comment_text }, commentAddedHandler, event.target);

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
  let commentCreator = document.querySelector('#commentSection' + info.publication.id);
  commentCreator.addEventListener('submit', sendCreateCommentRequest);


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

  let link_image = (photo != null) ? photo.url : "https://i.stack.imgur.com/l60Hf.png";

  let new_comment = document.createElement('div');
  new_comment.className = "p-2"
  new_comment.innerHTML = `
    <img src="` + link_image + `" class="img-comment mr-2 mt-1" alt="">
    <div class="card comment-section">
        <div class="p-1">
            <p class="font-weight-bold d-inline">` + person.name + `</p>
            <p class="d-inline">` + publication.description + `</p>
        </div>
    </div>`;

  return new_comment;
}

function createResponse(publication, person, photo) {


  let link_image = (photo != null) ? photo.url : "https://i.stack.imgur.com/l60Hf.png";

  let header_ativity = `
  <div id="header-card mb-3">
  <img src="`+ link_image + `" class="img_inside mr-2" alt="">
    <div class="header-text">
      <p class="name-and-action font-weight-bold d-inline">`+ person.name + `</p><br>
      <p><small>` + publication.date + `</small></p>
    </div>
  </div>`;

  let like_buttons =
    `<div class="like-buttons ml-4">
    <button type="radio" class="btn px-1 py-0" toggle="" data-placement="bottom" title="Eu gosto disto">
        <i class="far fa-thumbs-up"></i>
        <label style="margin-bottom: 0px">0</label>
    </button>

    <button type="radio" class="btn px-1 py-0 ml-2" toggle="" data-placement="bottom" title="Eu não gosto disto">
        <i class="far fa-thumbs-down d-inline"></i>
        <label style="margin-bottom: 0px" class="d-inline">0</label>
    </button>
  </div>`;


  let info_content = `
  <button class="btn px-2 py-0 comment-button" type="button" data-toggle="collapse" data-target="#commentSection`+ publication.id + `" aria-controls="commentSection` + publication.id + `" aria-expanded="false" toggle="" data-placement="bottom" title="Deixe o seu comentário" aria-expanded="false" >
    <i class="far fa-comment"></i>
    <label style="margin-bottom: 0px" class="pl-1">Comentar</label>
  </button>`

    + like_buttons +

    `<div class="save-button ml-4">
    <button class="btn px-1 py-0" toggle="" data-placement="bottom" title="Guardar">
        <i class="far fa-star"></i>
    </button>
  </div>

  <div class="dropdown">
    <button class="btn px-1 py-0 ml-2" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-h"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="#">Editar</a>
        <a class="dropdown-item" href="#">Eliminar</a>
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
    `</div>  
  </div>

  <div class="commentSection collapse" id="commentSection`+ publication.id + `">
    <div class="comment-block border-top pl-3 pt-2 pb-3">
  
    <form class="form-inline comment-box mt-3" name="comment-box`+ publication.id + `">
      <input type="hidden" name="id_publication" value="`+ publication.id + `">
      <img src="`+ link_image + `" class="img-comment mr-2 mt-1" alt="">
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

function createErrorMessage(message, parent, prepend) {

  deletingPreviousErrorMessage(parent);

  let error_message = document.createElement('div');
  error_message.className = "alert alert-danger mt-2 py-1";
  error_message.role = "alert";
  error_message.innerHTML = message;

  if(prepend)
    parent.prepend(error_message);
  else
    parent.parentElement.insertBefore(error_message, parent);
}


addEventListeners();

let response_text = document.querySelector('#response_text');

if (response_text) {
  response_text.value = window.localStorage.getItem("response_text");
}