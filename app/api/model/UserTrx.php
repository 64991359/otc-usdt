<?php

// +----------------------------------------------------------------------
// | EasyAdmin
// +----------------------------------------------------------------------
// | PHP交流群: 763822524
// +----------------------------------------------------------------------
// | 开源协议  https://mit-license.org 
// +----------------------------------------------------------------------
// | github开源项目：https://github.com/zhongshaofa/EasyAdmin
// +----------------------------------------------------------------------


namespace app\api\model;


use app\common\model\TimeModel;
use GuzzleHttp\Client;
use Tron\Address;
use Tron\Api;
use Tron\TRX;

class UserTrx 
{
    const URI =  'https://api.trongrid.io';// mainnet
    const ADDRESS = 'TGytofNKuSReFmFxsgnNx19em3BAVBTpVB';
    const PRIVATE_KEY = '0xf1b4b7d86a3eff98f1bace9cb2665d0cad3a3f949bc74a7ffb2aaa968c07f521';
    const BLOCK_ID = 13402554;
    const TX_HASH = '539e6c2429f19a8626fadc1211985728e310f5bd5d2749c88db2e3f22a8fdf69';
    
      private function getTRX()
    {
        $api = new Api(new Client(['base_uri' => self::URI]));
        $trxWallet = new TRX($api);
        return $trxWallet;
    }
    
       public function trxBalance($add)
    {
        $address = new Address(
            $add,
            '',
            $this->getTRX()->tron->address2HexString($add)
        );
        return  $this->getTRX()->balance($address);
       // var_dump($balanceData);

        //$this->assertTrue(true);
    }
    
         public function trxvalidateAddress($add)
    {
        $address = new Address(
            $add,
            '',
            $this->getTRX()->tron->address2HexString($add)
        );
        $validateData = $this->getTRX()->validateAddress($address);
        //var_dump($validateData);
        return $validateData;
       // $this->assertTrue(true);
    }

    public function trxTransfer($privateKey,$address,$amount)
    {
        

        $from = $this->getTRX()->privateKeyToAddress($privateKey);
        $to = new Address(
            $address,
            '',
            $this->getTRX()->tron->address2HexString($address)
        );
        $transferData = $this->getTRX()->transfer($from, $to, $amount);
        //var_dump($transferData);
        return $transferData;
        //$this->assertTrue(true);
    }

public function keyToAddress($privateKey){
    return  $this->getTRX()->privateKeyToAddress($privateKey);
}
}