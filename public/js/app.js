function addEventListeners() {

  let responseCreator = document.querySelector('#response_form');
  if (responseCreator != null)
    responseCreator.addEventListener('submit', sendCreateResponseRequest);

  let commentCreator = document.querySelector('form.comment-box');
  if (commentCreator != null)
    commentCreator.addEventListener('submit', sendCreateCommentRequest);
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
    sendAjaxRequest('POST', '/api/comments', { id_publication: id_publication, comment_text: comment_text }, responseAddedHandler);

  event.preventDefault();
  event.target.reset();
}

function responseAddedHandler() {

  console.log(this);
}

addEventListeners();
