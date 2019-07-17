<?php
namespace app\Models;

class Users
{
    public function getUsers(){
        $data = [
            'perpage'=>5,
            'total'=>1000,
            'msg'=>'OK',
            'data' => [
                [
                    'id' => 1,
                    'username' => '刘利杰',
                    'sex' => '男',
                    'age' => '29',
                    'phone' => '15569632585',
                    'email' => '15569632585@10010.com'
                ],
                [
                    'id' => 2,
                    'username' => '刘利杰',
                    'sex' => '男',
                    'age' => '29',
                    'phone' => '15569632585',
                    'email' => '15569632585@10010.com'
                ],
                [
                    'id' => 3,
                    'username' => '刘利杰',
                    'sex' => '男',
                    'age' => '29',
                    'phone' => '15569632585',
                    'email' => '15569632585@10010.com'
                ],
            ],
        ];
        return $data;
    }
}
