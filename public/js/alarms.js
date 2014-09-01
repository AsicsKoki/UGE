$('.nav-tabs li a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})

var getAlarms = function(analyzerTypeId) {
	var url = '/alarmManagement/alarmTypes/' + analyzerTypeId;
	 $.ajax({
			url: url,
			type: 'get',
			data: {
			},
			success: function (data) {
				$('div.alarm_measures').html(data);

				var table = $('#alarmMeasuresTable').dataTable({
				  "aoColumns": [
					  null,
					  null,
					  null,
					  null,
					  null,
					  { "bSortable": false }
				  ]
				});

				return;
				$('div.panelContent').on("click",'table#alarmTable button.status' ,function(e){
					e.preventDefault();
					if($(this).hasClass('btn-danger')){
						var state = 0;
					} else {
						var state = 1;
					}
					var id = $(this).data('id');
					var self = this;
					$.ajax({
						url: "changeAlarmForMeasureState",
						type: "post",
						data: {
							state: state,
							id: id
						},
						success: function(data){
							if(data == 1){
								if($(self).hasClass('btn-danger')){
									$(self).removeClass('btn-danger');
									$(self).addClass('btn-success').text('Activate');
								} else {
									$(self).removeClass('btn-success');
									$(self).addClass('btn-danger').text('Deactivate');
								}
							}
						}
					});
				});
			}
		});
}
var id = $('select[name=analyzer_types_id]').val();
$('a.newAlarm').attr('href', '/registerAnalyzerAlarm/'+id)
$('select[name=analyzer_types_id]').change(function() {
	var id = $(this).val();
	$('a.newAlarm').attr('href', '/registerAnalyzerAlarm/'+id)
	getAlarms(id);
})

getAlarms($('select[name=analyzer_types_id] option:first').val());