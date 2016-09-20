<?php
/* @var $this ProfileController */
/* @var $dataProvider CActiveDataProvider */

//$this->breadcrumbs=array(
//	'Users',
//);
//
//$this->menu=array(
//	array('label'=>'Create User', 'url'=>array('create')),
//	array('label'=>'Manage User', 'url'=>array('admin')),
//);
?>

<div class="innerbody control_gmap">


<?php 
//$this->widget('zii.widgets.CListView', array(
//	'dataProvider'=>$dataProvider,
//	'itemView'=>'_view',
//)); 
 //echo "<pre>"; print_r($userlocation); die;
 
?><?php   //$this->widget('AllNotificationWidget'); echo date('Y-m-d H:i:s +z'); ?>
    <div id="googleMap" class="" style="min-height:520px;"></div>
    
    
    <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Share with friends</h4>
              </div>
              <div class="modal-body">
                 <textarea class="form-control friends-email" id="friends-list" rows="3"></textarea>
              </div>
              <div class="modal-footer">
                  <button type="button" class="share-friend btn btn-primary">Send</button>
              </div>
            </div>
          </div>
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
    var prev_infowindow =false; 
    //var triggarid='';
    $(document).ready(function () {
		setTimeout(function() { initMap(); }, 400);
	});
    
    function initMap() {
        
         GetUserLocationValues();
         GetValues();
      // console.log(regionlocation[i]['id']);
       var  lat = 30.7398339;
       var   lng = 76.78270199999997;
       if(regionlocation.length){
         if(typeof(regionlocation[i]['latitude']) != 'undefined' && typeof(regionlocation[i]['latitude']) != null ){
            
          lat = regionlocation[i]['latitude'];
         }
         if(typeof(regionlocation[i]['longitude']) != 'undefined' && typeof (regionlocation[i]['longitude']) != null ){
             
            lng = regionlocation[i]['longitude'];
         }
     }
        var myLatLng = {lat: parseFloat(lat), lng: parseFloat(lng)};
       
        
         geocoder = new google.maps.Geocoder();
        //infowindow = [];
         map = new google.maps.Map(document.getElementById('googleMap'), {
          center: myLatLng,
          zoom: 8,
          mapTypeId: google.maps.MapTypeId.ROADMAP
          
        });
        drop();
        drop1();
       var triggarid = '<?php if(isset($triggarid)) echo $triggarid; ?>';
       
        if(triggarid !== ''){
            
            //console.log('triggerevent :'+marker1[triggarid]['id']);
             google.maps.event.trigger(marker1[triggarid], 'click');
            
        }
      }
        //user location
        function GetUserLocationValues(){
            
             var jLocArray= <?php echo json_encode($userlocation ); ?>;
             locationtype = jLocArray;
             for(var i=0; i<jLocArray.length ;i++){
                 
                       regionlocation.push(jLocArray[i]);
                        
             }
        }
        //all wildalerts notification
          function GetValues(){
            
             var jLocArray= <?php echo json_encode($allNotification ); ?>;
             //locationtype = jLocArray;
            // console.log('jLocArray :'+jLocArray);
             for(var i=0; i<jLocArray.length ;i++){
                 
                       regionalertlocation.push(jLocArray[i]);
                        
             }
        }
        // add marker for user location
	function drop(){
            for(var i=0; i< regionlocation.length; i++){
                addMarker(regionlocation[i]);
                      
            }
           
        }	
        // add marker for all wildalerts notification
        function drop1(){
            
            for(var i=0; i< regionalertlocation.length; i++){
                addMarker1(regionalertlocation[i]);
               
            }
           
        }
       // marker for all wildalerts notification
        function addMarker1(notificatinvalue) {
                var value = notificatinvalue;
		var icons =   '<?php echo Yii::app()->request->hostInfo.Yii::app()->theme->baseUrl;?>/img/pin_map.png';
		
		var templat = notificatinvalue['latitude'];
		var templong = notificatinvalue['longitude'];
		var temp_latLng = new google.maps.LatLng(templat, templong);


		marker1.push(new google.maps.Marker(
		{
			position: temp_latLng,
			map: map,
			icon: icons,
                        draggable: false,
                        title: notificatinvalue['animalname']

                        
		})); 
                notificationiterator++;
		notificationinfo(notificationiterator,value);
		
	}
     	//  marker for user location
	function addMarker(value) {
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
        
        //show infowindow for notification
        function notificationinfo(j,value){
        
             //console.log('value' + value +'j'+j);
             var date = value['modified_at'].substring(0,10);
            // console.log(date.substring(0, 10));
            var contentString = '<div id="content">'+
                                    '<div id="siteNotice">'+
                                    '</div>'+
                                    '</div class="left-details"> '+
                                     '<span><img  class="th-color" style="background-color:'+value['color']+'" Hight="24px" width="24px" SRC="<?php echo Yii::app()->theme->baseUrl;?>/img/animal.png"></img></span>'+
                                    '<h1 id="firstHeading" class="firstHeading">Wildalerts, Wild Notification</h1>'+
                                   '<div id="bodyContent">'+
                                    '<p>Animal Name :'+value['animalname']+'</p>'+
                                    '<p>Posted Date :'+ date +'</p>'+
                                    '<p>Time : '+value['modified_at']+'</p>'+
                                    '<p>Notes : '+value['notes']+'</p>'+
                                    '<p>Posted by : ' + value['username'] + '</p>' +
                                    '<p><div>Share</div><a class="fb" title="Share on facebook" href="javascript:sharewildalertOnfb('+ value['id'] +');"><img width="24px" height="24px" style=" margin-right: 5px;" src="<?php echo Yii::app()->request->hostInfo.Yii::app()->theme->baseUrl;?>/img/facebook.png"></a>'+
                                       '<a class="twit" title="Share on twitter" href="javascript:sharewildalertOnTwitter('+ value['id'] +');"><img width="24px" height="24px" style=" margin-right: 5px;" src="<?php echo Yii::app()->request->hostInfo.Yii::app()->theme->baseUrl;?>/img/twitter.png"></a>'+
                                       '<a class="email"  title="Share on email" href="javascript:sharewildalerttOnmail('+ value['id'] +');" ><img width="24px" height="24px" style=" margin-right: 5px;" src="<?php echo Yii::app()->request->hostInfo.Yii::app()->theme->baseUrl;?>/img/email.png"></a></p>'+
                                    '</div>'+
                                     '</div>'+
                                     '<div class="right-details">'+
                                         '<p><IMG BORDER="0" ALIGN="Right" Hight="100px" width="200px" SRC="<?php echo Yii::app()->baseUrl;?>/upload/'+value['image_name']+'"></p>'+
                                        '</div>'+
                                    '</div>';

             var infowindow = new google.maps.InfoWindow({
                content: contentString
              });
        
		google.maps.event.addListener(marker1[j - 1], 'click', function() {
                    //console.log(value);
                    //console.log(marker1.getPosition());
                    if( prev_infowindow ) {
                        prev_infowindow.close();
                     }
                      prev_infowindow = infowindow;
                    infowindow.open(map, marker1[j - 1]);
                    map.setZoom(20);
                    map.setCenter(marker1[j - 1].getPosition());
                         
		});
        
        
        }
        //show infowindow for user location
        function info(i,value) {

              var contentString = '<div id="content">'+
                                    '<div id="siteNotice">'+
                                    '</div>'+
                                    '<h1 id="firstHeading" class="firstHeading">Wildalerts, User Location</h1>'+
                                    '<div id="bodyContent">'+
                                    '<p><b>Location :'+value['location_type']+'</b></p>'+
                                    '</div>'+
                                    '</div>';

             var infowindow = new google.maps.InfoWindow({
                content: contentString
              });

             
		google.maps.event.addListener(marker[i - 1], 'click', function() {
                    if( prev_infowindow ) {
                        prev_infowindow.close();
                     }
                      prev_infowindow = infowindow;
                    infowindow.open(map, marker[i - 1]);

                         map.setZoom(20);
                         map.setCenter(marker[i - 1].getPosition());
                         
		});
	}
        
     
</script>

<script>
 
 function sharewildalertOnfb(id){
      var id = btoa(id);
     url = '<?php  echo Yii::app()->request->hostInfo.Yii::app()->createUrl('site/wildalertpost') ?>'+'?id='+id;
     
     var myWindow=window.open('https://www.facebook.com/sharer.php?u='+encodeURI(url),"", "width=500, height=400");
 }
 
 function sharewildalertOnTwitter(id){
     var id = btoa(id);
     
    url = '<?php  echo Yii::app()->request->hostInfo.Yii::app()->createUrl('site/wildalertpost') ?>'+'?id='+id;
     
      var title = encodeURIComponent('Wildalerts - Click on the link to view post : ');
        //We trigger a new window with the Twitter dialog, in the middle of the page
      window.open('http://twitter.com/share?url=' + url + '&text=' + title + '&', 'twitterwindow', 'height=450, width=550, top='+($(window).height()/2 - 225) +', left='+$(window).width()/2 +', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');

     
 }
 
  var postlinkurl = "<?php  echo Yii::app()->request->hostInfo.Yii::app()->createUrl('site/wildalertpost') ?>";
  function sharewildalerttOnmail(id){
      var id = btoa(id);
    
    postlinkurl = "<?php  echo Yii::app()->request->hostInfo.Yii::app()->createUrl('site/wildalertpost') ?>"+'?id='+id;
    
     $('#myModal').modal('show');
    }
 
    $(document).ready(function()
    {
        function validateEmail(email) { 
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
       } 
        
        
        
       $('.share-friend').click(function(){
           var flag=true;
           var emailslist=$('#friends-list').val();
           var arrayEmails=emailslist.split(',');
           $.each(arrayEmails,function(i,v){
               if(!validateEmail(v))
               {
                   flag=false;
               }
                if(flag)
                {
                   
                    $.ajax({
                   url:'<?php  echo Yii::app()->request->hostInfo.Yii::app()->createUrl('site/sharealertswithfriends') ?>',
                   data:{  emails:emailslist,
                              pageUrl:postlinkurl,
                              
                          },
                   type:'post',
                   beforeSend:function(){
                        $('#load-img').show();
                   },
                   success:function(response){
                       $('#myModal').modal('toggle');
                       alert('email send successfully.');
                       
                     
                   },
                  error:function(){
                      alert('Unable to send email.');
                  },
               });
                    
                }else{
                    alert('Please fill valid emails.');
                }
                
           });
       });
       

    });
 
 
 
 
</script>
