<?php
/* @var $this UserlocationsController */
/* @var $model UserLocations */
/* @var $form CActiveForm */
?>
  <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
.controls {
  margin-top: 10px;
  border: 1px solid transparent;
  border-radius: 2px 0 0 2px;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  height: 32px;
  outline: none;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
}

#pac-input {
  background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  margin-left: 12px;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: 300px;
}

#pac-input:focus {
  border-color: #4d90fe;
}

.pac-container {
  font-family: Roboto;
}

#type-selector {
  color: #fff;
  background-color: #4d90fe;
  padding: 5px 11px 0px 11px;
}

#type-selector label {
  font-family: Roboto;
  font-size: 13px;
  font-weight: 300;
}

    </style>
    
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
    
    
 <div class="row contrl_location">

<div class="col-xs-12 col-md-4 col-sm-4 left_loc">

<div class=" row add-address">

</div>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-locations-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php //echo $form->errorSummary($model); ?>

	<div class="row">
		<?php //echo $form->labelEx($model,'location_type'); ?>
		<?php //echo $form->textField($model,'location_type',array('size'=>60,'maxlength'=>200)); ?>
		<?php //echo $form->error($model,'location_type'); ?>
	</div>
    <div class="row">
        <div class="col-xs-12 col-md-9 col-sm-9">  <?php echo $form->dropDownList($model,'location_type', array('Home' => 'Home', 'Office' => 'Office', 'School'=>'School','Title 1'=>'Title 1','Title 2'=>'Title 2')); ?>
		<?php //echo $form->error($model,'location_type'); ?>
              </div>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'latitude'); ?>
		<?php echo $form->hiddenField($model,'latitude',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'latitude'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'longitude'); ?>
		<?php echo $form->hiddenField($model,'longitude',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'longitude'); ?>
	</div>

        <?php echo $form->labelEx($model,'status'); ?>
        <?php echo $form->dropDownList($model,'status', array('1' => 'Activated', '0' => 'Deactivated')); ?>
        <?php echo $form->error($model,'status'); ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

        </div>
    </div><!-- form -->


        <div class="col-xs-12 col-md-8 col-sm-8 right_loc">
        <div class="innerbody control_gmap">

               <input id="pac-input" class="controls" type="text" placeholder="Search Box">
            <div id="googleMap" style="width:100%;min-height:420px;" class="pull-right"></div>


            <!--<div id="googleMap" style="width:100%;min-height:420px;" class="pull-right"></div></div>-->

        </div>

        </div>
        </div><!-- form -->

        
<?php $this->endWidget(); ?>


<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
 <script type="text/javascript">
     var map;
     $(document).ready(function () {
		setTimeout(function() { initAutocomplete(); }, 400);
	});
// This example adds a search box to a map, using the Google Place Autocomplete
// feature. People can enter geographical searches. The search box will return a
// pick list containing a mix of places and predicted search terms.

        function initAutocomplete() {
            
          var  lat = '<?php echo $model->latitude; ?>';
           var lng = '<?php echo $model->longitude; ?>';
           
           map = new google.maps.Map(document.getElementById('googleMap'), {
            center: {lat: parseFloat(lat), lng: parseFloat(lng)},
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            
          });
          drop();

          // Create the search box and link it to the UI element.
          var input = document.getElementById('pac-input');
          var searchBox = new google.maps.places.SearchBox(input);
          
          map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

          // Bias the SearchBox results towards current map's viewport.
          map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
            if(document.getElementById('pac-input').value !=''){
                var address = document.getElementById('pac-input').value;
                setLatLongOnForm(address);
            }
          });

          var markers = [];
          // [START region_getplaces]
          // Listen for the event fired when the user selects a prediction and retrieve
          // more details for that place.
          searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();
            
            if (places.length == 0) {
              return;
            }

            // Clear out the old markers.
            markers.forEach(function(marker) {
              marker.setMap(null);
            });
            markers = [];

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
              var icon = {
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25)
              };

              // Create a marker for each place.
              markers.push(new google.maps.Marker({
                map: map,
                icon: icon,
                title: place.name,
                position: place.geometry.location
              }));

              if (place.geometry.viewport) {
                // Only geocodes have viewport.
                bounds.union(place.geometry.viewport);
              } else {
                bounds.extend(place.geometry.location);
              }
            });
            map.fitBounds(bounds);
          });
        // [END region_getplaces]
      }
      
      function setLatLongOnForm(address){
          var geocoder = new google.maps.Geocoder();
              geocoder.geocode( { 'address': address}, function(results, status) {

                    if (status == google.maps.GeocoderStatus.OK) {
                      var latitude = results[0].geometry.location.lat();
                      var longitude = results[0].geometry.location.lng();

                     document.getElementById('UserLocations_latitude').value=latitude;
                     document.getElementById('UserLocations_longitude').value=longitude;
                 }
                 else{
                     window.alert("Autocomplete's returned place contains no geometry");
                     return;
                 }
             });
      }
      
      function drop(){
          var  lat = '<?php echo $model->latitude; ?>';
          var lng = '<?php echo $model->longitude; ?>';
          var loctype = '<?php echo $model->location_type ; ?>' ;
          var image='';
           if(loctype == 'Home' || loctype == 'Title 1' || loctype == 'Title 2'){
                     
                    image = '<?php echo Yii::app()->request->hostInfo.Yii::app()->theme->baseUrl;?>/img/home_map.png';
               }
               else if(loctype == 'Office'){
                  
                   image = '<?php echo Yii::app()->request->hostInfo.Yii::app()->theme->baseUrl;?>/img/office_map.png';
               }
               else if(loctype == 'School'){
                   image = '<?php echo Yii::app()->request->hostInfo.Yii::app()->theme->baseUrl;?>/img/school_map.png';
               }
               else{
                   image = '<?php echo Yii::app()->request->hostInfo.Yii::app()->theme->baseUrl;?>/img/pin_map.png';
               }
          var myLatLng = {lat: parseFloat(lat), lng: parseFloat(lng)};
       
          var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: 'Hello World!',
            icon: image
          });

     }

    </script>