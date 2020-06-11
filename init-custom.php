<?php
Yii::app()->hooks->addFilter('campaign_model_get_lists_dropdown_array_criteria', function($criteria){
    $criteria->order = 'date_added DESC';
    return $criteria;
});
