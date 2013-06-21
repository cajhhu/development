<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA3WBDgo6hYSm8mYghbAAUcxsjyu4Vnqzc&sensor=true"></script>
<script language="javascript" type="text/javascript">


  var geocoder;
  var map;
  function initialize() {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(-34.397, 150.644);
    var mapOptions = {
      zoom: 8,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
  }

  function codeAddress() {
    var address = document.getElementById("address").value;
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location
        });
      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
  }


</script>
<div class="content">
   <div class="three-col-left">
      <div class="person_wrapper">
         <div class="person_header">&nbsp;</div>
         <div class="person_row_odd">
            <div class="field_name">Title:</div>
            <div class="field_data">{job_title}</div>
         </div>
         <div class="person_row_even">
            <div class="field_name">POC:</div>
            <div class="field_data">{job_poc}</div>
         </div>
         <div class="person_row_odd">
            <div class="field_name">Status:</div>
            <div class="field_data">{job_formatted_status}</div>
         </div>
         <div class="person_row_even">
            <div class="field_name">Type:</div>
            <div class="field_data">{job_type}</div>
         </div>
         <div class="person_row_odd">
            <div class="field_name">Appointment:</div>
            <div class="field_data">{job_date} {job_time}</div>
         </div>
         <div class="person_row_even">
            <div class="field_name">Address:</div>
            <div class="field_data">{job_address}<br>{job_city}, {job_state}, {job_zip}</div>
         </div>
         <div class="person_row_odd">
            <div class="field_name">Other Parties:</div>
            <div class="field_data">{job_names}</div>
         </div>
         <div class="person_row_even">
            <div class="field_name">Discount:</div>
            <div class="field_data">{job_discount}</div>
         </div>
         <div class="person_footer">&nbsp;</div>
         <input type="hidden" id="address" value="{job_address}, {job_zip}">
         <br>
         <div class="person_header">&nbsp;</div>
         <div class="person_row_odd">
         	<div class="field_data_colspan2">{job_description}</div></div>
         <div class="person_footer">&nbsp;</div>
      </div>
   </div>
   <div class="three-col-center">
      <div class="person_map_top">&nbsp;</div>
      <div id="map-canvas"></div>
      <div class="person_map_bottom">&nbsp;</div>
   </div>
   <div class="three-col-right">
      <hr>
      <div class="sidebar-header">Jobs</div>
      The job managemented module allows you to control all aspects of a particular contract, duty, or responsibility.  It can be used to create job templates which can
      automatically generate task lists and resources.
      <br>
      <div class="sidebar-subheader">Actions</div>
      <center>{loop:actions}{action}{/loop:actions}</center>
   </div>
</div>
