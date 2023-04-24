<?php
// +----------------------------------------------------------------------
// | 小牛Admin
// +----------------------------------------------------------------------
// | Website: www.xnadmin.cn
// +----------------------------------------------------------------------
// | Author: dav <85168163@qq.com>
// +----------------------------------------------------------------------

namespace app\api\controller;

use app\common\controller\Base;
use think\Request;

class Userinfo extends Base
{

    /**
     * 操作系统信息映射关系
     * name => (alias, exlcudes)
     * name 操作系统信息，alias 别名，excludes 不能包含的信息
     */

    public $operation_map = array(
        'Windows 10'            => array(
            'alias'    => array('Windows NT 6.4', 'Windows NT 10'),
            'excludes' => array(),
        ),
        'Windows 8.1'           => array(
            'alias'    => array('Windows NT 6.3'),
            'excludes' => array(),
        ),
        'Windows 8'             => array(
            'alias'    => array('Windows NT 6.2'),
            'excludes' => array('Xbox', 'Xbox One'),
        ),
        'Windows 7'             => array(
            'alias'    => array('Windows NT 6.1'),
            'excludes' => array('Xbox', 'Xbox One'),
        ),
        'Windows Vista'         => array(
            'alias'    => array('Windows NT 6'),
            'excludes' => array('Xbox', 'Xbox One'),
        ),
        'Windows 2000'          => array(
            'alias'    => array('Windows NT 5.0'),
            'excludes' => array(),
        ),
        'Windows XP'            => array(
            'alias'    => array('Windows NT 5'),
            'excludes' => array('ggpht.com'),
        ),
        'Windows 10 Mobile'     => array(
            'alias'    => array('Windows Phone 10'),
            'excludes' => array(),
        ),
        'Windows Phone 8.1'     => array(
            'alias'    => array('Windows Phone 8.1'),
            'excludes' => array(),
        ),
        'Windows Phone 8'       => array(
            'alias'    => array('Windows Phone 8'),
            'excludes' => array(),
        ),
        'Windows Phone 7'       => array(
            'alias'    => array('Windows Phone OS 7'),
            'excludes' => array(),
        ),
        'Windows Mobile'        => array(
            'alias'    => array('Windows CE'),
            'excludes' => array(),
        ),
        'Windows 98'            => array(
            'alias'    => array('Windows 98', 'Win98'),
            'excludes' => array('Palm'),
        ),
        'Xbox OS'               => array(
            'alias'    => array('xbox'),
            'excludes' => array(),
        ),
        'Windows'               => array(
            'alias'    => array('Windows'),
            'excludes' => array('Palm', 'ggpht.com'),
        ),
        'Android 6.x'           => array(
            'alias'    => array('Android 6', 'Android-6'),
            'excludes' => array('glass'),
        ),
        'Android 6.x Tablet'    => array(
            'alias'    => array('Android 6', 'Android-6'),
            'excludes' => array('mobile', 'glass'),
        ),
        'Android 5.x'           => array(
            'alias'    => array('Android 5', 'Android-5'),
            'excludes' => array('glass'),
        ),
        'Android 5.x Tablet'    => array(
            'alias'    => array('Android 5', 'Android-5'),
            'excludes' => array('mobile', 'glass'),
        ),
        'Android 4.x'           => array(
            'alias'    => array('Android 4', 'Android-4'),
            'excludes' => array('glass', 'ubuntu'),
        ),
        'Android 4.x Tablet'    => array(
            'alias'    => array('Android 4', 'Android-4'),
            'excludes' => array('mobile', 'glass', 'ubuntu'),
        ),
        'Android 4.x'           => array(
            'alias'    => array('Android 4'),
            'excludes' => array('ubuntu'),
        ),
        'Android 3.x Tablet'    => array(
            'alias'    => array('Android 3'),
            'excludes' => array(),
        ),
        'Android 2.x'           => array(
            'alias'    => array('Android 2'),
            'excludes' => array(),
        ),
        'Android 2.x Tablet'    => array(
            'alias'    => array('Kindle Fire', 'GT-P1000', 'SCH-I800'),
            'excludes' => array(),
        ),
        'Android 1.x'           => array(
            'alias'    => array('Android 1'),
            'excludes' => array(),
        ),
        'Android Mobile'        => array(
            'alias'    => array('Mobile'),
            'excludes' => array('ubuntu'),
        ),
        'Android Tablet'        => array(
            'alias'    => array('Tablet'),
            'excludes' => array(),
        ),
        'Android'               => array(
            'alias'    => array('Android'),
            'excludes' => array('Ubuntu'),
        ),
        'Chrome OS'             => array(
            'alias'    => array('CrOS'),
            'excludes' => array(),
        ),
        'WebOS'                 => array(
            'alias'    => array('webOS'),
            'excludes' => array(),
        ),
        'PalmOS'                => array(
            'alias'    => array('Palm'),
            'excludes' => array(),
        ),
        'MeeGo'                 => array(
            'alias'    => array('MeeGo'),
            'excludes' => array(),
        ),
        'iOS 9 (iPhone)'        => array(
            'alias'    => array('iPhone OS 9'),
            'excludes' => array(),
        ),
        'iOS 8.4 (iPhone)'      => array(
            'alias'    => array('iPhone OS 8_4'),
            'excludes' => array(),
        ),
        'iOS 8.3 (iPhone)'      => array(
            'alias'    => array('iPhone OS 8_3'),
            'excludes' => array(),
        ),
        'iOS 8.2 (iPhone)'      => array(
            'alias'    => array('iPhone OS 8_2'),
            'excludes' => array(),
        ),
        'iOS 8.1 (iPhone)'      => array(
            'alias'    => array('iPhone OS 8_1'),
            'excludes' => array(),
        ),
        'iOS 8 (iPhone)'        => array(
            'alias'    => array('iPhone OS 8'),
            'excludes' => array(),
        ),
        'iOS 7 (iPhone)'        => array(
            'alias'    => array('iPhone OS 7'),
            'excludes' => array(),
        ),
        'iOS 6 (iPhone)'        => array(
            'alias'    => array('iPhone OS 6'),
            'excludes' => array(),
        ),
        'iOS 5 (iPhone)'        => array(
            'alias'    => array('iPhone OS 5'),
            'excludes' => array(),
        ),
        'iOS 4 (iPhone)'        => array(
            'alias'    => array('iPhone OS 4'),
            'excludes' => array(),
        ),
        'iOS 9 (iPad)'          => array(
            'alias'    => array('OS 9'),
            'excludes' => array(),
        ),
        'iOS 8.4 (iPad)'        => array(
            'alias'    => array('OS 8_4'),
            'excludes' => array(),
        ),
        'iOS 8.3 (iPad)'        => array(
            'alias'    => array('OS 8_3'),
            'excludes' => array(),
        ),
        'iOS 8.2 (iPad)'        => array(
            'alias'    => array('OS 8_2'),
            'excludes' => array(),
        ),
        'iOS 8.1 (iPad)'        => array(
            'alias'    => array('OS 8_1'),
            'excludes' => array(),
        ),
        'iOS 8 (iPad)'          => array(
            'alias'    => array('OS 8_0'),
            'excludes' => array(),
        ),
        'iOS 7 (iPad)'          => array(
            'alias'    => array('OS 7'),
            'excludes' => array(),
        ),
        'iOS 6 (iPad)'          => array(
            'alias'    => array('OS 6'),
            'excludes' => array(),
        ),
        'Mac OS X (iPad)'       => array(
            'alias'    => array('iPad'),
            'excludes' => array(),
        ),
        'Mac OS X (iPhone)'     => array(
            'alias'    => array('iPhone'),
            'excludes' => array(),
        ),
        'Mac OS X (iPod)'       => array(
            'alias'    => array('iPod'),
            'excludes' => array(),
        ),
        'iOS'                   => array(
            'alias'    => array('iPhone OS', 'like Mac OS X'),
            'excludes' => array(),
        ),
        'Mac OS X'              => array(
            'alias'    => array('Mac OS X', 'CFNetwork'),
            'excludes' => array(),
        ),
        'Mac OS'                => array(
            'alias'    => array('Mac'),
            'excludes' => array(),
        ),
        'Maemo'                 => array(
            'alias'    => array('Maemo'),
            'excludes' => array(),
        ),
        'Bada'                  => array(
            'alias'    => array('Bada'),
            'excludes' => array(),
        ),
        'Android (Google TV)'   => array(
            'alias'    => array('GoogleTV'),
            'excludes' => array(),
        ),
        'Linux (Kindle 3)'      => array(
            'alias'    => array('Kindle/3'),
            'excludes' => array(),
        ),
        'Linux (Kindle 2)'      => array(
            'alias'    => array('Kindle/2'),
            'excludes' => array(),
        ),
        'Linux (Kindle)'        => array(
            'alias'    => array('Kindle'),
            'excludes' => array(),
        ),
        'Ubuntu'                => array(
            'alias'    => array('ubuntu'),
            'excludes' => array(),
        ),
        'Ubuntu Touch (mobile)' => array(
            'alias'    => array('mobile'),
            'excludes' => array(),
        ),
        'Linux'                 => array(
            'alias'    => array('Linux', 'CamelHttpStream'),
            'excludes' => array(),
        ),
        'Symbian OS 9.x'        => array(
            'alias'    => array('SymbianOS/9', 'Series60/3'),
            'excludes' => array(),
        ),
        'Symbian OS 8.x'        => array(
            'alias'    => array('SymbianOS/8', 'Series60/2.6', 'Series60/2.8'),
            'excludes' => array(),
        ),
        'Symbian OS 7.x'        => array(
            'alias'    => array('SymbianOS/7'),
            'excludes' => array(),
        ),
        'Symbian OS 6.x'        => array(
            'alias'    => array('SymbianOS/6'),
            'excludes' => array(),
        ),
        'Symbian OS'            => array(
            'alias'    => array('Symbian', 'Series60'),
            'excludes' => array(),
        ),
        'Series 40'             => array(
            'alias'    => array('Nokia6300'),
            'excludes' => array(),
        ),
        'Sony Ericsson'         => array(
            'alias'    => array('SonyEricsson'),
            'excludes' => array(),
        ),
        'SunOS'                 => array(
            'alias'    => array('SunOS'),
            'excludes' => array(),
        ),
        'Sony Playstation'      => array(
            'alias'    => array('Playstation'),
            'excludes' => array(),
        ),
        'Nintendo Wii'          => array(
            'alias'    => array('Wii'),
            'excludes' => array(),
        ),
        'BlackBerry 7'          => array(
            'alias'    => array('Version/7'),
            'excludes' => array(),
        ),
        'BlackBerry 6'          => array(
            'alias'    => array('Version/6'),
            'excludes' => array(),
        ),
        'BlackBerry Tablet OS'  => array(
            'alias'    => array('RIM Tablet OS'),
            'excludes' => array(),
        ),
        'BlackBerryOS'          => array(
            'alias'    => array('BlackBerry'),
            'excludes' => array(),
        ),
        'Roku OS'               => array(
            'alias'    => array('Roku'),
            'excludes' => array(),
        ),
        'Proxy'                 => array(
            'alias'     => array('ggpht.com'),
            'exclludes' => array(),
        ),
        'Unknown mobile'        => array(
            'alias'    => array('Mobile'),
            'excludes' => array(),
        ),
        'Unknown tablet'        => array(
            'alias'    => array('Tablet'),
            'excludes' => array(),
        ),
        'Unknown'               => array(
            'alias'    => array(),
            'excludes' => array(),
        ),
    );

