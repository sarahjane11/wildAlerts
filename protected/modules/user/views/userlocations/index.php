<?php
/* @var $this UserlocationsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Locations',
);

$this->menu=array(
	array('label'=>'Create UserLocations', 'url'=>array('create')),
	array('label'=>'Manage UserLocations', 'url'=>array('admin')),
);
?>

<h1>User Locations</h1>
<div role="navigation" id="sidebar" class="col-xs-6 col-sm-3 sidebar-offcanvas">
          <?php $this->widget('userleftmenu'); ?>
        </div>
       
        <div class="col-xs-12 col-sm-9  inner_page_right"><p class="pull-right visible-xs">
            <button data-toggle="offcanvas" class="btn btn-primary btn-xs" type="button">Toggle nav</button>
          </p>
          <div class="addloc_div">

        
              <?php echo CHtml::link('Add Location',array('Userlocations/create')); ?>
             
              
     <div class="col-xs-12 col-md-12 col-sm-12 right_loc">
        <div class="innerbody control_gmap"><div id="googleMap" style="width:100%;min-height:620px;" class="pull-right"></div></div>

     </div>         
  
              
          </div>
          
 <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<script type="text/javascript">
    
    var regionlocation=[];
    var regionalertlocation = [];
    var i=0;
    var j=0;
    var marker = [];
    var marker1 = [];
    var map;
    var iterator = 0;
    var notificationiterator = 0;
    var geocoder;
    //var triggarid='';
    jQuery(document).ready(function () {
		setTimeout(function() { initMap(); }, 400);
	});
    
    function initMap() {
        
         GetUserLocationValues();
        var lat = 30.7500;
        var lng = 76.7800;
       if(regionlocation.length){
         if(typeof(regionlocation[i]['latitude']) != 'undefined' && typeof(regionlocation[i]['latitude']) != null ){
            
          lat = regionlocation[0]['latitude'];
          
         }
         if(typeof(regionlocation[i]['longitude']) != 'undefined' && typeof (regionlocation[i]['longitude']) != null ){
             
            lng = regionlocation[0]['longitude'];
           
         }
     }
        var myLatLng = {lat: parseFloat(lat), lng: parseFloat(lng)};
       
        
         //geocoder = new google.maps.Geocoder();
        //infowindow = [];
         map = new google.maps.Map(document.getElementById('googleMap'), {
          zoom: 8,
          center: myLatLng
        });
        drop();
        //drop1();
        
      }
        //user location
        function GetUserLocationValues(){
            
             var jLocArray= <?php echo json_encode($getalluserlocation ); ?>;
             locationtype = jLocArray;
             for(var i=0; i<jLocArray.length ;i++){
                 
                       regionlocation.push(jLocArray[i]);
                        
             }
        }
       
        // add marker for user location
	function drop(){
            for(var i=0; i< regionlocation.length; i++){
                addMarker(regionlocation[i]);
                //console.log(regionlocation[i]);
                       
            }
           
        }	
        
     	//  marker for user location
	function addMarker(value) {
            //console.log(value);
            var image='';
           var value = value;
             if(value['location_type'] == 'Home' || value['location_type'] == 'Title 1' || value['location_type'] == 'Title 2'){
                     
                    image = '<?php echo Yii::app()->request->hostInfo.Yii::app()->theme->baseUrl;?>/img/home_map.png';
               }
               else if(value['location_type'] == 'Office'){
                  
                   image = '<?php echo Yii::app()->request->hostInfo.Yii::app()->theme->baseUrl;?>/img/office_map.png';
               }
               else if(value['location_type'] == 'School'){
                   image = '<?php echo Yii::app()->request->hostInfo.Yii::app()->theme->baseUrl;?>/img/school_map.png';
               }
               else{
                   image = '<?php echo Yii::app()->request->hostInfo.Yii::app()->theme->baseUrl;?>/img/pin_map.png';
               }
               
		var icons =   image;
		
		var templat = value['latitude'];
		var templong = value['longitude'];
		var temp_latLng = new google.maps.LatLng(templat, templong);
                
		marker.push(new google.maps.Marker(
		{
			position: temp_latLng,
			map: map,
			icon: icons,
			draggable: false,
                        title: value['location_type'],
                       
                        
		})); 
                 iterator++;
		info(iterator,value);
	}
        
        //show infowindow for user location
        function info(i,value) {
                var status = '' ;
                if(value['status']== 0){
                    status = '<p><b>Status : Deactivated </b></p>';
                }
               
              var contentString = '<div id="content">'+
                                    '<div id="siteNotice">'+
                                    '</div>'+
                                    '<h1 id="firstHeading" class="firstHeading">Wildalerts, User Location</h1>'+
                                    '<div id="bodyContent">'+
                                    '<p><b>Location :'+value['location_type']+'</b></p>'+
                                     status +
                                    '<p>Action : <a class="loc-id" href="javascript:void(0);" onclick="deleteloc('+value['id']+')">Delete</a> || <a class="update-loc-id" href="<?php echo Yii::app()->createUrl('user/Userlocations/update/id');?>'+'/'+value['id']+'">Update</a>'+
                                    '</div>'+
                                    '</div>';

             var infowindow = new google.maps.InfoWindow({
                content: contentString
              });

             
		google.maps.event.addListener(marker[i - 1], 'click', function() {

                    infowindow.open(map, marker[i - 1]);

                         map.setZoom(15);
                         map.setCenter(marker[i - 1].getPosition());
                         
		});
	}
       
       
     function deleteloc(locid){
         var lid = locid;
          var ok = confirm("Are you sure you want to delete the location?");
          
            if (ok)
            {
                $.ajax({
                         url:'<?php  echo Yii::app()->createUrl('user/Userlocations/delete'); ?>',
                         data:{   id:lid },
                         type:'post',
                         success:function(response){
                            
                             alert('Location deleted successfully');
                              window.location.reload();
                         },
                        error:function(){
                            alert('Unable to delete.');
                        },
                     });
             }
         
     }
     
     
</script>
