#!/bin/bash
echo "删除历史记录"
redis-cli del atomic:counter
redis-cli del nonatomic:counter

echo "<hr/>"
echo "开始执行测试"

for intLoopNum in {1..10}
do
    nohup php main_redis_incr.php >> ./main_redis_incr.log &
done

sleep 2

echo "线程安全的执行结果："
redis-cli get atomic:counter

echo "非原子安全的执行结果："
redis-cli get nonatomic:counter
