<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class UsersController extends Controller {

    public $layout='//layouts/frontendinner/frontend';

    public function init() {
        
        
        if (Yii::app()->user->getId() === null) {

            Yii::app()->user->setReturnUrl(Yii::app()->request->url);
            $this->redirect(Yii::app()->createUrl('/'));
            //$this->redirect(Yii::app()->user->loginUrl);
        } else {
//            if (!in_array(Yii::app()->user->role, array('user'))) {
//
//                throw new CHttpException(403, "You don't have permission to access this page.");
//            }

            /*             * ******** code to set user status(0/1) starts here **********/

            $userId = Yii::app()->user->id;
//            $user_site_info = ::model()->findByAttributes(array('login_id' => $userId));
//            if (!$user_site_info) {
//                $user_site_info = new UserSiteInfo;
//                $user_site_info->login_id = Yii::app()->user->id;
//            }
//            $user_site_info->last_visited = date('Y-m-d H:i:s');
//            $user_site_info->online_status = 1;
//            $user_site_info->save();
//            if ($user_site_info->online_status == 0) {
//                Yii::app()->user->logout();
//                $this->redirect(Yii::app()->homeUrl);
//            }


            /********** code to set user status(0/1) ends here **********/
        }
        parent::init();
    }


}