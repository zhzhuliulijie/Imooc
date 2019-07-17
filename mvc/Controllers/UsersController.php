<?php
namespace app\Controllers;

use app\Models\Users;
use Smarty;

class UsersController extends Smarty
{
    public function index(){
        $users = new Users();
        $result = $users -> getUsers();
        $this->setTemplateDir(dirname(__DIR__) . '/Views/');
        $this->setCompileDir(dirname(__DIR__) . '/runtime/compile');
//        $this->left_delimiter = "{";
//        $this->right_delimiter = "}";
//        require dirname(__DIR__) . '/Views/users/users.php';
        $this->assign('result', $result);
        $this->display('users/users.php');
    }
}
