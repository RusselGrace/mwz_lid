<?php
class CustomFieldResolver {
  // MMTA-12 Investigate populating person zoho id on campaign bounced/unsubscribed pages
  public static function getSubscriberCustomFieldValue($subscriber, $customFieldLabel) {
    try {
      if (!isset($subscriber->fieldValues)) {
        return "-subscriber->fieldValues not set-";
      }

      $customFieldLabel = strtolower($customFieldLabel);
      foreach($subscriber->fieldValues as $fieldValue) {
        if (strtolower($fieldValue->field->label) == $customFieldLabel) {
            return $fieldValue->value;
        }
      }
    } catch (\Throwable $th) {
      return "-error-";
    }

    return "-not found-";
  }
}
?>