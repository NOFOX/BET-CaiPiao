<?php
// 上/下半场入球较多统计定时任务

require_once 'global.func.php';
require_once 'conn.php';

// 联赛编号
$sql = "SELECT competitionid FROM `ft_competition`;";
$rst = $mysqli->query($sql);
$competitionids = array_column($rst->fetch_all(MYSQLI_ASSOC),'competitionid');

// 从7m接口获取数据并写入本地数据库
$sql = "REPLACE INTO `ft_hsscores_stats` VALUES(?,?,?,?,?,?,?,?);";
if ($stmt = $mysqli->prepare($sql))
{
    foreach ($competitionids as $competitionid)
    {
        // 通过接口获取数据
        $method = 'type=getcompetitionhsscores&p1='.$competitionid;
        $return = http_get(proxy_url().$method);

        // 确认返回数据格式正确
        if (is_array($return) && !empty($return) && !isset($return['error']))
        {
            $team = $return['Team'];
            foreach($return['Stats'] as $type => $info)
            {
                foreach($info as $teaminfo)
                {
                    $stmt->bind_param('isissiii',
                        $competitionid, 					        // 联赛编号
                        strtolower($type), 				            // 统计类别
                        $teaminfo['TeamId'], 			            // 球队编号
                        $team[$teaminfo['TeamId']]['Name'], 	    // 球队名称
                        $team[$teaminfo['TeamId']]['ShortName'], 	// 球队简称
                        $teaminfo['Data'][0], 		                // 上半场入球较多次数
                        $teaminfo['Data'][1], 		                // 上下半场入球相同次数
                        $teaminfo['Data'][2] 		                // 下半场入球较多次数
                    );

                    $stmt->execute();
                }
            }
            cron_log('IP:' . IP . ' ' . $method . ' 请求接口数据成功');
        } elseif (isset($return['error'])) {
            cron_log('IP:' . IP . ' ' . $method . ' ' . $return['error'], 1);
        } elseif (empty($return)) {
            cron_log('IP:' . IP . ' ' . $method . ' 空值' . json_encode($return), 1);
        } else {
            cron_log('IP:' . IP . ' ' . $method . ' 网络错误', 1);
        }

        unset($return);
    }

    $stmt->close();
}
else
{
    cron_log('初始化语句对象失败。', 2);
}


// 关闭mysql连接
$mysqli->close();
