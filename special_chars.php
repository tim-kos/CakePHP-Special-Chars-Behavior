<?php
/**
 * CakePHP Behavior to replace special characters of a string with their standard latin chars.
 * Usage:
 * In your model's $actsAs variable add the behavior along with all from->to field combinations:
 *
 * var $actsAs = array(
 *  'SpecialChars' => array('fields' => array(
 *    'title' => 'clean_title',
 *    'body' => 'clean_body'
 *  ));
 * );
 *
 * @package default
 */
class SpecialCharsBehavior extends ModelBehavior {
  var $theList = array(
    'à' => 'a', 'À' => 'A', 'á' => 'a', 'Á' => 'A', 'â' => 'a', 'Â' => 'A',
    'ã' => 'a', 'Ã' => 'A', 'ä' => 'a', 'Ä' => 'A', 'å' => 'a', 'Å' => 'A',
    'æ' => 'a', 'Æ' => 'a', 'ā' => 'a', 'Ā' => 'A', 'ă' => 'a', 'Ă' => 'A',
    'ą' => 'a', 'Ą' => 'A', 'ć' => 'c', 'Ć' => 'C', 'č' => 'c', 'Č' => 'C',
    'ç' => 'c', 'Ç' => 'C', 'đ' => 'd', 'Ð' => 'D', 'ð' => 'd', 'Ð' => 'D',
    'ď' => 'd', 'Ď' => 'D', 'ē' => 'e', 'Ē' => 'E', 'è' => 'e', 'È' => 'E',
    'é' => 'e', 'É' => 'E', 'ë' => 'e', 'Ë' => 'E', 'ė' => 'e', 'Ė' => 'E',
    'ě' => 'e', 'Ě' => 'E', 'ę' => 'e', 'Ę' => 'E', 'ě' => 'e', 'Ě' => 'E',
    'ğ' => 'g', 'Ğ' => 'G', 'ī' => 'i', 'Ī' => 'I', 'į' => 'i', 'Į' => 'I',
    'í' => 'i', 'Í' => 'I', 'ì' => 'i', 'Ì' => 'I', 'î' => 'i', 'Î' => 'I',
    'ï' => 'i', 'Ï' => 'I', 'ł' => 'i', 'Ł' => 'I', 'ń' => 'n', 'Ń' => 'N',
    'ñ' => 'n', 'Ñ' => 'N', 'ň' => 'n', 'Ň' => 'N', 'ō' => 'o', 'Ō' => 'O',
    'ø' => 'o', 'Ø' => 'O', 'õ' => 'o', 'Õ' => 'O', 'ó' => 'o', 'Ó' => 'O',
    'ò' => 'o', 'Ò' => 'O', 'ö' => 'o', 'Ö' => 'O', 'ô' => 'o', 'Ô' => 'O',
    'œ' => 'o', 'Œ' => 'O', 'ř' => 'r', 'Ř' => 'R', 'ß' => 'ss', 'ś' => 's',
    'Ś' => 'S', 'ŝ' => 's', 'Ŝ' => 'S', 'ş' => 's', 'Ş' => 'S', 'š' => 's',
    'Š' => 'S', 'ţ' => 't', 'Ţ' => 'T', 'þ' => 't', 'Þ' => 'T', 'ť' => 't',
    'Ť' => 'T', 'ū' => 'u', 'Ū' => 'U', 'ü' => 'u', 'Ü' => 'U', 'ú' => 'u',
    'Ú' => 'U', 'ù' => 'u', 'Ù' => 'U', 'û' => 'u', 'Û' => 'U', 'ů' => 'u',
    'Ů' => 'U', 'ų' => 'u', 'Ų' => 'U', 'ū' => 'u', 'Ū' => 'U', 'ý' => 'y',
    'Ý' => 'Y', 'ÿ' => 'y', 'Ÿ' => 'Y', 'ź' => 'z', 'Ź' => 'Z', 'ž' => 'z',
    'Ž' => 'Z', 'ż' => 'z', 'Ż' => 'Z'
  );

  public function setup($Model, $settings = array()) {
    $default = array('fields' => array());
    $this->__settings[$Model->alias] = array_merge($default, $settings);
  }

  public function beforeSave($Model) {
    $return = parent::beforeSave($Model);

    $fields = $this->__settings[$Model->alias]['fields'];
    if (empty($fields)) {
      return $return;
    }

    foreach ($fields as $before => $after) {
      if (isset($Model->data[$Model->alias][$before])) {
        $val = $this->replaceSpecialChars($Model, $Model->data[$Model->alias][$before]);
        $Model->data[$Model->alias][$after] = $val;
      }
    }
    return $return;
  }

  public function replaceSpecialChars($Model, $txt) {
    return str_replace(array_keys($this->theList), array_values($this->theList), $txt);
  }
}