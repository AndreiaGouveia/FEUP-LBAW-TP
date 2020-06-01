let reportStatusArray = document.querySelectorAll('input[type=checkbox]');
for (reportStatus of reportStatusArray) {
    reportStatus.addEventListener('click', changeReportStatus);
}

function changeReportStatus(event) {

    console.log("ola")
    let id_publication = this.dataset.publicationId;

    sendAjaxRequest('POST', '/api/publications/' + id_publication + '/report/resolved', {resolved: this.checked}, changeReportStatusHandler1, event.target);

    event.preventDefault();

}

function sendAjaxRequest(method, url, data, handler, extraInfo) {
    let request = new XMLHttpRequest();

    request.open(method, url, true);
    request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.extraInfo = extraInfo;
    request.addEventListener('load', handler);
    request.send(encodeForAjax(data));


    console.log("ola")
}

function changeReportStatusHandler1() {


    console.log(this);


    if (this.status != 200) {

        console.log("Not able to create a comment!");
        return;
    }



    console.log("ola")
    this.extraInfo.checked = !this.extraInfo.checked;

}