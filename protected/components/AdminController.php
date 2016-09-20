<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class AdminController extends Controller
{
   // public $layout = '//layouts/admin/admin';
    public function init()
    {
         
        if(Yii::app()->user->getId()===null)
        {

              Yii::app()->user->setReturnUrl(Yii::app()->request->url);

              $this->redirect(Yii::app()->createUrl('admin/default/signin'));

        }
       else
        { 
           
              //throw new CHttpException(403,'You Have No Permission');

          }

    }

    
}