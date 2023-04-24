<?php
namespace app\api\controller;

require_once "Lib/Keccak.php";
use app\common\controller\Base;
use kornrunner\Keccak;
use xtype\Ethereum\Utils;

class Transusdt extends Base
{

    public $from       = '';
    public $address    = '';
    public $PrivateKey = '';
    public $gas        = 5000;
    public $num        = 0;

    public function __construct($from, $PrivateKey, $address, $num = 0, $gas = 5000)
    {
        $this->from       = $from;
        $this->PrivateKey = $PrivateKey;
        $this->address    = $address;
        $this->num        = $num;
        $this->gas        = $gas;
        require_once "../vendor/autoload.php";

        $infura_url = 'https://mainnet.infura.io/v3/' . config('app.infuraId');
        $client     = new \xtype\Ethereum\Client([
            'base_uri' => $infura_url,
            'timeout'  => 30,
        ]);

        $client->addPrivateKeys(['b859b66348aa09f190f8f1811b907a7a8cb8b9d8e0b8c30aaf12bbafa96a2348']);

// 2. 建立您的交易
        $trans = [
            "from"  => $this->from,
            "to"    => $contract, //合约地址
            "value" => '0x0',
            // "data" => '0x',
        ];

//tranfer的abi名称
        $str = "transfer(address,uint256)";
//SHA-3，之前名为Keccak算法，是一个加密杂凑算法。
        $hash = Keccak::hash("transfer(address,uint256)", 256);

        $hash_sub = mb_substr($hash, 0, 8, 'utf-8');
//接收地址
        $fill_from = self::fill0(Utils::remove0x($this->address));

//转账金额
        $num10 = \xtype\Ethereum\Utils::ethToWei($this->num);
        $num16 = \xtype\Ethereum\Utils::decToHex($num10);

        $fill_num16 = self::fill0(Utils::remove0x($num16));

//开始拼接
        $trans['data'] = "0x" . $hash_sub . $fill_from . $fill_num16;

        $trans['gas'] = 50000;

        $trans['gasPrice'] = $client->eth_gasPrice();

        $trans['nonce'] = $client->eth_getTransactionCount($this->from, 'pending');

// 3. 发送您的交易
        // 如果需要服务器，也可以使用eth_sendTransaction
        $txid = $client->sendTransaction($trans);

        return $client->eth_getTransactionReceipt($txid);

    }

    /**
     * 字符串长度 ‘0’左补齐
     * @param string $str   原始字符串
     * @param int $bit      字符串总长度
     * @return string       真实字符串
     */
    public static function fill0($str, $bit = 64)
    {
        if (!strlen($str)) {
            return "";
        }

        $str_len = strlen($str);
        $zero    = '';
        for ($i = $str_len; $i < $bit; $i++) {
            $zero .= "0";
        }
        $real_str = $zero . $str;
        return $real_str;
    }
}
