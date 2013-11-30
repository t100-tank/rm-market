<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardPermissionPeer.php 7634 2008-02-27 18:01:40Z fabien $
 */
class sfGuardPermissionPeer extends PluginsfGuardPermissionPeer {
    
    public static function retrieveAllByUserId($userId) {
        $con = Propel::getConnection();
        $sql = "
            SELECT DISTINCT
                ".implode(', ', self::getFieldNames(BasePeer::TYPE_COLNAME))."
            FROM
                ".self::TABLE_NAME." LEFT JOIN
                ".sfGuardUserPermissionPeer::TABLE_NAME." ON ".sfGuardPermissionPeer::ID." = ".sfGuardUserPermissionPeer::PERMISSION_ID." LEFT JOIN
                ".sfGuardGroupPermissionPeer::TABLE_NAME." ON ".sfGuardPermissionPeer::ID." = ".sfGuardGroupPermissionPeer::PERMISSION_ID." LEFT JOIN
                ".sfGuardUserGroupPeer::TABLE_NAME." ON ".sfGuardGroupPermissionPeer::GROUP_ID." = ".sfGuardUserGroupPeer::GROUP_ID."
            WHERE
                ".sfGuardUserPermissionPeer::USER_ID." = :user_id OR
                ".sfGuardUserGroupPeer::USER_ID." = :user_id
            ;";
        $stmt = $con->prepare($sql);
        $stmt->execute(array(':user_id' => $userId));
        $permissions = array();
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $permission = new sfGuardPermission();
            $permission->fromArray($row);
            $permissions[$row[1]] = $permission;
        }
        return $permissions;
    }
    
}
