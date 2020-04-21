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

function sendAjaxRequest(method, url, data, handler) {
  let request = new XMLHttpRequest();

  request.open(method, url, true);
  request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.addEventListener('load', handler);
  request.send(encodeForAjax(data));
}

function sendCreateResponseRequest(event) {
  let id_question = this.querySelector('#id_question').value;
  let response_text = this.querySelector('#response_text').value;

  if (response_text != '')
    sendAjaxRequest('POST', '/api/answers', { id_question: id_question, response_text: response_text }, responseAddedHandler);

  event.preventDefault();
  event.target.reset();
}

function sendCreateCommentRequest(event) {
  let id_publication = this.querySelector('input[name=id_publication]').value;
  let comment_text = this.querySelector('input[name=comment_text]').value;

  if (comment_text != '')
    sendAjaxRequest('POST', '/api/comments', { id_publication: id_publication, comment_text: comment_text }, commentAddedHandler);

  event.preventDefault();
  event.target.reset();
}

function responseAddedHandler() {

  if (this.status != 200) {
    //TODO: show error message to user
    console.log(this);
    return;
  }

  let info = JSON.parse(this.response);

  let new_response = createResponse(info.comment, info.publication, info.person, info.photo);

  let response_section = form.querySelector('#response_section');
  response_section.appendChild(new_response);


}

function commentAddedHandler() {

  if (this.status != 200) {
    //TODO: show error message to user
    console.log(this);
    return;
  }

  let info = JSON.parse(this.response);

  let new_comment = createComment(info.publication, info.person, info.photo);

  let form = document.querySelector('form[name=comment-box' + info.comment.id_commentable_publication + ']');

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

  /*
  let link_image = (photo != null) ? photo.url : "https://i.stack.imgur.com/l60Hf.png";

  let new_response = document.createElement('div');
  new_response.className = "p-2"
  new_response.innerHTML = `
  <div class="py-2">
    @include('partials.header_activity', ['name' => $owner->name, "link_profile" => $link_image, 'action' => "", 'actionInBold' => "", "date" => $publication->date])    
    <p class="card-text"> {{ $publication->description }}</p>
    <div class="info row justify-content-end mx-0">
        @include('partials.info_content', ['commentable_publication' => $answer->commentable_publication ])
    </div>  
  </div>

  <div class="commentSection collapse" id=<?="commentSection".$answer->id_commentable_publication?>>
      @include('partials.comment_section', ['comments' => $answer->commentable_publication->comments, 'id_publication' => $answer->id_commentable_publication])
  </div>

  <hr class="section-break" />`;
*/
  return new_response;
}


addEventListeners();
