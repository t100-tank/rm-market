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
 * @version    SVN: $Id: sfGuardUserPeer.php 7634 2008-02-27 18:01:40Z fabien $
 */
class sfGuardUserPeer extends PluginsfGuardUserPeer {
    
    
    /**
     * Retrieve all activated users by permission
     * @param string $permission
     * @return array of activated users
     */
    static public function retrieveAllByPermission($permission) {
        if (!($permission instanceof sfGuardPermission)) {
            $permission = sfGuardPermissionPeer::retrieveByName($permission);
        }
        
        if ($permission instanceof sfGuardPermission) {
            $c = new Criteria();
            $c->addJoin(self::ID, sfGuardUserPermissionPeer::USER_ID, Criteria::LEFT_JOIN);
            $c->addJoin(self::ID, sfGuardUserGroupPeer::USER_ID, Criteria::LEFT_JOIN);
            $c->addJoin(sfGuardUserGroupPeer::GROUP_ID, sfGuardGroupPermissionPeer::GROUP_ID, Criteria::LEFT_JOIN);
            
            $ct1 = $c->getNewCriterion(sfGuardUserPermissionPeer::PERMISSION_ID, $permission->getId());
            $ct2 = $c->getNewCriterion(sfGuardGroupPermissionPeer::PERMISSION_ID, $permission->getId());
            $ct3 = $c->getNewCriterion(sfGuardUserPeer::IS_SUPER_ADMIN, 1);
            $ct1->addOr($ct2);
            $ct1->addOr($ct3);
            $c->add($ct1);
            $c->add(sfGuardUserPeer::IS_ACTIVE, 1);

            return self::doSelect($c);
        }
        return array();
    }
}
