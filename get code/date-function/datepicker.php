
<script>
 $('#f_event_date').datepicker({
    Format: 'mm-dd-yyyy',
    autoclose:true,
    startDate: new Date(),
  }).on('changeDate',function(e){
    $('#f_event_e__date').datepicker('setStartDate',e.date)
  });

  $('#f_event_e__date').datepicker({
    Format: 'mm-dd-yyyy',
    autoclose:true,
  }).on('changeDate',function(e){
    $('#f_event_date').datepicker('setEndDate',e.date)
  });
  </script>