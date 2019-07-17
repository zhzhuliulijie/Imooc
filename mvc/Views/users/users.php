<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>首页</title>
</head>
<body>
<h2>用户信息</h2>
<table width="1000">
    <thead>
    <tr>
        <th>id</th>
        <th>name</th>
        <th>age</th>
        <th>sex</th>
        <th>phone</th>
        <th>email</th>
    </tr>
    </thead>
    <tbody>
        {foreach $result.data as $k => $v}
        <tr align="center">
            <td>{$v.id}</td>
            <td>{$v.username}</td>
            <td>{$v.age}</td>
            <td>{$v.sex}</td>
            <td>{$v.phone}</td>
            <td>{$v.email}</td>
        </tr>
        {/foreach}
    </tbody>
</table>
</body>
</html>
