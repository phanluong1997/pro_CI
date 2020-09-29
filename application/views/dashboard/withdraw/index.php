<div class="content-withdraw">
  <form onsubmit="return checkAmount();" action="dashboard/withdraw.html" method="POST">
    <div id="messageAmount" class="text-danger"></div>
    <label style="display: inline-block;">Amount in USD <span class="box__require">(*)</span></label><br />
    <input id="amount_min_withdraw" readonly hidden type="text" value="<?php echo $wallet['amount_min_withdraw']; ?>"  />
    <input id="txtAmount" type="number"  min="0" name="Amount" required /><br />
    <label>Amount USD you will receive <span class="box__require">(*)</span></label><br />
    <input id="txtAmountReceive" readonly  type="text" name="AmountReceive"  /><br />
    <input id="cost_withdraw" readonly hidden type="text" value="<?php echo $wallet['cost_withdraw']; ?>"  />
    <label>Amount in ETH <span class="box__require">(*)</span></label><br />
    <input id="cost_ETH" readonly hidden type="text" value="<?php echo $ETH; ?>"  />
    <input id="txtETH" type="text"  readonly name="ETH" /><br />
    <label>Your ETH wallet <span class="box__require">(*)</span></label><br />
    <input id="txtETHWallet" type="text" name="ETHWallet" required /><br />
    <label>2FA code <span class="box__require">(*)</span></label><br />
    <input id="FACode" type="text" name="FACode" required /><br />
    <label class="lable-btn"><button id="btn-withdraw" type="submit" >Withdraw</button></label>
  </form>
</div>
<script>
  //percentage - OT1
  $(function() {
    $('#txtAmount').keyup(function() {
        var inputTxtAmount = $('#txtAmount').val();
        var cost_withdraw = $('#cost_withdraw').val();
        var cost_ETH = $('#cost_ETH').val();
        if (inputTxtAmount > 0) {
            var percentage = inputTxtAmount-((cost_withdraw * inputTxtAmount) / 100);
            var amountETH = percentage/cost_ETH;
            $('#txtAmountReceive').attr('value', percentage);
            $('#txtETH').attr('value', amountETH.toPrecision(7));
        } else {
            $('#txtAmountReceive').attr('value', 0);
            $('#txtETH').attr('value', 0);
        }
    });
  });

  //checkAmount > 100 - OT1
  function checkAmount(){
    //Get value to input
    var amount = $('#txtAmount').val();
    var amount_min = $('#amount_min_withdraw').val();
    //Check require
    if(amount == ""){
      $('#messageAmount').html('Amount is empty');
      return false;
    }else{
      let result = 1;
      $.ajax({
        async: false,
        url: 'dashboard/checkamount.html',
        type: 'POST',
        dataType: 'json',
        data: {amount:amount,amount_min:amount_min},
        success: function(data) {
          if(data){
            $('#messageAmount').html(data.message);
            result = 0;
          }
        }
      });
      if(result == 0){ return false; }else{ return true; }
    }
  }
</script>