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
<div class="module-header">
   <div class="module-name">User Management: {person_username}</div>
</div>
<div class="content">
   <div class="three-col-left">
      <div class="person_wrapper">
         <div class="person_header">&nbsp;</div>
         <div class="person_row_odd">
            <div class="field_name">Username:</div>
            <div class="field_data">{person_username}</div>
         </div>
         <div class="person_row_even">
            <div class="field_name">First Name:</div>
            <div class="field_data">{person_firstname}</div>
         </div>
         <div class="person_row_odd">
            <div class="field_name">Last Name:</div>
            <div class="field_data">{person_lastname}</div>
         </div>
         <div class="person_row_even">
            <div class="field_name">Mobile Phone:</div>
            <div class="field_data">{person_mobile}</div>
         </div>
         <div class="person_row_odd">
            <div class="field_name">Home Phone:</div>
            <div class="field_data">{person_home}</div>
         </div>
         <div class="person_row_even">
            <div class="field_name">Email Address:</div>
            <div class="field_data"><a href="mailto:{person_email}">{person_email}</a></div>
         </div>
         <div class="person_row_odd">
            <div class="field_name">Street Address:</div>
            <div class="field_data">{person_address}</div>
         </div>
         <div class="person_row_even">
            <div class="field_name">City:</div>
            <div class="field_data">{person_city}</div>
         </div>
         <div class="person_row_odd">
            <div class="field_name">State:</div>
            <div class="field_data">{person_state}</div>
         </div>
         <div class="person_row_even">
            <div class="field_name">Zip Code:</div>
            <div class="field_data">{person_zip}</div>
         </div>
         <div class="person_row_odd">
            <div class="field_name">Recommended By:</div>
            <div class="field_data">{person_recommended}</div>
         </div>
         <div class="person_row_even">
            <div class="field_name">Type of Advertisement:</div>
            <div class="field_data">{person_adverttype}</div>
         </div>
         <div class="person_row_odd">
            <div class="field_name">Password Attempts:</div>
            <div class="field_data">{person_password_attempts}</div>
         </div>
         <div class="person_row_even">
            <div class="field_name">Last Attempt:</div>
            <div class="field_data">{person_last_attempt}</div>
         </div>
         <div class="person_row_odd">
            <div class="field_name">Date Created:</div>
            <div class="field_data">{person_created}</div>
         </div>
         <div class="person_row_even">
            <div class="field_name">Account Enabled:</div>
            <div class="field_data">{person_enabled}</div>
         </div>
         <div class="person_footer">&nbsp;</div>
         <input type="hidden" id="address" value="{person_address}, {person_zip}">
      </div>
   </div>
   <div class="three-col-center">
      <div class="person_map_top">&nbsp;</div>
      <div id="map-canvas"></div>
      <div class="person_map_bottom">&nbsp;</div>
   </div>
   <div class="three-col-right">
      <hr>
      <center>
      <div class="sidebar-header">User Management</div>
      The User Management module provides you with the tools to manage the user accounts, profiles, business organization, and permissions for all of your clients.
      <br>
      <br>
      <div class="sidebar-subheader">Actions</div>
      {loop:actions}{action}{/loop:actions}
      <br>
      <br>
      <hr>
   </div>
</div>
