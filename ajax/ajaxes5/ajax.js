// Get / Post
// 参数 get post
// 是否异步
// 如何处理响应数据
// URL

// var handleResponse = function(response) {
//
// }
// ajax.get('demo1.php', 'name=zhangsan&age=20', handleResponse, true)
// ajax.post('demo1.php', 'name=zhangsan&age=20', handleResponse, true)
function Ajax() {

    //初始化方法
    this.init = function () {
        this.xhr = new XMLHttpRequest();
    }

    //get方法
    this.get = function (url, parameters, callback, async = true) {

        this.init();
        if (async) {

            //异步请求
            this.xhr.onreadystatechange = function () {
                // this => this.xhr
                if (this.readyState == 4 && this.status == 200){
                    callback(this.responseText);
                }
            }
        }
        this.xhr.open('GET', url + '?' + parameters, async);
        this.xhr.send();
    }

    //post方法
    this.post = function (url, parameters, callback, async = true) {

        this.init();
        if (async){

            //异步请求
            this.xhr.onreadystatechange = function () {
                //this => this.xhr
                if (this.readyState == 4 && this.status == 200){
                    callback(this.responseText);
                }
            }
        }
        this.xhr.open('POST', url, async);
        this.xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        this.xhr.send(parameters);
    }
}

var ajax = new Ajax();
