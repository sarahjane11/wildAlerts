       <a class="dropdown-toggle cont_bell" data-toggle="dropdown" href="#">
                        <i class="glyphicon glyphicon-bell"></i> <span class="notifi"><?php if($alertcount >0) echo $alertcount; ?></span>
                    </a>
        <?php if(isset($getallNotification) && !empty($getallNotification)){?>
                    <ul class="dropdown-menu dropdown-alerts pull-right">             
    <?php  foreach($getallNotification as $key => $value):   //echo "<pre>"; print_r($getallNotification);
//            $lat = $value['latitude'];
//            $lang = $value['longitude'];
//            $getAddress = json_decode(file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$lang ."&sensor=true"));
//             $add = $getAddress->results; 
//            $addess = '';
//             foreach($add as $k =>$v){
//                 $addess .=  $v->formatted_address;
//             }
             
        
        ?>
       <li>
           <a href="<?php echo Yii::app()->createUrl('/user/profile?id='.$value['id'].'&triggarid='.$key);?>" >
            <!--<span class="th-color" style="background:<?php //echo $value['color'];?>"> </span>-->
            <span><img  class="th-color" style="background-color:<?php echo $value['color'];?>" Hight="24px" width="24px" SRC="<?php echo Yii::app()->theme->baseUrl;?>/img/animal.png"></img></span>
            <span class="row_noti"><?php echo $value['animalname']; ?> </span>
            
            
           </a>
       </li>
    <?php endforeach; ?>
 </ul>
        <?php } ?>