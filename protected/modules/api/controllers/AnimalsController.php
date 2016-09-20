<?php

class AnimalsController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */

    public function actionAnimalslist($id = null) {
        //echo Yii::app()->request->getUrl(); die;

        if ($_GET == null) {
            $rawData = file_get_contents('php://input');
            $body = json_decode($rawData, true);
        } else {
            $body = $_GET;
        }

        if (isset($body['id'])) {
            $id = $body['id'];

            $animalsbyid = Animals::model()->findAllByAttributes(array('id' => $id));

            foreach ($animalsbyid as $animalsby) {
                if ($animalsby->image_path) {
                    if (file_exists($animalsby->image_path.".jpg")) {
                        
                        $type = pathinfo($animalsby->image_path.".jpg", PATHINFO_EXTENSION);
                        $data = file_get_contents($animalsby->image_path.".jpg");
                        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    }else{
                        $base64 = 'null';
                    }
                }else{
                    $base64 ='null';
                }
                $animalsby->image_path = $base64;
            }
	
            echo CJSON::encode(array('status' => '1', 'animalsbyid' => $animalsbyid));
            Yii::app()->end();
        } else {
            $allbyanimals = Animals::model()->findAll();
            foreach ($allbyanimals as $animal) {
                if ($animal->image_path) {

                    if (file_exists($animal->image_path.".jpg")) {
                        $type = pathinfo($animal->image_path.".jpg", PATHINFO_EXTENSION);
                        $data = file_get_contents($animal->image_path.".jpg");
                        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    } else {

                        $base64 = 'null';
                    }
                } else {
                    $base64 = 'null';
                }
                $animal->image_path = $base64;
            }
//                    die();
            echo CJSON::encode(array('status' => '1', 'all' => $allbyanimals));
            Yii::app()->end();
        }
    }

}
