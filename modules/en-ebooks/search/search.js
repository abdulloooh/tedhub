function getQueryVar(variable) {
    var query = window.location.search.substring(1);
    var vars = query.split('&');
    for (var i = 0; i < vars.length; i++) {
        vars[i] = vars[i].replace(/\+/g," ");
        var pair = vars[i].split('=');
        if (decodeURIComponent(pair[0]) == variable) {
            return decodeURIComponent(pair[1]);
        }
    }
    console.log('Query variable %s not found', variable);
}

function escapeHtml(str) {
    var div = document.createElement('div');
    div.appendChild(document.createTextNode(str));
    return div.innerHTML;
};

function runSearch () {

    var terms = getQueryVar("terms");

    if (!terms) {
        document.getElementById('description').innerHTML = (
            "<b>0</b> titles containing <b>\"\"</b>"
        );
        return;
    }

    // we do this before escaping, so the user's string
    // in the search box doesn't get turned into escaped text
    document.getElementById('searchbox').value = terms;

    terms = escapeHtml(terms);

    index = lunr.Index.load( raw_index );

    var results = index.search( terms );

    if (results.length == 1) {
        document.getElementById('description').innerHTML = (
            "<b>1</b> title containing <b>\"" + terms + "\"</b>"
        );
    } else {
        document.getElementById('description').innerHTML = (
            "<b>" + results.length + "</b> titles containing <b>\"" + terms + "\"</b>"
        );
    }

    var page = "<ul>";
    for (var i = 0; i < results.length; ++i) {
        var ref = results[i].ref;
        page += "<li><a href=\"books/" + pages[ref].u + "\">";
        page += "<img src=\"img/covers/" + pages[ref].m + "\" alt=\"\">";
        page += "<b>" + pages[ref].t + "</b></a>";
        page += "<small style=\"margin-left: 10px;\">" + pages[ref].a + "</small>";
        page += "<p>" + pages[ref].d + "</p>";
        page += "<div style=\"clear: left;\"></div></li>";
    }
    page += "</ul>";

    document.getElementById('searchresults').innerHTML = page;

}
