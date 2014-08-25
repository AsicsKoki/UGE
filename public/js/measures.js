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

				if ($('#measureTable th').length == 4) 
					table = $('#measureTable').dataTable({
					  "aoColumns": [
						null,
						{ "bSortable": false },
						{ "bSortable": false },
						{ "bSortable": false }
					  ]
					});
				else
					table = $('#measureTable').dataTable({
					  "aoColumns": [
						null,
						{ "bSortable": false },
						{ "bSortable": false },
						{ "bSortable": false },
						{ "bSortable": false }
					  ]
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
	$('div.alarms').remove();
})

var getAlarms = function() {
	if (typeof analyzerId) return;
	var url = '/analyzerAlarmTypes/' + analyzerId;
	 $.ajax({
			url: url,
			type: 'get',
			data: {
			},
			success: function (data) {
				$('div.alarms').html(data);
				$('#alarmTable tbody tr').each(function(index, row) {
					$(row).attr('data-index', index);
				});

				$('#alarmTableHidden tbody tr').each(function(index, row) {
					$(row).attr('data-index', index);
				});

				var table = $('#alarmTable').dataTable({
				  "aoColumns": [
					  null,
					  { "bSortable": false },
					  { "bSortable": false }
				  ]
				});

				$('table#alarmTable').on('click', 'td input[type=checkbox]', function() {
					var index = $(this).parents('tr').attr('data-index'),
						name = $(this).attr('name');

					$('table#alarmTableHidden tr[data-index="'+index+'"] input[type=checkbox][name="'+name+'"]').click();
				});

				$('table#alarmTable thead input[type=checkbox]').click(function() {
					var columnIndex = $(this).parent().index(),
						checked = $(this).is(':checked');

					table.fnGetNodes().forEach(function(item) {
						var index = $(item).attr('data-index');
						if (checked) {
							$(item).find('td:eq('+columnIndex+') input[type=checkbox]:not(:checked)').click();
							$('table#alarmTableHidden tr[data-index="'+index+'"] td:eq('+columnIndex+') input[type=checkbox]:not(:checked)').click();
						}
						else {
							$(item).find('td:eq('+columnIndex+') input[type=checkbox]:checked').click();
							$('table#alarmTableHidden tr[data-index="'+index+'"] td:eq('+columnIndex+')  input[type=checkbox]:checked').click();
						}
					})
				});

				table.fnGetNodes().forEach(function(row) {
					$(row).find('select[name="measure_type_in_analyzer_id_alarm[]"]').change(function() {
						var index = $(this).parents('tr').attr('data-index');
						$('table#alarmTableHidden tr[data-index="'+index+'"] input[type=text][name="measure_type_in_analyzer_id_alarm[]"]').val($(this).val());
					});

					$(row).find('select[name="measure_type_in_analyzer_id_alarm[]"]').change();
				});


			}
		});
}


getAlarms();

$('.nav-tabs li a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})
