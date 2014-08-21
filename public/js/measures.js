var table;
$('button.submit-button').on('click', function(e) {
	$('#measureTableHidden').find('input[type=checkbox]').each(function(index, input) {
	 	if ($(input).is(':checked'))
	 		$(input).siblings('input[type=hidden]').attr('disabled', 'disabled');
	 	else
	 		$(input).siblings('input[type=hidden]').removeAttr('disabled');
	});
	$('#measureTable input').attr('disabled', 'disabled');
	/*e.preventDefault();
	return;*/
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

				$('button.submit-button').before(data);

				$('#measureTable tbody tr').each(function(index, row) {
					$(row).attr('data-index', index);
				});

				$('#measureTableHidden tbody tr').each(function(index, row) {
					$(row).attr('data-index', index);
				});

				table = $('#measureTable').dataTable({
				  "aoColumns": [
				  null,
				  { "bSortable": false },
				  { "bSortable": false },
				  { "bSortable": false },
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
})