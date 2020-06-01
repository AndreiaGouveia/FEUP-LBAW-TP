let formArray = document.querySelectorAll('form');
for (form of formArray) {
    form.addEventListener('submit', sendCreateCommentRequest);
}

function sendCreateCommentRequest(event) {

    let  textAreaArray = this.querySelectorAll('textarea');

    for (textArea of textAreaArray) {
        textArea.value = DOMPurify.sanitize(textArea.value);
    }

}