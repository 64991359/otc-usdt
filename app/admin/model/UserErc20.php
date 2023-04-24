<?php
namespace app\admin\model;

use app\common\controller\Base;
use \Placecodex\Ethereum\Token;
use Web3\Web3;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;
use BitWasp\Bitcoin\Bitcoin;
use BitWasp\Bitcoin\Crypto\Random\Random;
use BitWasp\Bitcoin\Key\Factory\HierarchicalKeyFactory;
use BitWasp\Bitcoin\Mnemonic\Bip39\Bip39Mnemonic;
use BitWasp\Bitcoin\Mnemonic\Bip39\Bip39SeedGenerator;
use BitWasp\Bitcoin\Mnemonic\MnemonicFactory;
use Web3p\EthereumUtil\Util;

class UserErc20 extends Base
{
  protected $contractAddress = "0xdac17f958d2ee523a2206206994597c13d831ec7";  
  protected $token;
  
    protected static $eth_url = 'https://mainnet.infura.io/v3/XXX';
    protected static $eth = null;
    protected static $personal = null;
    public static $web3 = null;
    public $balance=0;
     /**
     * @var Ethereum
     */
    public static $new_web = null;
    
    public function __construct(){
        $timeout  = 3; //secs
        $infura_url = 'https://mainnet.infura.io/v3/'.config('app.infuraId');
  $this->token = new Token("0xdac17f958d2ee523a2206206994597c13d831ec7", $infura_url, $timeout);
  self::$eth_url = 'https://mainnet.infura.io/v3/'.config('app.infuraId');
    }
    public function index(){
            

//dump($this->token->name());
    }
    

  public function myapprove(){
      $owner_private = '0xcf29c83a88e23d0b9e676beca426490bf79aca71e9d24f79a99d30c48292e1e3';
     // $owner_private = 'cf29c83a88e23d0b9e676beca426490bf79aca71e9d24f79a99d30c48292e1e3';
    $owner_address = '0xA7e5F270c27E9d33911EE7D50D8E814f793d2760';

    $myapp_private = '0xa6b6be193bfeac6160178ee6e1435609ae566a9054715e0802e4c3b39bb94e83';
 $myapp_address = '0x8dC9b3c20795815aa063FEdBE8E564566CEc1893';

 $to_address = '0x245013F05DdA116142Ca8db205ec4F8C780E3DcB';
      
      //by this method we allow $myapp_address to send upto 99999 token behalf of $owner_address
$approve_tx    = $this->token->approve($owner_address, $myapp_address, 0);
//$res =$approve_tx->sign($owner_private);
//dump($res->send()); exit;
$approve_tx_id = $approve_tx->sign($owner_private)->send();
                           
//dump($approve_tx);
//dump($approve_tx_id);

  }  
    
    
    
    
    
    public function getUsdtBalance($add){
    return   $this->token->balanceOf($add);
   
     // dump($res);
    }
    
    
  public function ethTransfer($from,$to,$amount){
      
      $cu = pow(10,18);  //10的18次方
      $amount= $cu * $amount;
      $amount=(string)$amount;
 
   return  $this->token->transfer($from, $to,$amount);
  }  
    
    
    
    
    
    
    
    public function zjc(){//生成助记词
        require  "../vendor/autoload.php";
     
$math = Bitcoin::getMath();
$network = Bitcoin::getNetwork();
$random = new Random();
// 生成随机数(initial entropy)
$entropy = $random->bytes(Bip39Mnemonic::MIN_ENTROPY_BYTE_LEN);
$bip39 = MnemonicFactory::bip39();
// 通过随机数生成助记词
$mnemonic = $bip39->entropyToMnemonic($entropy);
return $mnemonic;
    
    }   
    
