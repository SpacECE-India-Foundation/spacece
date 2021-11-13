$(document).ready(function(){
$.ajax({
	'method':'get',
	'url':'fetch.php?getAll',
	success:function(data){
		$('#tablebody').append(data);
	}

});
});
$(document).on("click","#edit",function() {
   //alert($(this).data('text'));
		$('#act_id').empty();
		$('#act_lvl').empty();
		$('#act_domain').empty();
		$('#act_obj').empty();
		$('#act_key').empty();
		$('#act_mat').empty();
		$('#act_name').empty();
		$('#act_assess').empty();
		$('#act_pro').empty();
		$('#act_ins').empty();
		$('#act_date').empty();
    var id=$(this).data('text');
   /// alert(id);
    $.ajax({
	'method':'post',
	'data':{id:id},
	'url':'fetch.php?getDetails',
	success:function(data1){
		
		var data2=JSON.parse(data1);
		//alert(data2.activity_no);
		$('#act_id').append(data2.activity_no);
		$('#act_lvl').append(data2.activity_level);
		$('#act_domain').append(data2.activity_dev_domain);
		$('#act_obj').append(data2.activity_objectives);
		$('#act_key').append(data2.activity_key_dev);
		$('#act_mat').append(data2.activity_material);
		$('#act_name').append(data2.activity_name);
		$('#act_assess').append(data2.activity_assessment);
		$('#act_pro').append(data2.activity_process);
		$('#act_ins').append(data2.activity_instructions);
		$('#act_date').append(data2.activity_date);
		
}
});
});