    public $browser_map = array(
        'Outlook 2007'             => array(
            'alias'    => array('MSOffice 12'),
            'excludes' => array(),
        ),
        'Outlook 2013'             => array(
            'alias'    => array('Microsoft Outlook 15'),
            'excludes' => array(),
        ),
        'Outlook 2010'             => array(
            'alias'    => array('MSOffice 14', 'Microsoft Outlook 14'),
            'excludes' => array(),
        ),
        'Outlook'                  => array(
            'alias'    => array('MSOffice'),
            'excludes' => array(),
        ),
        'Windows Live Mail'        => array(
            'alias'    => array('Outlook-Express/7.0'),
            'excludes' => array(),
        ),
        'IE Mobile 11'             => array(
            'alias'    => array('IEMobile/11'),
            'excludes' => array(),
        ),
        'IE Mobile 10'             => array(
            'alias'    => array('IEMobile/10'),
            'excludes' => array(),
        ),
        'IE Mobile 9'              => array(
            'alias'    => array('IEMobile/9'),
            'excludes' => array(),
        ),
        'IE Mobile 7'              => array(
            'alias'    => array('IEMobile 7'),
            'excludes' => array(),
        ),
        'IE Mobile 6'              => array(
            'alias'    => array('IEMobile 6'),
            'excludes' => array(),
        ),
        'Xbox'                     => array(
            'alias'    => array('xbox'),
            'excludes' => array(),
        ),
        'Internet Explorer 11'     => array(
            'alias'    => array('Trident/7', 'IE 11.'),
            'excludes' => array('MSIE 7', 'BingPreview'),
        ),
        'Internet Explorer 10'     => array(
            'alias'    => array('MSIE 10'),
            'excludes' => array(),
        ),
        'Internet Explorer 9'      => array(
            'alias'    => array('MSIE 9'),
            'excludes' => array(),
        ),
        'Internet Explorer 8'      => array(
            'alias'    => array('MSIE 8'),
            'excludes' => array(),
        ),
        'Internet Explorer 7'      => array(
            'alias'    => array('MSIE 7'),
            'excludes' => array(),
        ),
        'Internet Explorer 6'      => array(
            'alias'    => array('MSIE 6'),
            'excludes' => array(),
        ),
        'Internet Explorer 5.5'    => array(
            'alias'    => array('MSIE 5.5'),
            'excludes' => array(),
        ),
        'Internet Explorer 5'      => array(
            'alias'    => array('MSIE 5'),
            'excludes' => array(),
        ),
        'Internet Explorer'        => array(
            'alias'    => array('MSIE', 'Trident', 'IE '),
            'excludes' => array('BingPreview', 'Xbox', 'Xbox One'),
        ),
        'Microsoft Edge Mobile'    => array(
            'alias'    => array('Mobile Safari'),
            'excludes' => array(),
        ),
        'Microsoft Edge Mobile 12' => array(
            'alias'    => array('Mobile Safari', 'Edge/12'),
            'excludes' => array(),
        ),
        'Microsoft Edge 13'        => array(
            'alias'    => array('Edge/13'),
            'excludes' => array('Mobile'),
        ),
        'Microsoft Edge 12'        => array(
            'alias'    => array('Edge/12'),
            'excludes' => array('Mobile'),
        ),
        'Microsoft Edge'           => array(
            'alias'    => array('Edge'),
            'excludes' => array(),
        ),
        'Chrome Mobile'            => array(
            'alias'    => array('CrMo', 'CriOS', 'Mobile Safari'),
            'excludes' => array('OPR/'),
        ),
        'Chrome 49'                => array(
            'alias'    => array('Chrome/49'),
            'excludes' => array('OPR/', 'Web Preview', 'Vivaldi'),
        ),
        'Chrome 48'                => array(
            'alias'    => array('Chrome/48'),
            'excludes' => array('OPR/', 'Web Preview', 'Vivaldi'),
        ),
        'Chrome 47'                => array(
            'alias'    => array('Chrome/47'),
            'excludes' => array('OPR/', 'Web Preview', 'Vivaldi'),
        ),
        'Chrome 46'                => array(
            'alias'    => array('Chrome/46'),
            'excludes' => array('OPR/', 'Web Preview', 'Vivaldi'),
        ),
        'Chrome 45'                => array(
            'alias'    => array('Chrome/45'),
            'excludes' => array('OPR/', 'Web Preview', 'Vivaldi'),
        ),
        'Chrome 44'                => array(
            'allias'   => array('Chrome/44'),
            'excludes' => array('OPR/', 'Web Preview', 'Vivaldi'),
        ),
        'Chrome 43'                => array(
            'alias'    => array('Chrome/43'),
            'excludes' => array('OPR/', 'Web Preview', 'Vivaldi'),
        ),
        'Chrome 42'                => array(
            'alias'    => array('Chrome/42'),
            'excludes' => array('OPR/', 'Web Preview', 'Vivaldi'),
        ),
        'Chrome 41'                => array(
            'alias'    => array('Chrome/41'),
            'excludes' => array('OPR/', 'Web Preview', 'Vivaldi'),
        ),
        'Chrome 40'                => array(
            'alias'    => array('Chrome/40'),
            'excludes' => array('OPR/', 'Web Preview', 'Vivaldi'),
        ),
        'Chrome 39'                => array(
            'alias'    => array('Chrome/39'),
            'excludes' => array('OPR/', 'Web Preview'),
        ),
        'Chrome 38'                => array(
            'alias'    => array('Chrome/38'),
            'excludes' => array('OPR/', 'Web Preview'),
        ),
        'Chrome 37'                => array(
            'alias'    => array('Chrome/37'),
            'excludes' => array('OPR/', 'Web Preview'),
        ),
        'Chrome 36'                => array(
            'alias'    => array('Chrome/36'),
            'excludes' => array('OPR/', 'Web Preview'),
        ),
        'Chrome 35'                => array(
            'alias'    => array('Chrome/35'),
            'excludes' => array('OPR/', 'Web Preview'),
        ),
        'Chrome 34'                => array(
            'alias'    => array('Chrome/34'),
            'excludes' => array('OPR/', 'Web Preview'),
        ),
        'Chrome 33'                => array(
            'alias'    => array('Chrome/33'),
            'excludes' => array('OPR/', 'Web Preview'),
        ),
        'Chrome 32'                => array(
            'alias'    => ('Chrome/32'),
            'excludes' => array('OPR/', 'Web Preview'),
        ),
        'Chrome 31'                => array(
            'alias'    => array('Chrome/31'),
            'excludes' => array('OPR/', 'Web Preview'),
        ),
        'Chrome 30'                => array(
            'alias'    => array('Chrome/30'),
            'excludes' => array('OPR/', 'Web Preview'),
        ),
        'Chrome 29'                => array(
            'alias'    => array('Chrome/29'),
            'excludes' => array('OPR/', 'Web Preview'),
        ),
        'Chrome 28'                => array(
            'alias'    => array('Chrome/28'),
            'excludes' => array('OPR/', 'Web Preview'),
        ),
        'Chrome 27'                => array(
            'alias'    => array('Chrome/27'),
            'excludes' => array('OPR/', 'Web Preview'),
        ),
        'Chrome 26'                => array(
            'alias'    => array('Chrome/26'),
            'excludes' => array('OPR/', 'Web Preview'),
        ),
        'Chrome 25'                => array(
            'alias'    => array('Chrome/25'),
            'excludes' => array('OPR/', 'Web Preview'),
        ),
        'Chrome 24'                => array(
            'alias'    => array('Chrome/24'),
            'excludes' => array('OPR/', 'Web Preview'),
        ),
        'Chrome 23'                => array(
            'alias'    => array('Chrome/23'),
            'excludes' => array('OPR/', 'Web Preview'),
        ),
        'Chrome 22'                => array(
            'alias'    => array('Chrome/22'),
            'excludes' => array('OPR/', 'Web Preview'),
        ),
        'Chrome 21'                => array(
            'alias'    => array('Chrome/21'),
            'excludes' => array('OPR/', 'Web Preview'),
        ),
        'Chrome 20'                => array(
            'alias'    => array('Chrome/20'),
            'excludes' => array('OPR/', 'Web Preview'),
        ),
        'Chrome 19'                => array(
            'alias'    => array('Chrome/19'),
            'excludes' => array('OPR/', 'Web Preview'),
        ),
        'Chrome 18'                => array(
            'alias'    => array('Chrome/18'),
            'excludes' => array(),
        ),
        'Chrome 17'                => array(
            'alias'    => array('Chrome/17'),
            'excludes' => array(),
        ),
        'Chrome 16'                => array(
            'alias'    => array('Chrome/16'),
            'excludes' => array(),
        ),
        'Chrome 15'                => array(
            'alias'    => array('Chrome/15'),
            'excludes' => array(),
        ),
        'Chrome 14'                => array(
            'alias'    => array('Chrome/14'),
            'excludes' => array(),
        ),
        'Chrome 13'                => array(
            'alias'    => array('Chrome/13'),
            'excludes' => array(),
        ),
        'Chrome 12'                => array(
            'alias'    => array('Chrome/12'),
            'excludes' => array(),
        ),
        'Chrome 11'                => array(
            'alias'    => array('Chrome/11'),
            'excludes' => array(),
        ),
        'Chrome 10'                => array(
            'alias'    => array('Chrome/10'),
            'excludes' => array(),
        ),
        'Chrome 9'                 => array(
            'alias'    => array('Chrome/9'),
            'excludes' => array(),
        ),
        'Chrome 8'                 => array(
            'alias'    => array('Chrome/8'),
            'excludes' => array(),
        ),
        'Chrome'                   => array(
            'alias'    => array('Chrome', 'CrMo', 'CriOS'),
            'excludes' => array('OPR/', 'Web Preview', 'Vivaldi'),
        ),
        'Omniweb'                  => array(
            'alias'    => array('OmniWeb'),
            'excludes' => array(),
        ),
        'Firefox 3 Mobile'         => array(
            'alias'    => array('Firefox/3.5 Maemo'),
            'excludes' => array(),
        ),
        'Firefox Mobile'           => array(
            'alias'    => array('Mobile'),
            'excludes' => array(),
        ),
        'Firefox Mobile 23'        => array(
            'alias'    => array('Firefox/23'),
            'excludes' => array(),
        ),
        'Firefox Mobile (iOS)'     => array(
            'alias'    => array('FxiOS'),
            'excludes' => array(),
        ),
        'Firefox 45'               => array(
            'alias'    => array('Firefox/45'),
            'excludes' => array(),
        ),
        'Firefox 44'               => array(
            'alias'    => array('Firefox/44'),
            'excludes' => array(),
        ),
        'Firefox 43'               => array(
            'alias'    => array('Firefox/43'),
            'excludes' => array(),
        ),
        'Firefox 42'               => array(
            'alias'    => array('Firefox/42'),
            'excludes' => array(),
        ),
        'Firefox 41'               => array(
            'alias'    => array('Firefox/41'),
            'excludes' => array(),
        ),
        'Firefox 40'               => array(
            'alias'    => array('Firefox/40'),
            'excludes' => array(),
        ),
        'Firefox 39'               => array(
            'alias'    => array('Firefox/39'),
            'excludes' => array(),
        ),
        'Firefox 38'               => array(
            'alias'    => array('Firefox/38'),
            'excludes' => array(),
        ),
        'Firefox 37'               => array(
            'alias'    => array('Firefox/37'),
            'excludes' => array(),
        ),
        'Firefox 36'               => array(
            'alias'    => array('Firefox/36'),
            'excludes' => array(),
        ),
        'Firefox 35'               => array(
            'alias'    => array('Firefox/35'),
            'excludes' => array(),
        ),
        'Firefox 34'               => array(
            'alias'    => array('Firefox/34'),
            'excludes' => array(),
        ),
        'Firefox 33'               => array(
            'alias'    => array('Firefox/33'),
            'excludes' => array(),
        ),
        'Firefox 32'               => array(
            'alias'    => array('Firefox/32'),
            'excludes' => array(),
        ),
        'Firefox 31'               => array(
            'alias'    => array('Firefox/31'),
            'excludes' => array(),
        ),
        'Firefox 30'               => array(
            'alias'    => array('Firefox/30'),
            'excludes' => array(),
        ),
        'Firefox 29'               => array(
            'alias'    => array('Firefox/29'),
            'excludes' => array(),
        ),
        'Firefox 28'               => array(
            'alias'    => array('Firefox/28'),
            'excludes' => array(),
        ),
        'Firefox 27'               => array(
            'alias'    => array('Firefox/27'),
            'excludes' => array(),
        ),
        'Firefox 26'               => array(
            'alias'    => array('Firefox/26'),
            'excludes' => array(),
        ),
        'Firefox 25'               => array(
            'alias'    => array('Firefox/25'),
            'excludes' => array(),
        ),
        'Firefox 24'               => array(
            'alias'    => array('Firefox/24'),
            'excludes' => array(),
        ),
        'Firefox 23'               => array(
            'alias'    => array('Firefox/23'),
            'excludes' => array(),
        ),
        'Firefox 22'               => array(
            'alias'    => array('Firefox/22'),
            'excludes' => array(),
        ),
        'Firefox 21'               => array(
            'alias'    => array('Firefox/21'),
            'excludes' => array('WordPress.com mShots'),
        ),
        'Firefox 20'               => array(
            'alias'    => array('Firefox/20'),
            'excludes' => array(),
        ),
        'Firefox 19'               => array(
            'alias'    => array('Firefox/19'),
            'excludes' => array(),
        ), 'Firefox 18' => array(
            'alias'    => array('Firefox/18'),
            'excludes' => array(),
        ),
        'Firefox 17'               => array(
            'alias'    => array('Firefox/17'),
            'excludes' => array(),
        ),
        'Firefox 16'               => array(
            'alias'    => array('Firefox/16'),
            'excludes' => array(),
        ),
        'Firefox 15'               => array(
            'alias'    => array('Firefox/15'),
            'excludes' => array(),
        ),
        'Firefox 14'               => array(
            'alias'    => array('Firefox/14'),
            'excludes' => array(),
        ),
        'Firefox 13'               => array(
            'alias'    => array('Firefox/13'),
            'excludes' => array(),
        ),
        'Firefox 12'               => array(
            'alias'    => array('Firefox/12'),
            'excludes' => array(),
        ),
        'Firefox 11'               => array(
            'alias'    => array('Firefox/11'),
            'excludes' => array(),
        ),
        'Firefox 10'               => array(
            'alias'    => array('Firefox/10'),
            'excludes' => array(),
        ),
        'Firefox 9'                => array(
            'alias'    => array('Firefox/9'),
            'excludes' => array(),
        ),
        'Firefox 8'                => array(
            'alias'    => array('Firefox/8'),
            'excludes' => array(),
        ),
        'Firefox 7'                => array(
            'alias'    => array('Firefox/7'),
            'excludes' => array(),
        ),
        'Firefox 6'                => array(
            'alias'    => array('Firefox/6.'),
            'excludes' => array(),
        ),
        'Firefox 5'                => array(
            'alias'    => array('Firefox/5.'),
            'excludes' => array(),
        ),
        'Firefox 4'                => array(
            'alias'    => array('Firefox/4.'),
            'excludes' => array(),
        ),
        'Firefox 3'                => array(
            'alias'    => array('Firefox/3.'),
            'excludes' => array('Camino', 'Flock', 'ggpht.com'),
        ),
        'Firefox 2'                => array(
            'alias'    => array('Firefox/2.'),
            'excludes' => array('Camino', 'WordPress.com mShots'),
        ),
        'Firefox 1.5'              => array(
            'alias'    => array('Firefox/1.5'),
            'excludes' => array(),
        ),
        'Firefox'                  => array(
            'alias'    => array('Firefox', 'FxiOS'),
            'excludes' => array('camino', 'flock', 'ggpht.com', 'WordPress.com mShots'),
        ),
        'BlackBerry'               => array(
            'alias'    => array('BB10'),
            'excludes' => array(),
        ),
        'Mobile Safari'            => array(
            'alias'    => array('Mobile Safari', 'Mobile/'),
            'excludes' => array('bot', 'preview', 'OPR/', 'Coast/', 'Vivaldi', 'CFNetwork', 'FxiOS'),
        ),
        'Silk'                     => array(
            'alias'    => array('Silk/'),
            'excludes' => array(),
        ),
        'Safari 9'                 => array(
            'alias'    => array('Version/9'),
            'excludes' => array('Applebot'),
        ),
        'Safari 8'                 => array(
            'alias'    => array('Version/8'),
            'excludes' => array('Applebot'),
        ),
        'Safari 7'                 => array(
            'alias'    => array('Version/7'),
            'excludes' => array('bing'),
        ),
        'Safari 6'                 => array(
            'alias'    => array('Version/6'),
            'excludes' => array(),
        ),
        'Safari 5'                 => array(
            'alias'    => array('Version/5'),
            'excludes' => array('Google Web Preview'),
        ),
        'Safari 4'                 => array(
            'alias'    => array('Version/4'),
            'excludes' => array('Googlebot-Mobile'),
        ),
        'Safari'                   => array(
            'alias'    => array('Safari'),
            'excludes' => array('bot', 'preview', 'OPR/', 'Coast/', 'Vivaldi', 'CFNetwork', 'Phantom'),
        ),
        'Opera'                    => array(
            'alias'    => array(' Coast/1.'),
            'excludes' => array(),
        ),
        'Opera'                    => array(
            'alias'    => array(' Coast/'),
            'excludes' => array(),
        ),
        'Opera Mobile'             => array(
            'alias'    => array('Mobile Safari'),
            'excludes' => array(),
        ),
        'Opera Mini'               => array(
            'alias'    => array('Opera Mini'),
            'excludes' => array(),
        ),
        'Opera 34'                 => array(
            'alias'    => array('OPR/34.'),
            'excludes' => array(),
        ),
        'Opera 33'                 => array(
            'alias'    => array('OPR/33.'),
            'excludes' => array(),
        ),
        'Opera 32'                 => array(
            'alias'    => array('OPR/32.'),
            'excludes' => array(),
        ),
        'Opera 31'                 => array(
            'alias'    => array('OPR/31.'),
            'excludes' => array(),
        ),
        'Opera 30'                 => array(
            'alias'    => array('OPR/30.'),
            'excludes' => array(),
        ),
        'Opera 29'                 => array(
            'alias'    => array('OPR/29.'),
            'excludes' => array(),
        ),
        'Opera 28'                 => array(
            'alias'    => array('OPR/28.'),
            'excludes' => array(),
        ),
        'Opera 27'                 => array(
            'alias'    => array('OPR/27.'),
            'excludes' => array(),
        ),
        'Opera 26'                 => array(
            'alias'    => array('OPR/26.'),
            'excludes' => array(),
        ),
        'Opera 25'                 => array(
            'alias'    => array('OPR/25.'),
            'excludes' => array(),
        ),
        'Opera 24'                 => array(
            'alias'    => array('OPR/24.'),
            'excludes' => array(),
        ),
        'Opera 23'                 => array(
            'alias'    => array('OPR/23.'),
            'excludes' => array(),
        ),
        'Opera 20'                 => array(
            'alias'    => array('OPR/20.'),
            'excludes' => array(),
        ),
        'Opera 19'                 => array(
            'alias'    => array('OPR/19.'),
            'excludes' => array(),
        ),
        'Opera 18'                 => array(
            'alias'    => array('OPR/18.'),
            'excludes' => array(),
        ),
        'Opera 17'                 => array(
            'alias'    => array('OPR/17.'),
            'excludes' => array(),
        ),
        'Opera 16'                 => array(
            'alias'    => array('OPR/16.'),
            'excludes' => array(),
        ),
        'Opera 15'                 => array(
            'alias'    => array('OPR/15.'),
            'excludes' => array(),
        ),
        'Opera 12'                 => array(
            'alias'    => array('Opera/12', 'Version/12.'),
            'excludes' => array(),
        ),
        'Opera 11'                 => array(
            'alias'    => array('Version/11.'),
            'excludes' => array(),
        ),
        'Opera 10'                 => array(
            'alias'    => array('Opera/9.8'),
            'excludes' => array(),
        ),
        'Opera 9'                  => array(
            'alias'    => array('Opera/9'),
            'excludes' => array(),
        ),
        'Opera'                    => array(
            'alias'    => array(' OPR/', 'Opera'),
            'excludes' => array(),
        ),
        'Konqueror'                => array(
            'alias'    => array('Konqueror'),
            'excludes' => array('Exabot'),
        ),
        'Samsung Dolphin 2'        => array(
            'alias'    => array('Dolfin/2'),
            'excludes' => array(),
        ),
        'iTunes'                   => array(
            'alias'    => array('iTunes'),
            'excludes' => array(),
        ),
        'App Store'                => array(
            'alias'    => array('MacAppStore'),
            'excludes' => array(),
        ),
        'Adobe AIR application'    => array(
            'alias'    => array('AdobeAIR'),
            'excludes' => array(),
        ),
        'Apple WebKit'             => array(
            'alias'    => array('AppleWebKit'),
            'excludes' => array('bot', 'preview', 'OPR/', 'Coast/', 'Vivaldi', 'Phantom'),
        ),
        'Lotus Notes'              => array(
            'alias'    => array('Lotus-Notes'),
            'excludes' => array(),
        ),
        'Camino'                   => array(
            'alias'    => array('Camino'),
            'excludes' => array(),
        ),
        'Camino 2'                 => array(
            'alias'    => array('Camino/2'),
            'excludes' => array(),
        ),
        'Flock'                    => array(
            'alias'    => array('Flock'),
            'excludes' => array(),
        ),
        'Thunderbird 12'           => array(
            'alias'    => array('Thunderbird/12'),
            'excludes' => array(),
        ),
        'Thunderbird 11'           => array(
            'alias'    => array('Thunderbird/11'),
            'excludes' => array(),
        ),
        'Thunderbird 10'           => array(
            'alias'    => array('Thunderbird/10'),
            'excludes' => array(),
        ),
        'Thunderbird 8'            => array(
            'alias'    => array('Thunderbird/8'),
            'excludes' => array(),
        ),
        'Thunderbird 7'            => array(
            'alias'    => array('Thunderbird/7'),
            'excludes' => array(),
        ),
        'Thunderbird 6'            => array(
            'alias'    => array('Thunderbird/6'),
            'excludes' => array(),
        ),
        'Thunderbird 3'            => array(
            'alias'    => array('Thunderbird/3'),
            'excludes' => array(),
        ),
        'Thunderbird 2'            => array(
            'alias'    => array('Thunderbird/2'),
            'excludes' => array(),
        ),
        'Thunderbird'              => array(
            'alias'    => array('Thunderbird'),
            'excludes' => array(),
        ),
        'Vivaldi'                  => array(
            'alias'    => array('Vivaldi'),
            'excludes' => array(),
        ),
        'SeaMonkey'                => array(
            'alias'    => array('SeaMonkey'),
            'excludes' => array(),
        ),
        'Mobil Robot/Spider'       => array(
            'alias'    => array('Googlebot-Mobile'),
            'excludes' => array(),
        ),
        'Robot/Spider'             => array(
            'alias'    => array('Googlebot', 'Mediapartners-Google', 'Web Preview', 'bot', 'Applebot', 'spider', 'crawler', 'Feedfetcher', 'Slurp',
                'Twiceler', 'Nutch', 'BecomeBot', 'bingbot', 'BingPreview', 'Google Web Preview', 'WordPress.com mShots', 'Seznam',
                'facebookexternalhit', 'YandexMarket', 'Teoma', 'ThumbSniper', 'Phantom'),
            'excludes' => array(),
        ),
        'Mozilla'                  => array(
            'alias'    => array('Mozilla', 'Moozilla'),
            'excludes' => array('ggpht.com'),
        ),
        'CFNetwork'                => array(
            'alias'    => array('CFNetwork'),
            'excludes' => array(),
        ),
        'Eudora'                   => array(
            'alias'    => array('Eudora', 'EUDORA'),
            'excludes' => array(),
        ),
        'PocoMail'                 => array(
            'alias'    => array('PocoMail'),
            'excludes' => array(),
        ),
        'The Bat!'                 => array(
            'alias'    => array('The Bat'),
            'excludes' => array(),
        ),
        'NetFront'                 => array(
            'alias'    => array('NetFront'),
            'excludes' => array(),
        ),
        'Evolution'                => array(
            'alias'    => array('CamelHttpStream'),
            'excludes' => array(),
        ),
        'Lynx'                     => array(
            'alias'    => array('Lynx'),
            'excludes' => array(),
        ),
        'Downloading Tool'         => array(
            'alias'    => array('cURL', 'wget', 'ggpht.com', 'Apache-HttpClient'),
            'excludes' => array(),
        ),
        'Unknown'                  => array(
            'alias'    => array(),
            'excludes' => array(),
        ),
    );

