<?php
/**
 * Created by PhpStorm.
 * User: yaoyao
 * Date: 2017/11/8
 * Time: 10:36
 */

namespace App\Services;

use App\Models\Base\BaseCecUser;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrcodeService
{
    public function createUserShareQrcode($uid)
    {
        $language = Session::get('language', 'zh-CN');
        $share_name  = "share_$language"."_"."$uid.jpg";
        $share_bg_name = "sharebg_$language.jpg";
        $exists = Storage::disk('public')->exists("qrcodes/".$share_name);
        if(!$exists){
            $url  = asset('cec/register?invite_uid='.$uid);
            QrCode::format('png')
                ->size(500)->margin(2)
                ->generate($url, storage_path('app/public/qrcodes/'). $share_name);
            $small_img_path = storage_path('app/public/qrcodes/'). $share_name;
            $img = Image::make(storage_path('app/public/').$share_bg_name);
            $img->insert($small_img_path, 'bottom-right',375,265);
            $img->save(storage_path('app/public/qrcodes/').$share_name);
        }
        return asset("storage/qrcodes/$share_name");
//        return Storage::url("qrcodes/share_$uid.jpg");
    }
    public function createWallertQrcode($wallet,$num)
    {
        $share_name  = "$wallet.jpg";
//        Storage::disk('public')->makeDirectory('fff');
        $exists = Storage::disk('public')->exists("wallet/".$share_name);
        if(!$exists){
            $url  = $wallet;
            QrCode::format('png')
                ->size(500)->margin(2)
                ->generate($url, storage_path('app/public/wallet/'). $share_name);
            }
        return asset("storage/wallet/$share_name");
    }
    public function createUserShareQrcode3($uid, $url)
    {
        $qrfilename = $uid . ".png";
        QrCode::format('png')
            ->size(500)->margin(2)
//            ->merge('/public/qrcodes/logo.jpg',.15)
            ->generate($url, public_path('qrcodes/' . $qrfilename));
        $info = BaseCecUser::find($uid);

        //合并图片
        $small_img_path = env('APP_URL') . '/qrcodes/' . $qrfilename;
        $big_img_path = env('APP_URL') . "/qrcodes/sharebg.jpg";

        //创建图片的实例
        $small_img = imagecreatefromstring(file_get_contents($small_img_path));
        $big_img = imagecreatefromstring(file_get_contents($big_img_path));
        $imgWidth = imagesx($big_img);
        //获取水印图片的宽高
        list($src_w, $src_h) = getimagesize($small_img_path);
        $x = ceil(($imgWidth - $src_w) / 2);
        //将水印图片复制到目标图片上，最后个参数100是设置透明度，这里实现半透明效果
        imagecopymerge($big_img, $small_img, $x, 1480, 0, 0, $src_w, $src_h, 100);
        imagepng($big_img, "./qrcodes/qrcode_" . $uid . ".png");
        imagedestroy($small_img);
        imagedestroy($big_img);
        return "/qrcodes/qrcode_" . $uid . ".png";
    }

    public function createUserShareQrcode2($uid, $url)
    {
        $qrfilename = $uid . ".png";
        QrCode::format('png')
            ->size(500)->margin(2)
            ->merge('/public/qrcodes/logo.jpg', .15)
            ->generate($url, public_path('qrcodes/' . $qrfilename));

        $info = BaseCecUser::find($uid);
        $shopname = html_entity_decode($info->login_name);
        //背景图 添加公司名称
        $file = env('APP_URL') . "/qrcodes/sharebg.jpg";
        $image = imagecreatefromjpeg($file); // 调用方法处理
        $font = "./qrcodes/fonts/simhei.ttf";
        $fontSize = mb_strlen($shopname) > 10 ? 38 : 60;
        $fontColor = imagecolorallocate($image, 0, 0, 0); // 文字颜色

        $pos = imagettfbbox($fontSize, 0, $font, $shopname);
        $textWidth = $pos[2] - $pos[0];

        $imgWidth = imagesx($image);
        $textXposition = ceil(($imgWidth - $textWidth) / 2);
        imagettftext($image, $fontSize, 0, $textXposition, 1420, $fontColor, $font, $shopname); // 创建文字

        imagepng($image, './qrcodes/qrcode_' . $uid . '.png');
        imagedestroy($image);

        //合并图片
        $small_img_path = env('APP_URL') . '/qrcodes/' . $qrfilename;
        $big_img_path = env('APP_URL') . '/qrcodes/qrcode_' . $uid . '.png';

        //创建图片的实例
        $small_img = imagecreatefromstring(file_get_contents($small_img_path));
        $big_img = imagecreatefromstring(file_get_contents($big_img_path));
        //获取水印图片的宽高
        list($src_w, $src_h) = getimagesize($small_img_path);

        $x = ceil(($imgWidth - $src_w) / 2);
        //将水印图片复制到目标图片上，最后个参数100是设置透明度，这里实现半透明效果
        imagecopymerge($big_img, $small_img, $x, 1480, 0, 0, $src_w, $src_h, 100);

        imagepng($big_img, "./qrcodes/qrcode_" . $uid . ".png");
        imagedestroy($small_img);
        imagedestroy($big_img);

        return "/qrcodes/qrcode_" . $uid . ".png";
    }


    /**
     * 生成门店添加员工二维码
     * @param $shopid
     * @param string $type
     * @return string
     * @author chenyan
     */
    public function getQrcode($shopid, $type = 'manager')
    {
        header('Content-Type:image/png');
        $info = SpShop::find($shopid);
        if ($type == 'manager') {
            //门店二维码 添加店长
            $url = env('APP_URL') . "/sport/employee/add/manager/" . $shopid;
            $qrfilename = "shop_qrcode_" . $shopid . '.png';
            $shopname = html_entity_decode($info->sname . "添加管理员");
        } else if ($type == 'employee') {
            //门店店长二维码  添加员工
            $url = env('APP_URL') . "/sport/employee/add/employee/" . $shopid;
            $qrfilename = "shop_qrcode_" . $shopid . '_manager.png';
            $shopname = html_entity_decode($info->sname . "添加员工");
        }

        QrCode::format('png')->size(800)->margin(6)->generate($url, public_path('qrcodes/' . $qrfilename));

        //添加公司名称
        $file = env('APP_URL') . "/qrcodes/" . $qrfilename;
        $image = imagecreatefrompng($file); // 调用方法处理
        $font = "./qrcodes/fonts/simhei.ttf";
        $fontSize = mb_strlen($shopname) > 10 ? 38 : 50;
        $fontColor = imagecolorallocate($image, 0, 0, 0); // 文字颜色

        $pos = imagettfbbox($fontSize, 0, $font, $shopname);
        $textWidth = $pos[2] - $pos[0];

        $imgWidth = imagesx($image);
        $textXposition = ceil(($imgWidth - $textWidth) / 2);
        imagettftext($image, $fontSize, 0, $textXposition, 100, $fontColor, $font, $shopname); // 创建文字
        imagepng($image, './qrcodes/' . $qrfilename);
        imagedestroy($image);

        return '/qrcodes/' . $qrfilename;
    }
}