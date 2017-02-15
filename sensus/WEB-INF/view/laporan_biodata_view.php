<div id="table"></div>
<div id="chart" style="display: none;"></div>
<!-- colorbox hidden -->
<div style='display:none'>
	<a class='inline' href="#inline_content"></a>
	<div id='inline_content' style='padding:10px; background:#fff;'>
		<h2>Kolom yang ingin ditampilkan</h2>
		<form id="ffilterForm">
			<fieldset>
				<input type='checkbox' checked='checked' value='Nama Lengkap' name='fields[]'>Nama Lengkap<br/>
				<input type='checkbox' value='Nama Panggilan' name='fields[]'>Nama Panggilan<br/>
				<input type='checkbox' checked='checked' value='Tempat Lahir' name='fields[]'>Tempat Lahir<br/>
				<input type='checkbox' checked='checked' value='Tanggal Lahir' name='fields[]'>Tanggal Lahir<br/>
				<input type='checkbox' value='Usia' name='fields[]'>Usia<br/>
				<input type='checkbox' checked='checked' value='Jenis Kelamin' name='fields[]'>Jenis Kelamin<br/>
				<input type='checkbox' value='Nama Ayah' name='fields[]'>Nama Ayah<br/>
				<input type='checkbox' value='Nama Ibu' name='fields[]'>Nama Ibu<br/>
				<input type='checkbox' value='Status Jamaah' name='fields[]'>Status Jamaah<br/>
				<input type='checkbox' checked='checked' value='Status Kawin' name='fields[]'>Status Kawin<br/>
				<input type='checkbox' value='Pendapatan' name='fields[]'>Pendapatan<br/>
				<input type='checkbox' value='Harta' name='fields[]'>Harta<br/>
				<input type='checkbox' checked='checked' value='Status Sambung' name='fields[]'>Status Sambung<br/>
				<input type='checkbox' value='Mulai Aktif Sambung' name='fields[]'>Mulai Aktif Sambung<br/>
				<input type='checkbox' checked='checked' value='Kelompok' name='fields[]'>Kelompok<br/>
				<input type='checkbox' checked='checked' value='Mubaligh/Mubalighot' name='fields[]'>Mubaligh/Mubalighot<br/>
				<input type='checkbox' value='Status Hidup' name='fields[]'>Status Hidup<br/>
				<input type='checkbox' checked='checked' value='Alamat' name='fields[]'>Alamat<br/>
				<input type='checkbox'  value='Geo' name='fields[]'>Geo<br/>
				<input type='checkbox' value='Telepon' name='fields[]'>Telepon<br/>
				<input type='checkbox' checked='checked' value='Mobile' name='fields[]'>Mobile<br/>
				<input type='checkbox' value='Telepon Wali' name='fields[]'>Telepon Wali<br/>
				<input type='checkbox' value='Web' name='fields[]'>Web<br/>
				<input type='checkbox' value='Email' name='fields[]'>Email<br/>
				<input type='checkbox' checked='checked' value='Pekerjaan' name='fields[]'>Pekerjaan<br/>
				<input type='checkbox' checked='checked' value='Pendidikan' name='fields[]'>Pendidikan<br/>
			</fieldset>
		</form>
	</div>
