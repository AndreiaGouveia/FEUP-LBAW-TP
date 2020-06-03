let formArray = document.querySelectorAll('form');
for (form of formArray) {
    form.addEventListener('submit', sanitizeForm);
}

function sanitizeForm(event) {

    let  textAreaArray = this.querySelectorAll('textarea');

    for (textArea of textAreaArray) {
        textArea.value = DOMPurify.sanitize(textArea.value);
    }

}