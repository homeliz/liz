<?php
/**
 * 自定义系统函数
 */


/**
 * 加密选项
 * @param string$k
 * @return array|mixed
 */
function encrypt_method( $k='0' )
{
    $encrypt_method = [
        '1' => 'table',
        '2' => 'rc4',
        '3' => 'rc4-md5',
        '4' => 'rc4-md5-6',
        '5' => 'aes-128-cfb',
        '6' => 'aes-192-cfb',
        '7' => 'aes-256-cfb',
        '8' => 'aes-128-ctr',
        '9' => 'aes-192-ctr',
        '10' => 'aes-256-ctr',
        '11' => 'bf-cfb',
        '12' => 'camellia-128-cfb',
        '13' => 'camellia-192-cfb',
        '14' => 'camellia-256-cfb',
        '15' => 'cast5-cfb',
        '16' => 'des-cfb',
        '17' => 'idea-cfb',
        '18' => 'rc2-cfb',
        '19' => 'seed-cfb',
        '20' => 'salsa20',
        '21' => 'chacha20',
        '22' => 'chacha20-ietf',
    ];

    if ( $k && isset( $encrypt_method[$k] ) ) {
        return $encrypt_method[$k];
    }

    return $encrypt_method;
}

function product_type( $k='' )
{
    $product_type = [
        ''=>'',
        '0' => '关闭链路功能',
        '1' => '生活',
        '2' => '工作',
        '3' => '隐云',
       
    ];

    if ( $k && isset( $product_type[$k] ) ) {
        return $product_type[$k];
    }

    return $product_type;
}

/**
 *传输协议
 * @param string $k
 * @return array|mixed
 */
function protocol( $k = '0' )
{
    $protocol = [
        '1' => 'origin',
        '2' => 'verify_simple',
        '3' => 'verify_sha1',
        '4' => 'auth_sha1',
        '5' => 'auth_sha1_v2',
        '6' => 'auth_sha1_v4',
        '7' => 'auth_aes128_sha1',
        '8' => 'auth_aes128_md5',
    ];

    if ( $k && isset( $protocol[$k] ) ) {
        return $protocol[$k];
    }

    return $protocol;
}

/**
 * 混淆插件
 * @param string $k
 * @return array|mixed
 */
function obfs( $k = '0' )
{
    $obfs = [
        '1' => 'plain',
        '2' => 'http_simple',
        '3' => 'http_post',
        '4' => 'tls_simple',
        '5' => 'tls1.2_ticket_auth',
    ];

    if ( $k && isset( $obfs[$k] ) ) {
        return $obfs[$k];
    }

    return $obfs;

}

/**
 *加密类型
 * @param string $k
 * @return array|mixed
 */
function encryption( $k = '0' )
{
    $encryption = [
        'none' => 'No Encryption',
        'wep-open' => '>WEP 开放认证',
        'wep-shared' => 'WEP 共享密钥',
        'psk' => 'WPA-PSK',
        'psk2' => 'WPA2-PSK',
        'psk-mixed' => 'WPA-PSK/WPA2-PSK Mixed Mode',
        'wpa' => 'WPA-EAP',
        'wpa' => 'WPA2-EAP',
    ];

    if ( $k && isset( $encryption[$k] ) ) {
        return $encryption[$k];
    }

    return $encryption;
}