</div>
<script type="text/javascript">
	function getCbOrganisasi(controller){
		msg_buzy('Loading...','Please wait a minute');
		$.ajax({
			type : 'GET',
			url : controller + "/getSelect.html?checkbox",
			dataType : 'html',
			success : function(data){
				$('#div_org').html(data);
				msg_buzy_done();
			},
			error : function(XMLHttpRequest, textStatus, errorThrown) {
				msg_buzy_done();
				msg_error('ADA KESALAHAN SISTEM!' , errorThrown.toString());
			}
		});
		return false;
	};
	$(document).ready(function() {
		$(".inline").colorbox({inline:true,width:"30%",maxHeight:"100%"});
		document.title = 'Laporan Biodata';
		getCbOrganisasi($('input:radio[name=tingkat_organisasi]').filter('[checked="checked"]').attr('id'));
		$('#reset').bind("click", function() {
			$('input:checkbox').attr('checked', true);
			$('#table').html('').show(100);
			$('#chart').empty();
			$('#chart').css("display", "none");
			$('#keyword').val($('#keyword').attr('title'));
			$('#tanggal_aktif').val('');
			$('#tanggal_lahir').val('');
		});

		$('#ffilter').click(function(){
			$("[href='#inline_content']").click();
			return false;
		});

		$('#download').click(function() {
			if ($('#keyword').val() == $('#keyword').attr('title'))
				$('#keyword').val('');

			var url = "<?PHP echo getScriptUrl();?>laporan-biodata/getListPrint.html?type=xls&" + $('#sFilter').serialize() + "&"  + $('#ffilterForm').serialize();
			document.location.href = url;

			if ($('#keyword').val() == '')
				$('#keyword').val($('#keyword').attr('title'));

			return false;
		});
		
		$('.search_submit').live("click", function() {
			if ($('#keyword').val() == $('#keyword').attr('title'))
				$('#keyword').val('');
			
			msg_buzy('Loading...','Please wait a minute');
			$('#table').html('').show(100);
			$('#chart').css("display", "none");
			$('#chart').empty();
			
			$.ajax({
				type : 'GET',
				url : "<?php echo getActualUrl()?>/getReport.html",
				dataType : 'json',
				data : $('#sFilter').serialize(),
				success : function(data){
					if (data.rtype=='table') {
						$('#table').html(data.table).show(10);
					} else if (data.rtype=='chart') {
						var length = data.charts.length, element = null;
						for (var i = 0; i < length; i++) {
							element = data.charts[i];
							$('#chart').append('<h2>' + element.text + '</h2><div id="chart_' + i + '"></div>');
							pieChartFactory('chart_' + i,element.text, element.chart);
						};
						$('#chart').css("display", "block");
					}
					setTimeout("msg_buzy_done()",20);
				},
				error : function(XMLHttpRequest, textStatus, errorThrown) {
					msg_buzy_done();
					msg_error('ADA KESALAHAN SISTEM!' , errorThrown.toString());
				}
			});

			if ($('#keyword').val() == '')
				$('#keyword').val($('#keyword').attr('title'));
			
			return false;
		});

		$('#tanggal_aktif').daterangepicker({
			minDate: Date.today().add({ years: -100 }),
			maxDate: Date.today(),
			showDropdowns: true,
			format: 'dd/MM/yyyy',
            separator: ' - '
		});
		$('#tanggal_lahir').daterangepicker({
			minDate: Date.today().add({ years: -100 }),
			showDropdowns: true,
			format: 'dd/MM/yyyy',
            separator: ' - '
		});

		// Radialize the colors
		Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function(color) {
		    return {
		        radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
		        stops: [
		            [0, color],
		            [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
		        ]
		    };
		});
		
		function pieChartFactory(renderTo,text,data) {
			$('#'+ renderTo).highcharts({
	            chart: {
	                renderTo: renderTo,
	                width: '825',
	                plotBackgroundColor: null,
	                plotBorderWidth: null,
	                plotShadow: false
	            },
	            title: {
	                text: 'Summary Jumlah Jamaah Berdasarkan ' + text
	            },
	            tooltip: {
	                formatter: function() {
	                    return '<b>'+ this.point.name +'</b>: '+ this.y +' jamaah';
	                }
	            },
	            plotOptions: {
	                pie: {
	                    allowPointSelect: true,
	                    cursor: 'pointer',
	                    dataLabels: {
	                        enabled: true,
	                        color: '#000000',
	                        connectorColor: '#000000',
	                        formatter: function() {
	                            return '<b>'+ this.point.name +'</b>: '+ this.y +' jamaah';
	                        }
	                    },
	                    showInLegend: false
	                }
	            },
	            series: [{
	            	type: 'pie',
	                data: data
	            }]
	        });
		};
	});	
</script>