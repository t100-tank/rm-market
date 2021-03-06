<?php


/**
 * Skeleton subclass for performing query and update operations on the 'field' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * 09/24/13 12:52:40
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class FieldPeer extends BaseFieldPeer {
    static $field_types = array(
        'text' => 'text',
        'textarea' => 'textarea',
        'checkbox' => 'checkbox',
        'select' => 'select',
        'radio' => 'radio',
        'datepicker' => 'datepicker'
    );
    
    public static function getFieldTypes() {
        return self::$field_types;
    }
    
    public static function getMaxSort($formId) {
        $sql = "SELECT MAX(".self::SORT.") FROM ".self::TABLE_NAME." WHERE ".self::FORM_ID." = :form_id;";
        $con = Propel::getConnection();
        $stmt = $con->prepare($sql);
        $stmt->execute(array('form_id' => $formId));
        $cnt = 0;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $cnt = (int)$row[0];
        }
        $cnt++;
        return $cnt;
    }
} // FieldPeer
