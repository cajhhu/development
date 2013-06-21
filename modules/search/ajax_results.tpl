<div class="search_box">
   <div class="searchheaders">
   {loop:headers}
   <div class="searchheader">{column}</div>
   {/loop:headers}
   </div>
   {loop:results}
   <div class="search_results_row">
      {loop:columns}<div class="search_results_column_{row}">{column}</div>{/loop:columns}
   </div>
   {/loop:results}
</div>
