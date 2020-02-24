<?php
class CustomFieldResolver {
  // 
  public static function getSubscriberCustomFieldValue($subscriber, $customFieldLabel) {
    try {
      if (!isset($subscriber->fieldValues)) {
        return "-subscriber->fieldValues not set-";
      }

      // $asd = array();
      // $customFieldLabel = 'lead';
      foreach($subscriber->fieldValues as $fieldValue) {
        // $asd[] = $fieldValue->field->label;
        // $asd[] = '!_delim_!';
        if (strtolower($fieldValue->field->label) == strtolower($customFieldLabel)) {
            return $fieldValue->value;
        }
      }


      // var_dump($asd);
    } catch (\Throwable $th) {
      return "-error-";
    }

    return "-not found-";
  }
}
?>
