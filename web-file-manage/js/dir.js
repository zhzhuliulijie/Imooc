//创建目录
$("#createDir").on('click', function () {
    let path = $(this).attr('data-url');
    layer.prompt({
        formType: 0,
        title: '新建文件夹'
    }, function(value, index){
        $.ajax({
            url: path + '&dirName=' + value,
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

//重命名目录
$(".renameDir").on('click', function () {
    let url = $(this).attr("data-url");
    let showName = $(this).attr("data-showname");
    layer.prompt({
        formType: 0,
        value: showName,
        title: '重命名文件夹'
    }, function(value, index){
        if (value == showName){
            layer.alert("目录名称没有修改", {icon: 2});
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
$(".cutDir").on('click', function () {
    let url = $(this).attr("data-url");
    let filedir = $(this).attr("data-filedir");
    let fileName = $(this).attr("data-filename");
    layer.prompt({
        formType: 2,
        value: filedir,
        title: '剪切目录到',
        area: ['600px', '150px'] //自定义文本域宽高
    }, function(value, index){
        if (value == filedir){
            layer.alert("不能剪切到原目录", {icon: 2});
            return;
        }
        if (value == fileName){
            layer.alert("不能剪切到目录本身", {icon: 2});
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

//复制目录
$(".copyDir").on('click', function () {
    let url = $(this).attr("data-url");
    let filedir = $(this).attr("data-filedir");
    let fileName = $(this).attr("data-filename");
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
        if (value == fileName){
            layer.alert("不能复制到目录本身", {icon: 2});
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

// 删除目录
$(".delDir").on('click', function () {
    let url = $(this).attr("data-url");
    let fileName = $(this).attr("data-filename");
    // alert(fileName);
    layer.confirm('请问您确定要删除 ' + fileName + ' 目录吗？', {
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
        layer.msg('已经取消删除 ' + fileName + ' 目录', {icon: 1});
    });
});















