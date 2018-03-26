<?php
use App\Http\Models\Admin\Router\MacLog; #日志表
// use App\Http\Models\Admin\Router\Interface; #日志表
// use DB;
use Illuminate\Support\Facades\Redis as Redis;
/**
 * 生成UUID（唯一）
 * @return string
 */
function makeUuid()
{
    $address = strtolower('localhost' . '/' . '127.0.0.1');
    list ( $usec, $sec ) = explode(" ", microtime());
    $time = $sec . substr($usec, 2, 3);
    $random = rand(0, 1) ? '-' : '';
    $random = $random . rand(1000, 9999) . rand(1000, 9999) . rand(1000, 9999) . rand(100, 999) . rand(100, 999);
    $uuid = strtoupper(md5($address . ':' . $time . ':' . $random));
    $uuid = substr($uuid, 0, 8) . '-' . substr($uuid, 8, 4) . '-' . substr($uuid, 12, 4) . '-' . substr($uuid, 16, 4) . '-' . substr($uuid, 20);
    $uuid = str_replace("-", "", $uuid);
    return $uuid;
}

/**
 * 检测变量是否是手机号码
 * 手机号码必须是11位的数字，第一位数字必须为1，第二数字必须是34568中的任意一个
 * @param string $val 手机号码
 * @return bool
 */
function isMobile($val) {
    return preg_match('/^1\d{10}$/', $val);
}

/**
 * 检测变量是否是座机号码
 * 3-4位区号，7-8位直播号码，1－4位分机号
 * @param string $val 座机号码
 * @return bool
 */
function isPhone($val) {
    return preg_match('/^(0[0-9]{2,3}-)?([2-9][0-9]{6,7})+(-[0-9]{1,4})?$/', $val);
}

/**
 * 检测变量是否是密码
 * 密码只能是6-30位英文、数字及“_”、“-”组成
 * @param string $val 密码
 * @return bool
 */
function is_pwd($val) {
    return preg_match('/^[\w-]{6,30}$/', $val);
}

/**
 * 检测变量是否是邮件地址
 * @param string $email email
 * @return bool
 */
function isEmail($email) {
    return preg_match('/^[\w-]+(\.[\w-]+)*\@[A-Za-z0-9]+((\.|-|_)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/', $email);
}

/**
 * 把一些预定义的字符转换为 HTML 实体
 * @param string $str
 * @return string
 */
function convertVar($str) {

    if (!isset($str) || empty($str))
        return null;
    return htmlspecialchars(trim($str));
}
function convert_var($str) {

    if (!isset($str) || empty($str))
        return null;
    return htmlspecialchars(trim($str));

}

/**
 * 检查是否是整数
 * @param string $val 值
 * @param int $type 默认为空【1.大于0的整数 2.大于等于的整数 3.小于0的整数 4.小于等于0的整数】
 * @return bool
 */
function ebsig_is_int($val, $type = 1) {

    if (ceil($val) != $val)
        return false;

    if ($type == 1 && $val <= 0)
        return false;
    else if ($type == 2 && $val < 0)
        return false;
    else if ($type == 3 && $val >= 0)
        return false;
    else if ($type == 4 && $val > 0)
        return false;

    return true;
}

/**
 * 检测变量是否是日期或日期+时间
 * @param $val
 * @return bool
 */
function is_true_date( $val ) {
    return preg_match('/^\d{4}[\-](0?[1-9]|1[012])[\-](0?[1-9]|[12][0-9]|3[01])(\s+(0?[0-9]|1[0-9]|2[0-3])\:(0?[0-9]|[1-5][0-9])\:(0?[0-9]|[1-5][0-9]))?$/', $val);
}

/**
 * 分页程序
 * @param int $pageIndex 当前页数
 * @param int $count 总数量
 * @param int $limit 每页显示数量
 * @param string $link 分页链接，链接里的页码部分用%d代替，在本方法中会用sprintf函数替换%d为页码。
 * @param string $tpl 分页模板
 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|null
 */
