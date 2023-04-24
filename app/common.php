<?php
// 应用公共文件

/**
 * 字节数Byte转换为KB、MB、GB、TB
 * @param int $size
 * @return string
 */
function xn_file_size($size)
{
    $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
    for ($i = 0; $size >= 1024 && $i < 5; $i++) {
        $size /= 1024;
    }

    return round($size, 2) . $units[$i];
}

/**
 * 驼峰命名转下划线命名
 * @param $camelCaps
 * @param string $separator
 * @return string
 */
function xn_uncamelize($camelCaps, $separator = '_')
{
    return strtolower(preg_replace('/([a-z])([A-Z])/', "$1" . $separator . "$2", $camelCaps));
}

/**
 * 密码加密函数
 * @param $password
 * @return string
 */
function xn_encrypt($password)
{
    $salt = 'xiaoniu_admin';
    return md5(md5($password . $salt));
}

/**
 * 管理员操作日志
 * @param $remark
 */
function xn_add_admin_log($remark)
{
    $data = [
        'admin_id'    => session('admin_auth.id'),
        'url'         => request()->url(true),
        'ip'          => request()->ip(),
        'remark'      => $remark,
        'method'      => request()->method(),
        'param'       => json_encode(request()->param()),
        'create_time' => time(),
    ];
    \app\common\model\AdminLog::insert($data);
}

/**
 * 管理员操作日志
 * @param $remark
 */
function xn_add_user_log($remark)
{
    $data = [
        'admin_id'    => session('user_auth.id'),
        'url'         => request()->url(true),
        'ip'          => request()->ip(),
        'remark'      => $remark,
        'method'      => request()->method(),
        'param'       => json_encode(request()->param()),
        'create_time' => time(),
    ];
    \app\common\model\AdminLog::insert($data);
}
/**
 * 获取自定义config/cfg目录下的配置
 * 用法： xn_cfg('base') 或 xn_cfg('base.website') 不支持无限极
 * @param string|null $name
 * @param string|null $default
 * @param string|null $path
 * @return array|string
 */
function xn_cfg($name, $default = '', $path = 'cfg')
{
    if (false === strpos($name, '.')) {
        $name   = strtolower($name);
        $config = \think\facade\Config::load($path . '/' . $name, $name);
        return $config ?? [];
    }
    $name_arr    = explode('.', $name);
    $name_arr[0] = strtolower($name_arr[0]);
    $filename    = $name_arr[0];
    $config      = \think\facade\Config::load($path . '/' . $filename, $filename);
    return $config[$name_arr[1]] ?? $default;
}

/**
 * 根目录物理路径
 * @return string
 */
function xn_root()
{
    return app()->getRootPath() . 'public';
}

/**
 * 构建图片上传HTML 单图
 * @param string $value
 * @param string $file_name
 * @param null $water 是否添加水印 null-系统配置设定 1-添加水印 0-不添加水印
 * @param null $thumb 生成缩略图，传入宽高，用英文逗号隔开，如：200,200（仅对本地存储方式生效，七牛、oss存储方式建议使用服务商提供的图片接口）
 * @return string
 */
function xn_upload_one($value, $file_name, $water = null, $thumb = null)
{
    $html = <<<php
    <div class="xn-upload-box">
        <div class="t layui-col-md12 layui-col-space10">
            <input type="hidden" name="{$file_name}" class="layui-input xn-images" value="{$value}">
            <div class="layui-col-md4">
                <div type="button" class="layui-btn webuploader-container" id="{$file_name}" data-water="{$water}" data-thumb="{$thumb}" style="width: 113px;"><i class="layui-icon layui-icon-picture"></i>上传图片</div>
                <div type="button" class="layui-btn chooseImage" data-num="1"><i class="layui-icon layui-icon-table"></i>选择图片</div>
            </div>
        </div>
        <ul class="upload-ul clearfix">
            <span class="imagelist"></span>
        </ul>
        <script>$('#{$file_name}').uploadOne();</script>
    </div>
php;
    return $html;
}

