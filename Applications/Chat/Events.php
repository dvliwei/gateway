<?php
/**
 * 业务开发只需要关注 Applications/项目/Events.php一个文件即可。
 * Created by PhpStorm.
 * User: liwei
 * Date: 2018/7/5
 * Time: 上午11:23
 */

use \GatewayWorker\Lib\Gateway;
class Events
{

    /**
     * 启动进程事件
     */
    public static function onWorkerStart(){
        // 向所有人发送
        Gateway::sendToAll("login");
    }
    /**
     * 当客户端连接时触发
     * 如果业务不需此回调可以删除onConnect
     * @param int $client_id 连接id
     */
    public static function onConnect($client_id)
    {
        // 向当前client_id发送数据
        Gateway::sendToClient($client_id, "Hello $client_id");
        // 向所有人发送
        Gateway::sendToAll("$client_id login");
    }

    /**
     * 当客户端发来消息时触发
     * @param int $client_id 连接id
     * @param string $message 具体消息
     */
    public static function onMessage($client_id, $message)
    {
        Gateway::sendToClient($client_id, "$client_id said $message");
        // 向所有人发送
        Gateway::sendToAll("广播发出$client_id said $message");
    }

    /**
     * 当用户断开连接时触发
     * @param int $client_id 连接id
     */
    public static function onClose($client_id)
    {
        // 向所有人发送
        GateWay::sendToAll("$client_id logout");
    }

}