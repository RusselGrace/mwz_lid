<?php
class CustomFieldResolver {
  // 
  public static function getSubscriberCustomFieldValue($subscriber, $customFieldLabel) {
    try {
      if (!isset($subscriber->fieldValues)) {
        return "-subscriber->fieldValues not set-";
      }

      $asd = array();
      $customFieldLabel = 'alexcustomfield';
      foreach($subscriber->fieldValues as $fieldValue) {
        $asd[] = $fieldValue->value;
        if (strtolower($fieldValue->field->label) == $customFieldLabel) {
            return $fieldValue->value;
        }
      }


      var_dump($asd);
    } catch (\Throwable $th) {
      return "-error-";
    }

    return "-not found-";
  }
}
?>