/**
 * 构建图片上传HTML 多图
 * @param string $value
 * @param string $file_name
 * @param null $water 是否添加水印 null-系统配置设定 1-添加水印 0-不添加水印
 * @param null $thumb 生成缩略图，传入宽高，用英文逗号隔开，如：200,200（仅对本地存储方式生效，七牛、oss存储方式建议使用服务商提供的图片接口）
 * @return string
 */
function xn_upload_multi($value, $file_name, $water = null, $thumb = null)
{
    $html = <<<php
    <div class="xn-upload-box">
        <div class="t layui-col-md12 layui-col-space10">
            <div class="layui-col-md8">
                <input type="text" name="{$file_name}" class="layui-input xn-images" value="{$value}">
            </div>
            <div class="layui-col-md4">
                <div type="button" class="layui-btn webuploader-container" id="{$file_name}" data-water="{$water}" data-thumb="{$thumb}" style="width: 113px;"><i class="layui-icon layui-icon-picture"></i>上传图片</div>
                <div type="button" class="layui-btn chooseImage"><i class="layui-icon layui-icon-table"></i>选择图片</div>
            </div>
        </div>
        <ul class="upload-ul clearfix">
            <span class="imagelist"></span>
        </ul>
        <script>$('#{$file_name}').upload();</script>
    </div>
php;
    return $html;
}

/**
 * 格式化标签，将空格、中文逗号替换成英文半角分号
 * @param $tags
 * @return string
 */
function xn_format_tags($tags)
{
    $tags = trim($tags);
    $tags = str_replace(' ', ',', str_replace('，', ',', $tags));
    $arr  = explode(',', $tags);
    $data = [];
    foreach ($arr as $v) {
        if ($v != '') {
            $data[] = $v;
        }
    }
    return implode(',', $data);
}

/**
 * 生成全局唯一标识符
 * @param bool $trim
 * @return string
 */
function xn_create_guid()
{
    $charid = strtoupper(md5(uniqid(mt_rand(), true)));
    $hyphen = chr(45); // "-"
    $uuid   = chr(123) // "{"
     . substr($charid, 0, 8) . $hyphen
    . substr($charid, 8, 4) . $hyphen
    . substr($charid, 12, 4) . $hyphen
    . substr($charid, 16, 4) . $hyphen
    . substr($charid, 20, 12)
    . chr(125); // "}"
    return $uuid;
}

//生成订单号
function xn_create_order_no()
{
    $yCode   = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
    $orderSn = $yCode[intval(date('Y')) - 2020] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
    return $orderSn;
}

if (!function_exists('auto_usdt2cny')) {
    //取行情数据，用于是自动更新usdt价格
    /* @return array*/
    function auto_usdt2cny($url = 'https://api.nomics.com/v1/currencies/ticker?key=3167d57d0154f27629e9733b6d7004398955d994&ids=BTC,ETH,USDT&interval=1d,7d&convert=CNY&per-page=10&page=1', $postData = '', $timeOut = 10, $httpHeader = array())
    {
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $url);
        if ($httpHeader) {
            curl_setopt($handle, CURLOPT_HTTPHEADER, $httpHeader);
        }
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_HEADER, 0);
        curl_setopt($handle, CURLOPT_TIMEOUT, $timeOut);
        curl_setopt($handle, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($handle, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.93 Safari/537.36');
        curl_setopt($handle, CURLOPT_ENCODING, 'gzip,deflate,sdch');
        if (!empty($postData)) {
            curl_setopt($handle, CURLOPT_POST, 0);
            curl_setopt($handle, CURLOPT_POSTFIELDS, $postData);
        }
        $result['response']   = curl_exec($handle);
        $result['httpStatus'] = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        $result['fullInfo']   = curl_getinfo($handle);
        $result['errorMsg']   = '';
        $result['errorNo']    = 0;
        if (curl_errno($handle)) {
            $result['errorMsg'] = curl_error($handle);
            $result['errorNo']  = curl_errno($handle);
        }
        curl_close($handle);
        $data                            = json_decode($result['response'], true);
        $res['btc']['price']             = $data[0]['price'];
        $res['btc']['logo_url']          = $data[0]['logo_url'];
        $res['btc']['price_change_pct']  = $data[0]['1d']['price_change_pct'];
        $res['eth']['price']             = $data[1]['price'];
        $res['eth']['logo_url']          = $data[1]['logo_url'];
        $res['eth']['price_change_pct']  = $data[1]['1d']['price_change_pct'];
        $res['usdt']['price']            = $data[2]['price'];
        $res['usdt']['logo_url']         = $data[2]['logo_url'];
        $res['usdt']['price_change_pct'] = $data[2]['1d']['price_change_pct'];

        return $res;
    }

}

