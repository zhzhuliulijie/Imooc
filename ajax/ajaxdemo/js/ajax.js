let $ = new class {
    constructor() {
        this.xhr = new XMLHttpRequest();
        this.xhr.onreadystatechange = () => {
            if (this.xhr.readyState == 4 && this.xhr.status == 200){
                let response = this.xhr.responseText;
                if (this.type == 'json'){
                    response = JSON.parse(response);
                }
                this.callback(response);
            }
        }
    }

    get(url, parameters, callback, type = 'text') {
        let data = this.parseParameters(parameters);
        if (data.length > 0) {
            url += '?' + data;
        }
        this.type = type;
        this.callback = callback;
        this.xhr.open('get', url, true);
        this.xhr.send();
    }

    post(url, parameters, callback, type = 'text') {
        let data = this.parseParameters(parameters);
        this.type = type;
        this.callback = callback
        ;
        this.xhr.open('get', url, true);
        this.xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        this.xhr.send(data);
    }

    parseParameters(parameters) {
        let buildStr = "";
        for (let key in parameters) {
            let str = key + '=' + parameters[key];
            buildStr += str + '&';
        }
        return buildStr.substring(0, buildStr.length - 1);
    }
}
