<ul class="nav nav-tabs">
   <li class="active"><a data-toggle="tab" href="#menu0"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> OpenVPN Users</a></li>
   <li><a data-toggle="tab" href="#menu1"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> OpenVPN logs</a></li>
</ul>
<div class="tab-content">

   <div id="menu0" class="tab-pane fade in active">
      <!-- Users grid -->
      <div class="block-grid row" id="user-grid">
         <h4>
            OpenVPN Users with Password <button data-toggle="modal" data-target="#modal-user-add" type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-plus"></span></button>
         </h4>
         <table id="table-users" class="table"></table>

         <div id="modal-user-add" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                     <h4 class="modal-title">Add user</h4>
                  </div>
                  <div class="modal-body">
                     <div class="form-group">
                        <label for="modal-user-add-username">Username</label>
                        <input type="text" name="username" id="modal-user-add-username" class="form-control" autofocus/>
                     </div>
                     <div class="form-group">
                        <label for="modal-user-add-password">Password</label>
                        <input type="password" name="password" id="modal-user-add-password" class="form-control" />
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     <button type="button" class="btn btn-primary" id="modal-user-add-save">Save</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div id="menu1" class="tab-pane fade">
      <!-- Logs grid -->
      <div class="block-grid row" id="log-grid">
         <h4>
            OpenVPN logs
         </h4>
         <table id="table-logs" class="table" data-filter-control="true"></table>
      </div>
   </div>

</div>

<script src="vendor/jquery/dist/jquery.min.js"></script>
<script src="vendor/bootstrap/js/modal.js"></script>
<script src="vendor/bootstrap/js/tooltip.js"></script>
<script src="vendor/bootstrap/js/tab.js"></script>
<script src="vendor/bootstrap/js/collapse.js"></script>
<script src="vendor/bootstrap/js/popover.js"></script>
<script src="vendor/bootstrap-table/dist/bootstrap-table.min.js"></script>
<script src="vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
<script src="vendor/bootstrap-table/dist/extensions/editable/bootstrap-table-editable.min.js"></script>
<script src="vendor/bootstrap-table/dist/extensions/filter-control/bootstrap-table-filter-control.min.js"></script>
<script src="vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.js"></script>
<script src="js/grids.js"></script>

<script>
$(document).ready(function(){
   /*
   https://stackoverflow.com/a/19015027/3214501
   -> keep the currently active tab beyond page reloading
   */
   $('.nav.nav-tabs a').click(function(e) {
     e.preventDefault();
     $(this).tab('show');
   });
   $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
     var id = $(e.target).attr("href").substr(1);
     window.location.hash = id;
   });
   $('.nav.nav-tabs a[href="' + window.location.hash + '"]').tab('show');
});
</script>
