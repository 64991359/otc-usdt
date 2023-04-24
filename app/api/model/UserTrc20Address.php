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
use PHPUnit\Framework\TestCase;
use Tron\Address;
use Tron\Api;
use Tron\TRC20;

class UserTrc20Address extends TimeModel
{
 protected $name = "user_address";
 protected $autoWriteTimestamp = true;
    const URI =  'https://api.trongrid.io';// mainnet
    const ADDRESS = 'TGytofNKuSReFmFxsgnNx19em3BAVBTpVB';
    const PRIVATE_KEY = '0xf1b4b7d86a3eff98f1bace9cb2665d0cad3a3f949bc74a7ffb2aaa968c07f521';
    const BLOCK_ID = 13402554;
    const TX_HASH = '539e6c2429f19a8626fadc1211985728e310f5bd5d2749c88db2e3f22a8fdf69';
    const CONTRACT = [
        'contract_address' => 'TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t', // USDT TRC20
        'decimals' => 6,
    ];
  protected $TrcObj = "";
  
    public function __construct(){
        
    $this->TrcObj =  new \Tron\Api(new Client(['base_uri' => UserTrc20Address::URI]));
    }
 private function getTRC20()
    {
        $api = new Api(new Client(['base_uri' => self::URI]));
        $config = self::CONTRACT;
        $trxWallet = new TRC20($api, $config);
        return $trxWallet;
    }

 public function trc20_generate_address(){

$trc20Wallet = new \Tron\TRC20($this->TrcObj, UserTrc20Address::CONTRACT);
$addressData = $trc20Wallet->generateAddress();
 $return=array();
 $return['privateKey']=$addressData->privateKey;
 $return['address']=$addressData->address;  
 return $return;
 }
 public function trc20_private_key_to_address($privateKeyHex){

     $trc20Wallet = new \Tron\TRC20($this->TrcObj, UserTrc20Address::CONTRACT);
     
    return  $trc20Wallet->privateKeyToAddress($privateKeyHex)->address;
 }
 
  public function trc20_balance($address){
      
       $address = new Address(
            $address,
            '',
            $this->getTRC20()->tron->address2HexString($address)
        );
        $balanceData = $this->getTRC20()->balance($address);
    

    
     
    return  $balanceData;
 }
 
 
     public function trc20_transfer($privateKey,$toAddress,$amount)
    {
      $str =substr($privateKey , 0 , 2); 
  
   if($str=='0x'||$str=='0X'){
       $privateKey = substr($privateKey , 2);
   }
   if(empty($privateKey)){
       return false;
   }
        $from = $this->getTRC20()->privateKeyToAddress($privateKey);
        $to = new Address(
            $toAddress,
            '',
            $this->getTRC20()->tron->address2HexString($toAddress)
        );
        $transferData = $this->getTRC20()->transfer($from, $to, $amount);
       // var_dump($transferData);
        return $transferData;
      
    }
    
    
      public function trc20_transaction_receipt($txHash)
    {
       
        $txData = $this->getTRC20()->transactionReceipt($txHash);
       return $txData;

    
    }
}