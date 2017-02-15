<div id="table"></div>
<div id="chart" style="display: none;"></div>
<script type="text/javascript">
	function getSelectOptionsWithController(element_id,controller){
		msg_buzy('Loading...','Please wait a minute');
		$.ajax({
			type : 'GET',
			url : controller + "/getSelect.html",
			dataType : 'html',
			success : function(data){
				$('#' + element_id).html(data);
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
		getSelectOptionsWithController('organisasi',$('input:radio[name=tingkat_organisasi]').filter('[checked="checked"]').attr('id'));		
		document.title = 'Laporan Absensi';
		$('#reset').bind("click", function() {
			$('input:checkbox').attr('checked', true);
			$('#table').html('').show(100);
			$('#chart').empty();
			$('#chart').css("display", "none");
			$('#keyword').val($('#keyword').attr('title'));
			$('#tanggal_pengajian').val('');
		});

		$('#download').click(function() {
			if ($('#keyword').val() == $('#keyword').attr('title')){
				msg_warning('Warning','Silahkan pilih tanggal pengajian terlebih dahulu!');
				return false;
			}

			var url = "<?PHP echo getScriptUrl();?>laporan-biodata/getListPrint.html?type=xls&" + $('#sFilter').serialize();
			document.location.href = url;

			return false;
		});
		
		$('.search_submit').live("click", function() {
			if ($('#keyword').val() == $('#keyword').attr('title')) {
				msg_warning('Warning','Silahkan pilih tanggal pengajian terlebih dahulu!');
				return false;
			}

			if ($('#organisasi').val()=='00') {
				msg_warning('Warning','Silahkan pilih organisasi terlebih dahulu!');
				return false;
			}
			
			msg_buzy('Loading...','Please wait a minute');
			$('#table').html('').show(100);
			$('#chart').css("display", "none");
			$('#chart').empty();

			$.ajax({
				type : 'POST',
				url : "<?php echo getActualUrl()?>/getReport.html",
				dataType : 'json',
				data : $('#sFilter').serialize(),
				success : function(data){
					if (data.rtype=='table')
						$('#table').html(data.table).show(10);
					else if (data.rtype=='chart') {
						var length = data.chart.length, element = null;
						for (var i = 0; i < length; i++) {
							element = data.chart[i];
							$('#chart').append('<h2>' + element.text + '</h2><div id="chart_' + i + '"></div>');
							var rtype = $('input:radio[name=rtype]').filter('[checked="checked"]').val();
							if (rtype == 'summary')
								columnChartFactory('chart_' + i,element.text, element.series);
							else if (rtype == 'summonth')
								lineChartFactory('chart_' + i,element.text, element.series);
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

			return false;
		});

		$('#keyword').daterangepicker({
			ranges: {
                'Today': ['today', 'today'],
                'Yesterday': ['yesterday', 'yesterday'],
                'Last 7 Days': [Date.today().add({ days: -6 }), 'today'],
                'Last 30 Days': [Date.today().add({ days: -29 }), 'today'],
                'This Month': [Date.today().moveToFirstDayOfMonth(), Date.today().moveToLastDayOfMonth()],
                'Last Month': [Date.today().moveToFirstDayOfMonth().add({ months: -1 }), Date.today().moveToFirstDayOfMonth().add({ days: -1 })]
             },
             opens: 'right',
             format: 'dd/MM/yyyy',
             separator: ' - ',
             startDate: Date.today().add({ days: -29 }),
             endDate: Date.today(),
             minDate: Date.today().add({ years: -100 }),
 			 maxDate: Date.today(),
 			 showWeekNumbers: true,
             buttonClasses: ['btn-danger'],
             dateLimit: false
			}
		);

		function lineChartFactory(renderTo,text,series) {
			$('#'+ renderTo).highcharts({
	            chart: {
	            	 type: 'spline',
	            	 width: 825,
	            	 zoomType: 'x'
	            },
	            title: {
	                text: text
	            },
	            subtitle: {
	                text: $('#keyword').val()
	            },
	            xAxis: {
	            	title : {
                		text : 'Bulan Pengajian'
            		},
                    type: 'datetime',
	                dateTimeLabelFormats: { // don't display the dummy year
	                    month: '%b-%y',
	                    year: '%Y'
	                },
	                labels: {
	                    rotation: -45,
	                    align: 'right',
	                    style: {
	                        fontSize: '12px',
	                        fontFamily: 'Verdana, sans-serif'
	                    }
	                },
	                tickInterval: 30 * 24 * 3600 * 1000,
                    tickWidth: 0,
                    gridLineWidth: 1
	            },
	            yAxis: {
	                title: {
	                    text: 'Prosentase (%)'
	                },
	                min: 0,
	                stackLabels: {
	                    enabled: true,
	                    style: {
	                        fontWeight: 'bold',
	                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
	                    }
	                }
	            },
	            legend: {
	                align: 'right',
	                x: -50,
	                verticalAlign: 'top',
	                y: 20,
	                floating: true,
	                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
	                borderColor: '#CCC',
	                borderWidth: 1,
	                shadow: false
	            },
	            tooltip: {
	                formatter: function() {
	                        return '<b>'+ this.series.name +'</b><br/>'+
	                        Highcharts.dateFormat('%b-%Y', this.x) +': '+ (this.y).toFixed(2) +' %';
	                }
	            },
	            series: series
			});
		}

		function columnChartFactory(renderTo,text,series) {
			$('#'+ renderTo).highcharts({
	            chart: {
	            	 width: 825,
	            	 zoomType: 'x'
	            },
	            title: {
	                text: text
	            },
	            subtitle: {
	                text: $('#keyword').val()
	            },
	            xAxis: {
            		title : {
                		text : 'Tanggal Pengajian'
            		},
                    type: 'datetime',
                    tickInterval: 14 * 24 * 3600 * 1000,
                    tickWidth: 0,
                    gridLineWidth: 1
	            },
	            yAxis: {
	                min: 0,
	                title: {
	                    text: 'Total Peserta (jamaah)'
	                },
	                maxPadding: 0.4,
	                stackLabels: {
	                    enabled: true,
	                    style: {
	                        fontWeight: 'bold',
	                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
	                    }
	                }
	            },
	            legend: {
	                align: 'right',
	                x: -50,
	                verticalAlign: 'top',
	                y: 20,
	                floating: true,
	                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
	                borderColor: '#CCC',
	                borderWidth: 1,
	                shadow: false
	            },
	            tooltip: {
	                formatter: function() {
	                	var s;
	                    if (this.point.name) { // the pie chart
	                        s = this.point.name +': ' + this.percentage.toFixed(2) + '%';
	                    } else {
	                        s = '<b>'+ Highcharts.dateFormat('%a, %d %b %Y',this.x) +'</b><br/>'+
	                        	this.series.name +': '+ this.y + '<br/>' + 
	                        	'Prosentase: ' + this.percentage.toFixed(2) + '%' +'<br/>'+
	                        	'Total: '+ this.point.stackTotal + ' Peserta';
	                    }
	                    return s;
	                }
	            },
	            plotOptions: {
	                column: {
	                    stacking: 'normal',
	                    dataLabels: {
	                        enabled: true,
	                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
	                    }
	                }
	            },
	            labels: {
	                items: [{
	                    html: 'Summary',
	                    style: {
	                        left: '45px',
	                        top: '-35px',
	                        color: '#4D759E',
		                    fill: '#4D759E'
	                    }
	                }]
	            },
	            series: series
	        });
		};
	});	
</script>