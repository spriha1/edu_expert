<?php if ($file === 'footer') { ?>
	<script src="bower_components/jquery/dist/jquery.min.js"></script>
	<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="plugins/iCheck/icheck.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
	<script id="footer" footer="footer" src="<?php autoVer('/scripts/footer.js'); ?>"></script>
<?php } 

else if ($file === 'dashboard_footer') {
?>
	<script src="bower_components/jquery/dist/jquery.min.js"></script>
	<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
	
	<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

	<script src="dist/js/adminlte.min.js"></script>
	<script src="dist/js/pages/dashboard.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
	<script id="footer" footer="dashboard_footer" src="<?php autoVer('/scripts/footer.js'); ?>"></script>
	
<?php } 

else if ($file === 'profile_footer') {
?>
	<script src="bower_components/jquery/dist/jquery.min.js"></script>
	<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
	<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="dist/js/adminlte.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/timer.jquery/0.7.0/timer.jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
	<script id="footer" footer="profile_footer" src="<?php autoVer('/scripts/footer.js'); ?>"></script>
<?php } 

else if ($file === 'timesheet_footer') {
?>
	<script src="bower_components/jquery/dist/jquery.min.js"></script>
	<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
	<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="dist/js/adminlte.min.js"></script>
	<script src="dist/js/pages/dashboard.js"></script>
	<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<?php } ?>