function page($pageIndex, $count, $limit, $link, $tpl = 'page.page') {

    $pageCount = ceil($count / $limit);
    if ($pageCount == 1)
        return null;

    $pageLinks = [];
    if ($pageIndex > 1) {
        $pageLinks['previous']['link'] = sprintf($link, $pageIndex - 1);
        $pageLinks['previous']['page'] = $pageIndex - 1;
    }
    if ($pageIndex < $pageCount) {
        $pageLinks['next']['link'] = sprintf($link, $pageIndex + 1);
        $pageLinks['next']['page'] = $pageIndex + 1;
    }
    $i = 1;
    while ($i <= $pageCount) {
        $pageLinks['link'][] = array('href' => sprintf($link, $i), 'text'=> $i);
        if ($pageIndex - 3 > $i) {
            $pageLinks['link'][] = array('href' => '', 'text'=> '...');
            $i = $pageIndex - 3;
        } else if ($i < $pageCount && $pageIndex + 3 < $i && $pageCount - 1 > $i) {
            $pageLinks['link'][] = array('href'=>'', 'text'=>'...');
            $i = $pageCount - 1;
        }
        $i++;
    }
    $pageLinks['pageIndex'] = $pageIndex;
    $pageLinks['total'] = $count;
    $pageLinks['pageCount'] = $pageCount;
    $pageLinks['skip_link'] = $link;

    return view($tpl, ['pageLinks'=>$pageLinks]);

}

/**
 * 加密字符串
 * @param string $str 需要加密的字符串
 * @return string
 */
function encryptD($str) {

    $seed = 2;
    $len = strlen($str);
    $result = '';
    for ($i = 0; $i < $len; $i++) {
        $o = ord(substr($str, $i, 1));
        $b = $o ^ $seed << 2;
        $result .= chr($b);
    }
    $result .= chr(($seed + 64) ^ 35);
    return base64_encode($result);

}

function taskSerialNumber($type) {

    if ( !in_array( $type, array( '1', '2' ) ) ) {
        return '参数错误';
    }

    $num =  new TaskSerialNumber();
    $num->uuid = makeUuid();
    $num->task_type = $type;
    $num->save();
    return $num->id;


}

/**
 * 解密字符串
 * @param string $str 需要解密的字符串
 * @return string
 */
function decryptD($str) {

    $str_d = base64_decode($str);
    $seed = (ord(substr($str_d, -1)) - 64) ^ 35;
    $len = strlen($str_d) - 1;
    $result = '';
    for ($i = 0; $i < $len; $i++) {
        $o = ord(substr($str_d, $i, 1));
        $b = $o ^ $seed << 2;
        $result .= chr($b);
    }

    return $result;

}

function dy( $obj,$str='') {

    error_log($str.var_export($obj,true));
}

/**
 * 保存日志
 * @param $date
 */
function addLog( $date )
{

    $log_obj = new MacLog();
    $log_obj->uuid = makeUuid();
    $log_obj->ip = ip2long($date['ip']);
    $log_obj->mac = $date['mac'];
    $log_obj->ssid = $date['ssid'];
    $log_obj->content = json_encode($date['content'], JSON_UNESCAPED_UNICODE);
    $log_obj->save();
}

/**
 * 保存日志
 * @param $date
 */
function addInterfaceLog( $date )
{

    $interface_obj = new App\Http\Models\Admin\Router\InterfaceLog();
    $interface_obj->user_ip = ip2long($date['user_ip']);
    $interface_obj->mac = $date['mac'];
    $interface_obj->ssid = $date['ssid'];
    $interface_obj->net = $date['net'];
    $interface_obj->count = $date['count'];
    $interface_obj->visit_time =$date['visit_time'] ;
    $interface_obj->save();
}

/**
 * 获取后台用户id
 * @return mixed
 */
function userID() {
    $session_id = session()->getId();
    return Redis::get('MF_ADMIN_USER_ID' . $session_id);
}

