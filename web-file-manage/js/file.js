//新建文件
$(".createFile").on('click', function () {
    let path = $(this).attr('data-url');
    layer.prompt({
        formType: 0,
        title: '新建文件'
    }, function(value, index){
        $.ajax({
            url: path + '&file=' + value,
            type: 'get',
            success: function (data) {
                data = JSON.parse(data);
                layer.alert(data.msg, {icon: data.icon}, function () {
                    location.reload();
                });
            }
        });
        layer.close(index);
    });
});

//查看文件
$(".checkFile").on('click', function () {
    let url = $(this).attr('data-url');
    $.ajax({
        url: url,
        type: 'get',
        success: function (data) {
            // console.log(data);
            let index = layer.open({
                type: 1,
                title: '文件：users.php',
                closeBtn: 1,
                shadeClose: true,
                content: data
            });
            layer.full(index);
        }
    })
});

//编辑文件
$('.editFile').on('click', function () {
    let url = $(this).attr('data-url');
    let saveUrl = $(this).attr('data-save');
    $.ajax({
        url: url,
        type: 'get',
        success: function (data) {
            layer.prompt({
                formType: 2,
                value: data,
                title: '编辑文件',
                area: ['960px', '450px'] //自定义文本域宽高
            }, function(value, index){
                $.ajax({
                    url: saveUrl,
                    type: 'post',
                    data: {
                        fileContent: value
                    },
                    success: function (data) {
                        data = JSON.parse(data);
                        layer.alert(data.msg, {icon: data.icon}, function () {
                            location.reload();
                        });
                    }
                });
                layer.close(index);
            });
        }
    });
});

//下载文件
$('.downFile').on('click', function () {
    let url = $(this).attr('data-url');
    window.open(url);
});


//重命名文件
$(".renameFile").on('click', function () {
    let url = $(this).attr("data-url");
    let showName = $(this).attr("data-showname");
    layer.prompt({
        formType: 0,
        value: showName,
        title: '重命名文件'
    }, function(value, index){
        if (value == showName){
            layer.alert("文件名称没有修改", {icon: 2});
            return;
        }
        $.ajax({
            url: url + '&showName=' + value,
            type: 'get',
            success: function (data) {
                data = JSON.parse(data);
                layer.alert(data.msg, {icon: data.icon}, function () {
                    location.reload();
                });
            }
        });
        layer.close(index);
    });
});

//剪切目录
$(".cutFile").on('click', function () {
    let url = $(this).attr("data-url");
    let filedir = $(this).attr("data-filedir");
    layer.prompt({
        formType: 2,
        value: filedir,
        title: '剪切文件到',
        area: ['600px', '150px'] //自定义文本域宽高
    }, function(value, index){
        if (value == filedir){
            layer.alert("不能剪切到原目录", {icon: 2});
            return;
        }
        $.ajax({
            url: url + '&newfileName=' + value,
            type: 'get',
            success: function (data) {
                // console.log(data);
                data = JSON.parse(data);
                layer.alert(data.msg, {icon: data.icon}, function () {
                    location.reload();
                });
            }
        });
        layer.close(index);
    });
});


//复制文件
$(".copyFile").on('click', function () {
    let url = $(this).attr("data-url");
    let filedir = $(this).attr("data-filedir");
    layer.prompt({
        formType: 2,
        value: filedir,
        title: '复制文件夹到',
        area: ['600px', '150px'] //自定义文本域宽高
    }, function(value, index){
        if (value == filedir){
            layer.alert("不能复制到原目录", {icon: 2});
            return;
        }
        $.ajax({
            url: url + '&newfileName=' + value,
            type: 'get',
            success: function (data) {
                data = JSON.parse(data);
                layer.alert(data.msg, {icon: data.icon}, function () {
                    location.reload();
                });
            }
        });
        layer.close(index);
    });
});

// 删除文件
$(".delFile").on('click', function () {
    let url = $(this).attr("data-url");
    let fileName = $(this).attr("data-filename");
    // alert(fileName);
    layer.confirm('请问您确定要删除 ' + fileName + ' 文件吗？', {
        btn: ['确定删除','额...,再想想'] //按钮
    }, function(){
        $.ajax({
            url: url,
            type: 'get',
            success: function (data) {
                data = JSON.parse(data);
                layer.msg(data.msg, {
                    icon: 1,
                    time: 2000 //2秒关闭（如果不配置，默认是3秒）
                }, function(){
                    location.reload();
                });
            }
        });
    }, function(){
        layer.msg('已经取消删除 ' + fileName + ' 文件', {icon: 1});
    });
});





