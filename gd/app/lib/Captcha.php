<?php

namespace app\lib;

require_once 'GDBasic.php';


class Captcha extends GDBasic
{
    // 图像宽度
    protected $_width = 60;
    // 图像高度
    protected $_height = 25;

    //随机字符串
    protected $_code = 'ABCDEFGHJKLMNPQRSTUVWXY3456789abcdefghijkmnpqrstuvwxy';

    //字体文件
    protected $_fontFile = __DIR__ . "/fonts/comicz.ttf";

    //图像
    protected $_image;
    //验证码
    protected $_captcha;

    public function __construct($width = null, $height = null)
    {
        self::check();
        $this->create($width, $height);
    }

    /*
     * 船舰图像
     * @param   $width
     * @param   $height
     * */
    public function create($width, $height)
    {
        $this->_width = is_numeric($width) ? $width : $this->_width;
        $this->_height = is_numeric($height) ? $height : $this->_height;
        //创建图像
        $img = imagecreatetruecolor($this->_width, $this->_height);
        $back = imagecolorallocate($img, mt_rand(200, 255), mt_rand(200, 255), mt_rand(200, 255));
        //填充底色
        imagefill($img, 0, 0, $back);

        $this->_image = $img;
    }

    /*
     * 混乱验证码
     * */
    public function moll()
    {
        $back = imagecolorallocate($this->_image, 0, 0, 0);
        //在图像中生成50个点
        for ($i = 0; $i < 50; $i++) {
            imagesetpixel($this->_image, mt_rand(0, $this->_width), mt_rand(0, $this->_height),$back);
        }

        //在图像中随机生成线条
        for ($i = 0; $i < 5; $i++) {
            imageline($this->_image, mt_rand(0, $this->_width), mt_rand(0, $this->_height), mt_rand(0, $this->_width), mt_rand(0, $this->_height), $back);
        }
    }

    /*
     * 生成随机字符串
     * @param int   $length 验证码的长度
     * @param int   $fontSize 字符串的字体大小
     * @return Captcha
     * */
    public function string($length = 4, $fontSize = 15)
    {
        $this->moll();
        $code = $this->_code;
        $captcha = '';
        for ($i = 0; $i < $length; $i++) {
            $string = $code[mt_rand(0, strlen($code) - 1)];
            $strColor = imagecolorallocate($this->_image, mt_rand(100, 150), mt_rand(100, 150), mt_rand(100, 150));
            imagettftext($this->_image, $fontSize, mt_rand(-10, 10), mt_rand(3, 6) + $i * (($this->_width - 10) / $length), ($this->_height / 3) * 2, $strColor, $this->_fontFile, $string);
            $captcha .= $string;
        }

        $this->_captcha = $captcha;
        return $this;
    }

    /*
     * 验证码催乳session
     * */
    public function setSession()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['captcha_code'] = $this->_captcha;
    }

    /*
     * 逻辑运算符验证码
     * @param int   $fontSize 字体大小
     * @return $this
     * */
    public function logic($fontSize = 12)
    {
        $this->moll();
        $codeArray = array(1 => 1, 2, 3, 4, 5, 6, 7, 8, 9);
        $operatorArray = array('+' => '+', '-' => '-', 'x' => '*',);
        list($first, $second) = array_rand($codeArray, 2);
        $operator = array_rand($operatorArray);
        $captcha = 0;
        $string = '';
        switch ($operator) {
            case '+':
                $captcha = $first + $second;
                break;
            case '-':
                if ($first < $second) {
                    list($first, $second) = array($second, $first);
                }
                $captcha = $first - $second;
                break;
            case 'x':
                $captcha = $first * $second;
                break;
        }
        //设置验证码类变量
        $this->_captcha = $captcha;
        //要输出到图片的字符串
        $string = sprintf('%s%s%s=?', $first, $operator, $second);

        $strColor = imagecolorallocate($this->_image, mt_rand(100, 150), mt_rand(100, 150), mt_rand(100, 150));
        imagettftext($this->_image, $fontSize, 0, 5, ($this->_height / 3) * 2, $strColor, $this->_fontFile, $string);

        return $this;
    }

    /**
     * 输出验证码
     */
    public function show()
    {
        // 生成session
        $this->setSession();
        header("Content-Type: image/jpeg");
        imagejpeg($this->_image);
        imagedestroy($this->_image);
    }

}
