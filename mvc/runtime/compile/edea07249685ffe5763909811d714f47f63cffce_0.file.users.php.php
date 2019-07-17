<?php
/* Smarty version 3.1.33, created on 2019-07-17 08:21:34
  from 'D:\wamp\www\ClassImooc\mvc\Views\users\users.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d2eda8e129b68_27721119',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'edea07249685ffe5763909811d714f47f63cffce' => 
    array (
      0 => 'D:\\wamp\\www\\ClassImooc\\mvc\\Views\\users\\users.php',
      1 => 1563351692,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d2eda8e129b68_27721119 (Smarty_Internal_Template $_smarty_tpl) {
?><!doctype html>
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
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['result']->value['data'], 'v', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
?>
        <tr align="center">
            <td><?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['v']->value['username'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['v']->value['age'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['v']->value['sex'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['v']->value['phone'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['v']->value['email'];?>
</td>
        </tr>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </tbody>
</table>
</body>
</html>
<?php }
}
