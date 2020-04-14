<?php defined('MW_PATH') || exit('No direct script access allowed');

class Tracking_domains_aeController extends Controller
{
    // access rules for this controller
    public function accessRules()
    {
        return array(
            // allow all authenticated users on all actions
            array('allow', 'users' => array('@')),
            // deny all rule.
            array('deny'),
        );
    }

     /**
     * List all available tracking domains
     */
    public function actionIndex()
    {
        $data = array(
            'count'         => null,
            'records'       => array(),
        );

        $criteria = new CDbCriteria();
        $criteria->compare('customer_id', (int)Yii::app()->user->getId());

        $data['records'] = TrackingDomain::model()->findAll($criteria);
        $data['count'] = count($data['records']);
        
        return $this->renderJson(array(
            'status'    => 'success',
            'data'      => $data
        ), 200);
    }
}