/*********************************************************************
    函数名称:encrypt
    函数作用:加密解密字符串
    使用方法:
    加密     :encrypt('str','E','nowamagic');
    解密     :encrypt('被加密过的字符串','D','nowamagic');
    参数说明:
    $string   :需要加密解密的字符串
    $operation:判断是加密还是解密:E:加密   D:解密
    $key      :加密的钥匙(密匙);
    
http://www.cnblogs.com/roucheng/
*********************************************************************/
function miencrypt($string,$operation,$key='')
{
    $key=md5($key);
    $key_length=strlen($key);
    $string=$operation=='D'?base64_decode($string):substr(md5($string.$key),0,8).$string;
    $string_length=strlen($string);
    $rndkey=$box=array();
    $result='';
    for($i=0;$i<=255;$i++)
    {
        $rndkey[$i]=ord($key[$i%$key_length]);
        $box[$i]=$i;
    }
    for($j=$i=0;$i<256;$i++)
    {
        $j=($j+$box[$i]+$rndkey[$i])%256;
        $tmp=$box[$i];
        $box[$i]=$box[$j];
        $box[$j]=$tmp;
    }
    for($a=$j=$i=0;$i<$string_length;$i++)
    {
        $a=($a+1)%256;
        $j=($j+$box[$a])%256;
        $tmp=$box[$a];
        $box[$a]=$box[$j];
        $box[$j]=$tmp;
        $result.=chr(ord($string[$i])^($box[($box[$a]+$box[$j])%256]));
    }
    if($operation=='D')
    {
        if(substr($result,0,8)==substr(md5(substr($result,8).$key),0,8))
        {
            return substr($result,8);
        }
        else
        {
            return'';
        }
    }
    else
    {
        return str_replace('=','',base64_encode($result));
    }
}

// 得到两个日期间的天数差
function diffBetweenTwoDays ($day1, $day2)
{
    $datetime_start = new DateTime($day1);  
    $datetime_end = new DateTime($day2);  
    return $days = $datetime_start->diff($datetime_end)->days;  
}
 
// 接口密码转换
function mdpassword($str)
{
    $str1='';
    for ($i=0; $i <strlen($str) ; $i++) { 
        switch ($str[$i]) {
            case '9':$str[$i]=0;break;
            case 'a':$str[$i]=1;break;
            case 'b':$str[$i]=2;break;
            case 'c':$str[$i]=3;break;
            case '6':$str[$i]=4;break;
            case 'd':$str[$i]=5;break;
            case '5':$str[$i]=6;break;
            case '1':$str[$i]=7;break;
            case 'f':$str[$i]=8;break;
            case 'e':$str[$i]=9;break;
            case '0':$str[$i]='a';break;
            case '3':$str[$i]='b';break;
            case '7':$str[$i]='c';break;
            case '2':$str[$i]='d';break;
            case '8':$str[$i]='e';break;
            case '4':$str[$i]='f';break;
            default:
            break;
        }
        $str1.=$str[$i];
    }
     return $str1;   
}