    public function __construct()
    {

    }
    public function get_user_info()
    {

        $_useragent = request()->header('user-agent');
        $os         = $this->_getclientoperation_for_userauth($_useragent);

        $ie = $this->_getclientbrowser_for_userauth($_useragent);
        return $ie . '(' . $os . ')';

    }

/**
36  * 从 user-agent 通过映射关系获取 浏览器信息
37  */
    public function _getclientbrowser_for_userauth($_useragent)
    {
        if (!empty($_useragent)) {
            $ua          = strtolower($_useragent);
            $browser_map = array();

            $browser_map = $this->browser_map;
            foreach ($browser_map as $name => $alias_excludes) {
                if (isset($alias_excludes['alias']) && is_array($alias_excludes['alias']) && sizeof($alias_excludes['alias']) > 0) {
                    foreach ($alias_excludes['alias'] as $a) {
                        $a       = strtolower($a);
                        $_a_pos  = strpos($ua, $a);
                        $_ex_pos = false;
                        if ($_a_pos !== false) {
                            if (isset($alias_excludes['excludes']) && is_array($alias_excludes['excludes']) && sizeof($alias_excludes['excludes']) > 0) {
                                foreach ($alias_excludes['excludes'] as $ex) {
                                    $ex      = strtolower($ex);
                                    $_ex_pos = strpos($ua, $ex);
                                }
                            }
                            if (isset($_a_pos) && isset($_ex_pos) && $_a_pos !== false && $_ex_pos === false) {
                                return $name;
                            }
                        }
                    }
                }
            }
        }
    }

/**
 * 从 user-agent 通过映射关系获取 操作系统信息
 */
    public function _getclientoperation_for_userauth($_useragent)
    {
        if (!empty($_useragent)) {
            $ua            = strtolower($_useragent);
            $operation_map = array();

            $operation_map = $this->operation_map;
            foreach ($operation_map as $name => $alias_excludes) {
                if (isset($alias_excludes['alias']) && is_array($alias_excludes['alias']) && sizeof($alias_excludes['alias']) > 0) {
                    foreach ($alias_excludes['alias'] as $a) {
                        $a       = strtolower($a);
                        $_a_pos  = strpos($ua, $a);
                        $_ex_pos = false;
                        if ($_a_pos !== false) {
                            if (isset($alias_excludes['excludes']) && is_array($alias_excludes['excludes']) && sizeof($alias_excludes['excludes']) > 0) {
                                foreach ($alias_excludes['excludes'] as $ex) {
                                    $ex      = strtolower($ex);
                                    $_ex_pos = strpos($ua, $ex);
                                }
                            }
                            if (isset($_a_pos) && isset($_ex_pos) && $_a_pos !== false && $_ex_pos === false) {
                                return $name;
                            }
                        }
                    }
                }
            }
        }
        return false;
    }

}
