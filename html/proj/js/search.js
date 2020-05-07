function setUpSearch(search_query) {

    let search_input = document.getElementsByName("search");

    for (let searchInputBox of search_input) {

        searchInputBox.value = search_query;
    }

    let search_mobile_button = document.getElementById("searchMobileButton");
    search_mobile_button.click();
}