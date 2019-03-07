const request = {
    post: function (url, data) {
        return new Promise(function (resolve) {
            let http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.setRequestHeader("Content-type", "application/json");
            http.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    return resolve(JSON.parse(this.responseText));
                }
            };
            http.send(JSON.stringify(data));
        });
    }
};

function showDom(id) {
    let arr;
    if (!Array.isArray(id)) {
        arr = [id];
    } else {
        arr = id;
    }
    arr.forEach(function (domId) {
        document.getElementById(domId).style.display = 'inline';
    });
}

function hideDom(id) {
    let arr;
    if (!Array.isArray(id)) {
        arr = [id];
    } else {
        arr = id;
    }
    arr.forEach(function (domId) {
        document.getElementById(domId).style.display = 'none';
    });
}

function submitForm(url, data) {
    let form = document.createElement('form'),
        input = document.createElement('input');
    input.name = data.key;
    input.value = data.value;
    form.appendChild(input);
    form.style.visibility = 'hidden';
    form.method = 'POST';
    form.action = url;
    document.body.appendChild(form);
    form.submit();
}