function init_view()
{
    $is_login = '';
    $res      = session('user_auth');
    // dump($res['user']);exit;
    $msg = session('msg');
    //$where=['uid'=>$res['uid']];

    if ($res) {
        $is_login     = 1;
        $sesson_array = [];
        $sesson_array = ['user' => $res,
            'user_msg_nums'         => session('user_msg_nums'),
            'notice_nums'           => session('notice_nums'),
            'msg'                   => $msg['user_msg'],
            'notice'                => $msg['user_msg'],
            'is_login'              => $is_login,
        ];

    }

    return $sesson_array ? $sesson_array : [];
}

function get_client_ip($type = 0)
{
    $type      = $type ? 1 : 0;
    static $ip = null;
    if ($ip !== null) {
        return $ip[$type];
    }

    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $pos = array_search('unknown', $arr);
        if (false !== $pos) {
            unset($arr[$pos]);
        }

        $ip = trim($arr[0]);
    } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $long = ip2long($ip);
    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];

}

/*生成订单号*/

function create_osn()
{
    $order_id_main = date('YmdHis') . rand(10000000, 99999999);

    $order_id_len = strlen($order_id_main);

    $order_id_sum = 0;

    for ($i = 0; $i < $order_id_len; $i++) {

        $order_id_sum += (int) (substr($order_id_main, $i, 1));

    }

    $osn = $order_id_main . str_pad((100 - $order_id_sum % 100) % 100, 2, '0', STR_PAD_LEFT);
    return $osn;
}
/*  发送手机短信*/

function sms_mobile($u, $p, $m, $rand, $title = 'PAXFUL')
{

    $url = 'http://api.smsbao.com/sms?u=' . $u . '&p=' . md5($p) . '&m=' . $m . '&c=' . urlencode('【' . $title . '】您的验证码' . $rand . '：（10分钟内有效，如非本人操作，请忽略）');

    if (function_exists('file_get_contents')) {
        $file_contents = file_get_contents($url);
    } else {
        $ch      = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $file_contents = curl_exec($ch);
        curl_close($ch);
    }

    return $file_contents;
}
/*重置登陆密码*/
function sms_mobile_pwd($u, $p, $m, $rand, $title = 'PAXFUL')
{

    $url = 'http://api.smsbao.com/sms?u=' . $u . '&p=' . md5($p) . '&m=' . $m . '&c=' . urlencode('【' . $title . '】您的密码已经重置为:' . $rand . '：（10分钟内有效，如非本人操作，请忽略）');

    if (function_exists('file_get_contents')) {
        $file_contents = file_get_contents($url);
    } else {
        $ch      = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $file_contents = curl_exec($ch);
        curl_close($ch);
    }

    return $file_contents;
}

/*  短信验证码*/
function generate_code($length = 4)
{
    return str_pad(mt_rand(0, pow(10, $length) - 1), $length, '0', STR_PAD_LEFT);
}

/*查看登陆*/

function check_login()
{
    $has = session('is_login');
    if ($has != 1) {
        return json_encode(['code' => 0, 'msg' => '请登陆后再操作'], JSON_UNESCAPED_UNICODE);
    }
}

/**
 * 获取 IP  地理位置
 * 淘宝IP接口
 * @Return: array
 */
