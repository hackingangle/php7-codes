<?php
require './vendor/autoload.php';
require './Log.php';
require './Timer.php';

class AtomicIncr {
    /**
     * redis connection
     * @var Predis\Client
     */
    protected $objRedisConn;

    /**
     * test case 循环次数
     * @var integer
     */
    protected $intLoopNum;

    /**
     * test case 原子性key
     * @var string
     */
    protected $strAtomicKey;

    /**
     * test case 非原子性key
     * @var string
     */
    protected $strNonAtomicKey;

    /**
     * AtomicIncr constructor
     */
    public function __construct()
    {
        Timer::start('redisconn');
        $this->objRedisConn = new Predis\Client([
            'scheme' => 'tcp',
            'host'   => '127.0.0.1',
            'port'   => 6379,
        ]);
        $floatConnTime = Timer::stop('redisconn');
        Logger::log("redis连接耗时:". $floatConnTime * 1000 . 'ms');
        $this->intLoopNum = 1000;
        $this->strAtomicKey = 'atomic:counter';
        $this->strNonAtomicKey = 'nonatomic:counter';
    }

    /**
     * testcase for incre function of redis
     */
    public function testCaseForIncr()
    {
        for ($i = 0; $i < $this->intLoopNum; $i++) {
            $this->mockIncr();
            $this->mockIncr(false);
        }
    }

    /**
     * mock increment
     * @param bool $bolIsAtomic 原子性，默认为是
     */
    public function mockIncr($bolIsAtomic = true)
    {
        if ($bolIsAtomic) {
            $this->objRedisConn->incr($this->strAtomicKey);
        } else {
            $strValue = $this->objRedisConn->get($this->strNonAtomicKey);
            if (empty($strValue)) {
                $strValue = 0;
            }
            $strValue++;
            $this->objRedisConn->set($this->strNonAtomicKey, $strValue);
        }
    }
}

$atomicIncr = new AtomicIncr();
$atomicIncr->testCaseForIncr();
