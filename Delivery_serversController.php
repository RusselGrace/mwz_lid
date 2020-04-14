<?php defined('MW_PATH') || exit('No direct script access allowed');

class Delivery_serversController extends Controller
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
     * List all available delivery servers
     */
    public function actionIndex()
    {
        $request    = Yii::app()->request;
        $perPage    = (int)$request->getQuery('per_page', 10);
        $page       = (int)$request->getQuery('page', 1);
        $maxPerPage = 10000;
        $minPerPage = 10;

        if ($perPage < $minPerPage) {
            $perPage = $minPerPage;
        }

        if ($perPage > $maxPerPage) {
            $perPage = $maxPerPage;
        }

        if ($page < 1) {
            $page = 1;
        }
        // $server     = new DeliveryServer('search');
        // $server->unsetAttributes();

        // $server->attributes = (array)$request->getQuery($server->modelName, array());

        $data = array(
            'count'         => null,
            'total_pages'   => null,
            'current_page'  => null,
            'next_page'     => null,
            'prev_page'     => null,
            'records'       => array(),
        );

        $criteria = new CDbCriteria();
        $criteria->compare('customer_id', (int)Yii::app()->user->getId());
        $criteria->addNotInCondition('status', array(DeliveryServer::STATUS_INACTIVE));

        $count = DeliveryServer::model()->count($criteria);

        if ($count == 0) {
            return $this->renderJson(array(
                'status'    => 'success',
                'data'      => $data
            ), 200);
        }

        $totalPages = ceil($count / $perPage);

        $data['count']          = $count;
        $data['current_page']   = $page;
        $data['next_page']      = $page < $totalPages ? $page + 1 : null;
        $data['prev_page']      = $page > 1 ? $page - 1 : null;
        $data['total_pages']    = $totalPages;
        
        $criteria->order    = 't.server_id DESC';
        $criteria->limit    = $perPage;
        $criteria->offset   = ($page - 1) * $perPage;

        $deliveryServers = DeliveryServer::model()->findAll($criteria);

        $data['records'] = $deliveryServers;

        return $this->renderJson(array(
            'status'    => 'success',
            'data'      => $data
        ), 200);
    }
}