<div class="form">

<?php 
	//echo $model->engineer_id;
	$baseUrl=Yii::app()->request->baseUrl;
	$changeEnggUrl=$baseUrl.'/api/DisplayEngineerId/';		

	$enggdiaryform=$this->beginWidget('CActiveForm', array(
	'id'=>'enggdiary-changeEngineer-form',
	'enableAjaxValidation'=>false,
	//'action'=>$changeEnggUrl,
	'method'=>'post'
	
)); 
?>


<?php 
	
	//$engg_id=$model->engineer_id;
 	$data=CHtml::listData(Engineer::model()->findAll(), 'id', 'fullname');
 	echo "<b>Select Engineer&nbsp;&nbsp;&nbsp;</b>";
	echo $enggdiaryform->dropDownList($model, 'engineer_id', $data,
								array('empty'=>array(0=>'All Engineers')) 
								
							  );
	echo "&nbsp;&nbsp;".CHtml::submitButton('Change');
	
?>
<?php $this->endWidget(); ?>
</div><!-- ENd of form -->
 
 
<?php

  /*To import the client script*/
  $baseUrl = Yii::app()->baseUrl; 
  $cs = Yii::app()->getClientScript();
  
  
  $cs->registerScriptFile($baseUrl.'/js/fullcalendar/jquery-1.7.1.min.js');
  $cs->registerScriptFile($baseUrl.'/js/fullcalendar/jquery-ui-1.8.17.custom.min.js');
  $cs->registerScriptFile($baseUrl.'/js/fullcalendar/fullcalendar.min.js');
  $cs->registerScriptFile($baseUrl.'/js/fullcalendar/jquery.ui.touch-punch.js');
  
  //echo "ENGG ID IN VIEWFULLDIARY FORM = ".$engg_id;
 
 ?>
  

  
  <br><br><br>

<script type='text/javascript'>


function isTouchDevice()
{
    var ua = navigator.userAgent;
    var isTouchDevice = (
        ua.match(/iPad/i) ||
        ua.match(/iPhone/i) ||
        ua.match(/iPod/i) ||
        ua.match(/Android/i)
    );

    return isTouchDevice;
}
	//var url = 'http://localhost/KRUTHIKA/rapport_chs_experiment/chs/api/DisplayDiary';
	
	
	var baseUrl='<?php echo $baseUrl; ?>';
	//alert(baseUrl);
	var engg_id = '<?php echo $engg_id;?>';
	//var dataUrl = baseUrl;
	//alert(engg_id);
	var dataUrl  =  baseUrl+'/api/ViewFullDiaryJsonData/?engg_id='+engg_id;
	//alert(dataUrl);
	
	
	$(document).ready(function() 
	{
								
		$('#calendar').fullCalendar({
		
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},

			

			editable: true,
			events:dataUrl,
		
			editable: true,
			selectable: true,

			
			eventResize: function(event,dayDelta,minuteDelta,revertFunc) 
		    {
//				alert(
//		            "The end date of " + event.title + "has been moved " +
//		            dayDelta + " days and " +
//		            minuteDelta + " minutes."
//		        );

		        alert("Engg diary id = "+event.id);
		        engg_id = event.id;

				////CALL UPDATE STATEMNET HERE 
				updateEndDateTime(engg_id, dayDelta, minuteDelta);

//		        if (!confirm("is this okay?")) 
//				{
//		            revertFunc();
//		        }

		    },//end of eventResize.
			

			eventDrop: function (event,delta) 
			{
				
				alert(event.title + ' was moved ' + delta + ' days\n' +
					'(should probably update your database)');
				
				//alert ('Add Logic here to call and change database');	

				//alert (document.location.hostname);
				
				days_moved=delta;
				console.info("DAYS MOVED"+days_moved);
				//alert('ID = '+event.id);
				
				alert('event end date = '+event.end)
				end_date = event.end;
				engg_id = event.id;
				 
				
				////CALL UPDATE STATEMNET HERE 
				getResponse();
				//alert(delta);
				
				
				/////end of logic to move
				//location.reload();		

				},//end of eventDrop.
				
			
				loading: function(isLoading)
				{
				    if(!isLoading && isTouchDevice())
				    {
				        // Since the draggable events are lazy(bind)loaded, we need to
				        // trigger them all so they're all ready for us to drag/drop
				        // on the iPad. w00t!
				        $('.fc-event-draggable').each(function(){
				            var e = jQuery.Event("mouseover", {
				                target: this.firstChild,
				                _dummyCalledOnStartup: true
				            });
				            $(this).trigger(e);
				        });
				    }
				}

			/* 
			loading: function(bool) {
				if (bool) $('#loading').show();
				else $('#loading').hide();
			}
			*/
			
		});
	
		
	});
	
	function getResponse()
    {
	    model = 'Enggdiary';
	    //alert("EVENT END DATE IN FUNC = "+end_date);
	   	//alert("EVENT ID IN FUNC = "+engg_id);
	    //alert("DAYS MOVED IN FUNC = "+days_moved);

	    var updateUrl= baseUrl+'/api/UpdateDiary?engg_id='+engg_id+'&days_moved='+days_moved;
	    //model = 'Enggdiary';
	    $.ajax({
        	type: 'POST',
            url: updateUrl ,
            
          
          success: function(data) 
          { 
	          //alert(updateUrl);
	           },
          error: function() { alert("EWRROR"); 
          }
          });

    }//end of getResponse func().


    function updateEndDateTime(engg_id, dayDelta, minuteDelta)
    {
		//alert('In updateMinutes func');

		//alert("MINUTES IN updateMinutes func = "+minuteDelta);

		//alert("ENGG ID IN updateMinutes func = "+engg_id);

		 var updateUrl= baseUrl+'/api/UpdateEndDateTime?engg_id='+engg_id+'&minutes='+minuteDelta;
		 //model = 'Enggdiary';
		 $.ajax
		 ({
	     	type: 'POST',
	        url: updateUrl ,
	        success: function(data) 
	        { 
		    	alert(updateUrl);
		    },
	        error: function()
	        {
		        alert("EWRROR"); 
	        }
	     });//end of AJAX.
	    
		
		

	}//end of updateMinutes().
    

</script>
<style type='text/css'>

	body {
		margin-top: 40px;
		text-align: center;
		font-size: 14px;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		}
		
	#loading {
		position: absolute;
		top: 5px;
		right: 5px;
		}

	#calendar {
		width: 900px;
		margin: 0 auto;
		}

</style>


<div id='loading' style='display:none'>loading...</div>
<div id='calendar'></div>

