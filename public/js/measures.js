var table;
$('button.submit-button').on('click', function(e) {
	$('#measureTableHidden').find('input[type=checkbox]').each(function(index, input) {
	 	if ($(input).is(':checked'))
	 		$(input).siblings('input[type=hidden]').attr('disabled', 'disabled');
	 	else
	 		$(input).siblings('input[type=hidden]').removeAttr('disabled');
	});
	$('#measureTable input').attr('disabled', 'disabled');
 	$(this).parents('form').submit();
});

var getMeasures = function(id) {
	if (typeof link == 'undefined') link = '/analyzerMeasureTypes/';
	var url;
	if (typeof analyzerId == 'undefined')
		url = link + id;
	else
		url = link + id + '/' + analyzerId;
	 $.ajax({
			url: url,
			type: 'get',
			data: {
			},
			success: function (data) {
				$('#measureTable').parent().remove();
				$('#measureTableHidden').parent().remove();

				$('div.measures').html(data);

				$('#measureTable tbody tr').each(function(index, row) {
					$(row).attr('data-index', index);
				});

				$('#measureTableHidden tbody tr').each(function(index, row) {
					$(row).attr('data-index', index);
				});

				var sortable = [null];
				var tableTh = $('#measureTable th').length - 1;
				for (var i = 0; i < tableTh; i++) {
					sortable.push({"bSortable":false});
				}

				table = $('#measureTable').dataTable({
				  "aoColumns": sortable
				});

				$('table#measureTable').on('click', 'td input[type=checkbox]', function() {
					var index = $(this).parents('tr').attr('data-index'),
						name = $(this).attr('name');

					$('table#measureTableHidden tr[data-index="'+index+'"] input[name="'+name+'"]').click();
				});

				$('table#measureTable thead input[type=checkbox]').click(function() {
					var columnIndex = $(this).parent().index()
						checked = $(this).is(':checked');

					table.fnGetNodes().forEach(function(item) {
						var index = $(item).attr('data-index');
						if (checked) {
							$(item).find('td:eq('+columnIndex+') input[type=checkbox]:not(:checked)').click();
							$('table#measureTableHidden tr[data-index="'+index+'"] td:eq('+columnIndex+') input[type=checkbox]:not(:checked)').click();
						}
						else {
							$(item).find('td:eq('+columnIndex+') input[type=checkbox]:checked').click();
							$('table#measureTableHidden tr[data-index="'+index+'"] td:eq('+columnIndex+')  input[type=checkbox]:checked').click();
						}
					})
				})

			}
		});
}

getMeasures($('select[name=analyzer_types_id]').val());

$('select[name=analyzer_types_id]').change(function() {
	var id = $(this).val();
	getMeasures(id);
	if (id != analyzerTypesId)
		$('table#alarmTable').parent().hide();
	else
		$('table#alarmTable').parent().show();
})

var getAlarms = function() {
	if (typeof analyzerId == 'undefined') return;
	var url = '/analyzerAlarmTypesEdit/' + analyzerId;
	 $.ajax({
			url: url,
			type: 'get',
			data: {
			},
			success: function (data) {
				$('div.alarms').html(data);

				var table = $('#alarmTable').dataTable({
				  "aoColumns": [
					  null,
					  null,
					  null,
					  { "bSortable": false },
					  { "bSortable": false }
				  ]
				});

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


getAlarms();

$('.nav-tabs li a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})
