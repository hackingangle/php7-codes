<?php
exec('sh ./main_redis_incr.sh', $output);
echo implode("<br/>", $output);
