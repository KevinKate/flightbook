<?php
include('db_connect.php');
if(isset($_GET['id']) && !empty($_GET['id']) ){
	$qry = $conn->query("SELECT * FROM flight where id = ".$_GET['id'])->fetch_array();
	foreach($qry as $k => $val){
		$meta[$k] =  $val;
	}
}
?>
<div class="container-fluid">
	<form id="manage_flight">
		<div class="col-md-12">
			<div class="form-group mb-2">
				<label for="name" class="control-label">Flight Name</label>
				<input type="hidden" class="form-control" id="id" name="id" value='<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>' required="">
				<input type="text" class="form-control" id="name" name="name" required="" value="<?php echo isset($meta['name']) ? $meta['name'] : '' ?>">
			</div>
			<div class="form-group mb-2">
				<label for="flight_number" class="control-label">Flight Number</label>
				<input type="number" class="form-control" id="flight_number" name="flight_number" required value="<?php echo isset($meta['flight_number']) ? $meta['flight_number'] : '' ?>">
			</div>
		</div>
	</form>
</div>
<script>
	$('#manage_flight').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'./save_flight.php',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
    			end_load()
    			alert_toast('An error occured','danger');
			},
			success:function(resp){
				if(resp == 1){
    				end_load()
    				$('.modal').modal('hide')
    				alert_toast('Data successfully saved','success');
    				load_flight()
				}
			}
		})
	})
</script>