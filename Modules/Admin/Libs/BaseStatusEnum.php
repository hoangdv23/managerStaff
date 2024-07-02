<?php
namespace Modules\Admin\Libs\Enums;

/**
 * @method static BaseStatusEnum DRAFT()
 * @method static BaseStatusEnum PUBLISHED()
 * @method static BaseStatusEnum PENDING()
 */
class BaseStatusEnum
{
    public const PROCESS = 'process';
    public const REJECT = 'reject';
    public const DONE = 'done';
    public const APPROVE = 'approve';
    public const SENT = 'sent';

    public static function get($status)
    {
        $arr = self::getAll();
        /*if (isset($arr[$status])) {
            return $arr[$status];
        }
        return __('Pending');*/
    }

    public static function getAll()
    {
        return array(
            self::PROCESS => __('Process'),
            self::REJECT => __('Reject'),
            self::DONE => __('Done'),
            self::APPROVE => __('Approve'),
            self::SENT => __('Sent')
        );
    }
}
