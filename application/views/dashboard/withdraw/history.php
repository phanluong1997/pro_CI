<!-- show historyWithdraw - OT1 -->
<script>
  $("#withdraw-historyAjax").click(function(){
    $.ajax({
      async: false,
      url: 'dashboard/history-Withdraw.html',
      type: 'POST',
      dataType: 'html',
      success: function(data) {
        if(data){
          $('#resultHistory').html(data);
        }
      }
    });      
  });
</script>
<div class="content-deposite-history" >
  <table class=" table-deposite table table-hover">
    <thead>
      <tr>
        <th>User</th>
        <th>Amount</th>
        <th>Date</th> 
        <th>Status</th>
      </tr>  
    </thead>
    <tbody id="resultHistory">
     
    </tbody>
  </table>
</div>