function getCity($ip = '')
{
    if ($ip == '') {
        $url  = "http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json";
        $ip   = json_decode(file_get_contents($url), true);
        $data = $ip;
    } else {
        $url = "http://ip.taobao.com/service/getIpInfo.php?ip=" . $ip;
        $ip  = json_decode(file_get_contents($url));
        if ((string) $ip->code == '1') {
            return false;
        }
        $data = (array) $ip->data;
    }

    return $data;
}
/*时间转换*/
function trans_day($_time)
{
    $time = $_time;

    $time2 = time();
    $res   = ($time2 - $time) / 86400;
    $res   = intval($res);
    if ($res < 1) {
        return '今天';
    }
    if ($res == 1) {
        return '昨天';
    } elseif ($res == 2) {
        return '前天';
    } elseif ($res > 30) {
        $res    = $res / 30;
        $res    = intval($res);
        $return = ($res) . "月前";
    } else {
        $return = ($res) . "天前";
    }
    return $return;
}
/**
 * 截取中文字符串
 */

function msubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = false)
{
    if (function_exists("mb_substr")) {
        if ($suffix) {
            return mb_substr($str, $start, $length, $charset) . "...";
        } else {
            return mb_substr($str, $start, $length, $charset);
        }
    } elseif (function_exists('iconv_substr')) {
        if ($suffix) {
            return iconv_substr($str, $start, $length, $charset) . "...";
        } else {
            return iconv_substr($str, $start, $length, $charset);
        }
    }
    $re['utf-8']  = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef][x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/";
    $re['gb2312'] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/";
    $re['gbk']    = "/[x01-x7f]|[x81-xfe][x40-xfe]/";
    $re['big5']   = "/[x01-x7f]|[x81-xfe]([x40-x7e]|xa1-xfe])/";
    preg_match_all($re[$charset], $str, $match);
    $slice = join("", array_slice($match[0], $start, $length));if ($suffix) {
        return $slice . "…";
    }
    return $slice;

}

function removeXSS($dirty_html)
{
    if ($dirty_html === '' || $dirty_html === (string) ((int) $dirty_html)) {
        return $dirty_html;
    }
    require '../vendor/autoload.php';
    //或者
    //require_once 'library/HTMLPurifier.includes.php'; // 载入核心文件
    // 生成配置对象  配置文档http://htmlpurifier.org/live/configdoc/plain.html
    $config = HTMLPurifier_Config::createDefault();

    // 清理配置缓存,上线时关掉这句
    //$config->set('Cache.DefinitionImpl', null);
    $config->set('HTML.Allowed', 'a[href|title]');
    //echo 3;
    //var_export($config, FALSE);//true为返回，false为输出
    // 使用配置生成过滤用的对象
    $purifier = new HTMLPurifier($config);
    // 过滤字符串
    $clean_html = $purifier->purify($dirty_html);

    return $clean_html;
}

//递归方式把数组或字符串 null转换为空''字符串
function _unsetNull($arr)
{
    foreach ($arr as $key => $value) {
        if ($value === null) {
            $arr[$key] = '';
        } else {
            $arr[$key] = _unsetNull($value); //递归再去执行
        }
    }
    return $arr;
}

function niname()
{
    $n          = 6;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $randomString = '';

    for ($i = 0; $i < $n; $i++) {

        $index = rand(0, strlen($characters) - 1);

        $randomString .= $characters[$index];

    }

    return $randomString;

}

function is_mobile()
{
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
        return true;
    }
    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset($_SERVER['HTTP_VIA'])) {
        // 找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    }
    // 脑残法，判断手机发送的客户端标志,兼容性有待提高
    if (isset($_SERVER['HTTP_USER_AGENT'])) {
        $clientkeywords = ['nokia', 'sony', 'ericsson', 'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp', 'sie-', 'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu', 'android', 'netfront', 'symbian', 'ucweb', 'windowsce', 'palm', 'operamini', 'operamobi', 'openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile'];
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            return true;
        }
    }
    // 协议法，因为有可能不准确，放到最后判断
    if (isset($_SERVER['HTTP_ACCEPT'])) {
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
            return true;
        }
    }
    return false;
}