// 根据ip获取地理位置
function convertip($ip) {
        // $dat_path = $this->config->item('ip_url') . "/qqwry.dat";
        $dat_path=public_path().'/qqwry.dat';
        // $dat_path = TEMPLATEPATH.'/QQWry.Dat';
        if (!$fd = @fopen($dat_path, 'rb')) {
            return 'IP date file not exists or access denied';
        }
        $ip        = explode('.', $ip);
        $ipNum     = $ip[0] * 16777216 + $ip[1] * 65536 + $ip[2] * 256 + $ip[3];
        $DataBegin = fread($fd, 4);
        $DataEnd   = fread($fd, 4);
        $ipbegin   = implode('', unpack('L', $DataBegin));
        if ($ipbegin < 0) {
            $ipbegin += pow(2, 32);
        }

        $ipend = implode('', unpack('L', $DataEnd));
        if ($ipend < 0) {
            $ipend += pow(2, 32);
        }

        $ipAllNum = ($ipend - $ipbegin) / 7 + 1;
        $BeginNum = 0;
        $EndNum   = $ipAllNum;
        while ($ip1num > $ipNum || $ip2num < $ipNum) {
            $Middle = intval(($EndNum + $BeginNum) / 2);
            fseek($fd, $ipbegin + 7 * $Middle);
            $ipData1 = fread($fd, 4);
            if (strlen($ipData1) < 4) {
                fclose($fd);
                return 'System Error';
            }
            $ip1num = implode('', unpack('L', $ipData1));
            if ($ip1num < 0) {
                $ip1num += pow(2, 32);
            }

            if ($ip1num > $ipNum) {
                $EndNum = $Middle;
                continue;
            }
            $DataSeek = fread($fd, 3);
            if (strlen($DataSeek) < 3) {
                fclose($fd);
                return 'System Error';
            }
            $DataSeek = implode('', unpack('L', $DataSeek . chr(0)));
            fseek($fd, $DataSeek);
            $ipData2 = fread($fd, 4);
            if (strlen($ipData2) < 4) {
                fclose($fd);
                return 'System Error';
            }
            $ip2num = implode('', unpack('L', $ipData2));
            if ($ip2num < 0) {
                $ip2num += pow(2, 32);
            }

            if ($ip2num < $ipNum) {
                if ($Middle == $BeginNum) {
                    fclose($fd);
                    return 'Unknown';
                }
                $BeginNum = $Middle;
            }
        }
        $ipFlag = fread($fd, 1);
        if ($ipFlag == chr(1)) {
            $ipSeek = fread($fd, 3);
            if (strlen($ipSeek) < 3) {
                fclose($fd);
                return 'System Error';
            }
            $ipSeek = implode('', unpack('L', $ipSeek . chr(0)));
            fseek($fd, $ipSeek);
            $ipFlag = fread($fd, 1);
        }
        if ($ipFlag == chr(2)) {
            $AddrSeek = fread($fd, 3);
            if (strlen($AddrSeek) < 3) {
                fclose($fd);
                return 'System Error';
            }
            $ipFlag = fread($fd, 1);
            if ($ipFlag == chr(2)) {
                $AddrSeek2 = fread($fd, 3);
                if (strlen($AddrSeek2) < 3) {
                    fclose($fd);
                    return 'System Error';
                }
                $AddrSeek2 = implode('', unpack('L', $AddrSeek2 . chr(0)));
                fseek($fd, $AddrSeek2);
            } else {
                fseek($fd, -1, SEEK_CUR);
            }
            while (($char = fread($fd, 1)) != chr(0)) {
                $ipAddr2 .= $char;
            }

            $AddrSeek = implode('', unpack('L', $AddrSeek . chr(0)));
            fseek($fd, $AddrSeek);
            while (($char = fread($fd, 1)) != chr(0)) {
                $ipAddr1 .= $char;
            }

        } else {
            fseek($fd, -1, SEEK_CUR);
            while (($char = fread($fd, 1)) != chr(0)) {
                $ipAddr1 .= $char;
            }

            $ipFlag = fread($fd, 1);
            if ($ipFlag == chr(2)) {
                $AddrSeek2 = fread($fd, 3);
                if (strlen($AddrSeek2) < 3) {
                    fclose($fd);
                    return 'System Error';
                }
                $AddrSeek2 = implode('', unpack('L', $AddrSeek2 . chr(0)));
                fseek($fd, $AddrSeek2);
            } else {
                fseek($fd, -1, SEEK_CUR);
            }
            while (($char = fread($fd, 1)) != chr(0)) {
                $ipAddr2 .= $char;
            }
        }
        fclose($fd);
        if (preg_match('/http/i', $ipAddr2)) {
            $ipAddr2 = '';
        }
        $ipaddr = "$ipAddr1 $ipAddr2";
        $ipaddr = preg_replace('/CZ88.Net/is', '', $ipaddr);
        $ipaddr = preg_replace('/^s*/is', '', $ipaddr);
        $ipaddr = preg_replace('/s*$/is', '', $ipaddr);
        if (preg_match('/http/i', $ipaddr) || $ipaddr == '') {
            $ipaddr = 'Unknown';
        }
        $ipaddr = iconv('gbk', 'utf-8//IGNORE', $ipaddr);
        if ($ipaddr != '  ') {
            return $ipaddr;} else {
            $ipaddr = "来自于火星";
            return $ipaddr;
        }
}

