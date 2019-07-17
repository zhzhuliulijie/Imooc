class Ajax
{
    constructor()
    {
        this.xhr = new XMLHttpRequest();
    }

    get(url, parameters, callback, async = true){
        if (async){
            this.xhr.onreadystatechange = () => {
                if (this.xhr.readyState == 4 && this.xhr.status == 200){
                    callback(this.xhr.responseText);
                }
            }
        }
        this.xhr.open('GET', url + '?' + parameters, async);
        this.xhr.send();
    }

    post(url, parameters, callback, async = true){
        if (async){
            this.xhr.onreadystatechange = () => {
                if (this.xhr.readyState == 4 && this.xhr.status == 200){
                    callback(this.xhr.responseText);
                }
            }
        }
        this.xhr.open('POST', url, async);
        this.xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        this.xhr.send(parameters);
    }
}

let ajax = new Ajax();
