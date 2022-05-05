<?php
/*
 * Desc:
 * User: qmister
 * Date: 2021-10-25 22:24
 */

namespace whereof\easyIm\RongCloud\Constant;

/**
 * Class ObjectName.
 *
 * @author qmister
 */
class MessageType
{
    /**
     * 文本消息.
     */
    const TXT = 'RC:TxtMsg';
    /**
     * 图片消息.
     */
    const IMG = 'RC:ImgMsg';
    /**
     * GIF 图片消息.
     */
    const GIF = 'RC:GIFMsg';
    /**
     * 语音消息.
     */
    const HQVC = 'RC:HQVCMsg';
    /**
     * 文件消息.
     */
    const FILE = 'RC:FileMsg';
    /**
     * 小视频消息.
     */
    const SIGHT = 'RC:SightMsg';
    /**
     * 位置消息.
     */
    const LBS = 'RC:LBSMsg';

    /**
     * 引用消息.
     */
    const REFERENCE = 'RC:ReferenceMsg';

    /**
     * 合并转发消息.
     */
    const COMBINE = 'RC:CombineMsg';

    /**
     * 命令消息.
     */
    const CMD = 'RC:CmdMsg';
    /**
     * 提示小灰条消息.
     */
    const INFONTF = 'RC:InfoNtf';
    /**
     * 资料变更通知消息.
     */
    const PROFILENTF = 'RC:ProfileNtf';
    /**
     * 联系人(好友)通知消息.
     */
    const CONTACNTF = 'RC:ContactNtf';
    /**
     * 群组通知消息.
     */
    const GROUP = 'RC:GrpNtf';

    /**
     * 聊天室属性通知消息.
     */
    const ROOMKV = 'RC:chrmKVNotiMsg';

    /**
     * 对方正在输入状态消息.
     */
    const TYPESTS = 'RC:TypSts';
    /**
     * 单聊已读通知消息.
     */
    const READNTF = 'RC:ReadNtf';
    /**
     * 群已读状态请求消息.
     */
    const RRREQ = 'RC:RRReqMsg';
    /**
     * 群已读通知消息.
     */
    const RRRSP = 'RC:RRRspMsg';
    /**
     * 多端已读状态同步消息.
     */
    const SRS = 'RC:SRSMsg';
}
