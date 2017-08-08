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
     * test case 原子性目标的key
     * @var string
     */
    protected $strTargetKey;

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
        $this->intLoopNum = 100000;
        $this->strTargetKey = 'counter';
    }

    /**
     * testcase for incre function of redis
     */
    public function testCaseForIncr()
    {
        Timer::start('testcaseforinc');
        Logger::log("测试:incr 原子性 对比原始");
        Logger::log("原始值：". $this->objRedisConn->get($this->strTargetKey));
        for ($i = 0; $i < $this->intLoopNum; $i++) {
//            $this->mockIncr();
            $this->mockIncr(false);
        }
        Logger::log("目标值：". $this->objRedisConn->get($this->strTargetKey));
        $floatExecuteTIme = Timer::stop('testcaseforinc');
        Logger::log("测试:incr 原子性 对比原始 执行时间:". $floatExecuteTIme);
    }

    /**
     * mock increment
     * @param bool $bolIsAtomic 原子性，默认为是
     */
    public function mockIncr($bolIsAtomic = true)
    {
        if ($bolIsAtomic) {
            $this->objRedisConn->incr($this->strTargetKey);
        } else {
            $strValue = $this->objRedisConn->get($this->strTargetKey);
            if (empty($strValue)) {
                $strValue = 0;
            }
            $strValue++;
            $this->objRedisConn->set($this->strTargetKey, $strValue);
        }
    }
}

$atomicIncr = new AtomicIncr();
$atomicIncr->testCaseForIncr();
