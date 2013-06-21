$(function() {
   
   $(".search_button").click(function() {
      var searchString     =  $("#search_box").val();
      var data             =  'resp=ajax&term=' + searchString;

      if (searchString) {
         $.ajax({
            type: "POST",
            url:  "index.php?page=search",
            data: data,
            beforeSend: function(html) {
               $("#results").html('');
               $("#searchresults").show();
            },
            success: function(html) {
               $("#results").show();
               $("#results").append(html);
            }
         });
      }
      return false;
   });

   $('#search_box').keypress(function(e) {
        if(e.which == 13) {
            jQuery(this).blur();
            jQuery('.search_button').focus().click();
        }
    });

    $("#results").ready(function() {
      var searchString     =  "%";
      var data             =  'resp=ajax&term=' + searchString;

      if (searchString) {
         $.ajax({
            type: "POST",
            url:  "index.php?page=search",
            data: data,
            beforeSend: function(html) {
               $("#results").html('');
               $("#searchresults").show();
            },
            success: function(html) {
               $("#results").show();
               $("#results").append(html);
            }
         });
      }
      return false;
   });
   
   $("#address").ready(function() {
   	initialize();
   	codeAddress();
   });
});