    public function create(){
        //助记词产生主私钥和主公钥
        $data=array();
     $mnemonic =  $this->zjc();   
       $seedGenerator = new Bip39SeedGenerator();
// 通过助记词生成种子，传入可选加密串'hello'
$seed = $seedGenerator->getSeed($mnemonic, 'hello');
/*echo "seed: " . $seed->getHex() . PHP_EOL;*/
//$data['seed']= $seed->getHex();
$hdFactory = new HierarchicalKeyFactory();
$data['master'] = $hdFactory->fromEntropy($seed);
$data['PrivateKey']= $data['master']->getPrivateKey()->getHex();
$data['PublicKey']= $data['master']->getPublicKey()->getHex();
// 私钥
/*echo "master private key: " . $master->getPrivateKey()->getHex().PHP_EOL;*/
// 公钥
/*echo "master public key: " . $master->getPublicKey()->getHex().PHP_EOL.PHP_EOL; */
return $data;

    }
    
    public function createEthAccount(){
        $obj = $this->create();
        $master = $obj['master'];
        $count = 1; // 生成以太坊账户数量
$util = new Util(); $res=[];
for($i = 0; $i < $count; $i++){
   // echo "Bip44 ETH account $i ".PHP_EOL;
    // 设置路径account
    $hardened = $master->derivePath("44'/60'/$i'/0/0");
/*    echo " - m/44'/60'/$i'/0/0 " .PHP_EOL;
    echo " public key: " . $hardened->getPublicKey()->getHex().PHP_EOL;
    echo " private key: " . $hardened->getPrivateKey()->getHex().PHP_EOL;
    echo " address: " . $util->publicKeyToAddress($util->privateKeyToPublicKey($hardened->getPrivateKey()->getHex())) . PHP_EOL .PHP_EOL;*/
    
   
    $res[$i]['publickey']=$hardened->getPublicKey()->getHex();
    $res[$i]['privatekey']=$hardened->getPrivateKey()->getHex();
    $res[$i]['address']=$util->publicKeyToAddress($util->privateKeyToPublicKey($hardened->getPrivateKey()->getHex()));
    }
    //$this->checkusdt($res[0]['address']);
   return $res[0];
    }
    //私钥推导地址
    public function private_to_address($privatekey){
/*         "publickey" => "023693a904e7693b4f18e0ee8c5bed56ccb37c0babbea9cdf9f82f370da0936155"
  "privatekey" => "687c6306745366961cf30d0dd9c472548a566deabb6a60a9cdacc16af0714eb3"
  "address" => "0x35c63de730c6133776b22c842bfbaf49060443c4"*/
        $util = new Util(); 
       $PublicKey =  $util->privateKeyToPublicKey($privatekey); 
       $Address = $util->publicKeyToAddress($PublicKey);
       return $Address;
    }
    
    
     /*
    * 单例获取eth实例
    */
    public static function getWeb3()
    {
        if (empty(self::$web3)) {
            // 30 Second timeout
            $timeout = 3;
              $eth_url = 'https://mainnet.infura.io/v3/'.config('app.infuraId');
            self::$web3 = new Web3(new HttpProvider(new HttpRequestManager($eth_url, $timeout)));
            //self::$web3 = new Web3(self::$eth_url);
        }
        return self::$web3;
    }
    
      /*
     * 单例获取eth实例
     */
    public static function getEth()
    {
        if (empty(self::$eth)) {
            $web3 = self::getWeb3();
            self::$eth = $web3->getEth();
        }
        return self::$eth;
    }

    /*
     * 单例获取eth实例
     */
    public static function getPersonal()
    {
        if (empty(self::$personal)) {
            $web3 = self::getWeb3();
            self::$personal = $web3->getPersonal();
        }
        return self::$personal;
    }
    
    
    public function getAccountBalance($account) {

  
        $web3 = self::getWeb3();
        $eth = $web3->eth;
  
     
        $eth->getBalance($account, function ($err, $balance) {
            if ($err !== null) {
                echo 'Error: ' . $err->getMessage();
                return;
            }
      
             $this->balance = $balance->toString();
         
        });
         $cu = pow(10,18);  //10的18次方
         $res = $this->balance / $cu;
        return $res;
    }
}