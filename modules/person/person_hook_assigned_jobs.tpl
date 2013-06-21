<div class="content">
   <div class="two-col-left">
      <div class="person_hook_top">&nbsp;</div>
      <div class="search_box">
         <div class="searchheaders">
            <div class="searchheader">Title</div>
            <div class="searchheader">Type</div>
            <div class="searchheader">Date</div>
            <div class="searchheader">Time</div>
            <div class="searchheader">Location</div>
         </div>
      {loop:jobs}
         <div class="search_results_row">
            <div class="search_results_column_{row}" style="width: 296px"><a href="{base_url}/index.php?page=job&action=view&id={job_id}">{job_title}</a></div>
            <div class="search_results_column_{row}" style="width: 74px">{job_type}</div>
            <div class="search_results_column_{row}" style="width: 74px">{job_date}</div>
            <div class="search_results_column_{row}" style="width: 74px">{job_time}</div>
            <div class="search_results_column_{row}" style="width: 222px">{job_city}, {job_state}</div>
         </div>
      {/loop:jobs}
      </div>
      <div class="person_hook_bottom">&nbsp;</div>
   </div>
   <div class="two-col-right">
   <hr>
   <div class="sidebar-header">Jobs</div>
   On the right, you'll see a list of jobs that this user has created.
   <br>
   <br>
   <div class="sidebar-subheader">Actions</div>
   <center>{loop:actions}{action}{/loop:actions}</center>
   <hr>
   </div>
</div>
