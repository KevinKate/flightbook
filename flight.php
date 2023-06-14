 <section id="bg-flight" class="d-flex align-items-center">
<main id="main">
	<div class="container">
		<div class="col-lg-12">
			<div class="row">
				<div class="col-md-12">
					<button class="float-right btn btn-dark btn-sm" type="button" id="new_flight">Add New <i class="fa fa-plus"></i></button>
				</div>
			</div>
			<div class="row">
				&nbsp;
			</div>
			<div class="row">
				<div class="card col-md-12 bg-image">
					
					<div class="card-body">
						<table class="table table-striped table-bordered" id="flight-field">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Flight No.</th>
									<th class="text-center">Flight Name</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</main>
</section>
<script>
	$('#new_flight').click(function(){
		uni_modal('Add New Flight','manage_flight.php')
	})
	window.load_flight = function(){
		$('#flight-field').dataTable().fnDestroy();
		$('#flight-field tbody').html('<tr><td colspan="4" class="text-center">Please wait...</td></tr>')
		$.ajax({
			url:'load_flight.php',
			error:err=>{
				console.log(err)
				alert_toast('An error occured.','danger');
			},
			success:function(resp){
				if(resp){
					if(typeof(resp) != undefined){
						resp = JSON.parse(resp)
							if(Object.keys(resp).length > 0){
								$('#flight-field tbody').html('')
								var i = 1 ;
								Object.keys(resp).map(k=>{
									var tr = $('<tr></tr>');
									tr.append('<td class="text-center">'+(i++)+'</td>')
									tr.append('<td class="text-center">'+resp[k].flight_number+'</td>')
									tr.append('<td>'+resp[k].name+'</td>')
									tr.append('<td><center><button class="btn btn-sm btn-primary edit_flight mr-2" data-id="'+resp[k].id+'"><i class="fa fa-edit"></i></button><button class="btn btn-sm btn-danger remove_flight" data-id="'+resp[k].id+'"><i class="fa fa-trash"></i></button></center></td>')
									$('#flight-field tbody').append(tr)

								})

							}else{
								$('#flight-field tbody').html('<tr><td colspan="4" class="text-center">No data.</td></tr>')
							}
					}
				}
			},
			complete:function(){
				$('#flight-field').dataTable()
				manage();
			}
		})
	}
	function manage(){
		$('.edit_flight').click(function(){
		uni_modal('Edit New Flight','manage_flight.php?id='+$(this).attr('data-id'))

		})
		$('.remove_flight').click(function(){
		_conf('Are you sure to delete this data?','remove_flight',[$(this).attr('data-id')])

		})
	}
	function remove_flight($id=''){
		start_load()
		$.ajax({
			url:'delete_flight.php',
			method:'POST',
			data:{id:$id},
			error:err=>{
				console.log(err)
				alert_toast("An error occured","danger");
				end_load()
			},
			success:function(resp){
				if(resp== 1){
					alert_toast("Data succesfully deleted","success");
					end_load()
					$('.modal').modal('hide')
					load_flight()
				}
			}
		})
	}
	$(document).ready(function(){
		load_flight()
	})
</script>