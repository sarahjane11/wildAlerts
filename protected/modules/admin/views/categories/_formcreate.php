<?php
/* @var $this CategoriesController */
/* @var $model Categories */
/* @var $form CActiveForm */
?>
    
  <?php Yii::app()->clientScript->registerScript('textFieldAdder','$("#additional-link").bind("click",function(){
                    var id="Categories_category";
                    //var size=$("#additional-inputs >  input").size();
                    var size = $(".test").length;
                    $("#additional-inputs").append("<div class=test> <input type=text id="+id+size+" name=Categories"+"["+size+"]><a onclick=myFunction(this)>close</a></div>");
                    
                    })')?>

<div class="add-category add wild form">
<!-- <button class="add pull right">+Add</button>-->
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'categories-form',
	'enableAjaxValidation'=>false,
)); ?>

   
	<?php echo $form->errorSummary($model); ?>
        
        <div class="row" id="additional-inputs">
            <?php echo $form->labelEx($model,'category'); ?>
            <?php echo $form->textField($model,'category',array('size'=>60,'maxlength'=>200));?> <?php echo CHtml::link('Add','#',array('id'=>'additional-link')); ?></br>
            <?php //echo $form->error($model,'category'); ?>
            <div class="bg-danger controlupdatess">      
                <?php
               $flashMessages = Yii::app()->user->getFlashes();
               if ($flashMessages) {
                   echo '<ul class="flashes">';
                   foreach($flashMessages as $key => $message) {
                       echo '<li><div class="flash-' . $key . '">' . $message . "</div></li>\n";
                   }
                   echo '</ul>';
               }
               ?>
               </div>
        </div>
       
        
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
                
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
   function myFunction(elem){
         $(elem).parents('.test').remove();
     }
     
   
       
   
 </script>
    