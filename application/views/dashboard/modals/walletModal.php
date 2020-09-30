<div id="myWallet" class="main-deposite modal fade" role="dialog">
  <!-- Top deposote-->
  <div class="top-deposite">
    <div class="wallet">
      <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>
  <!-- End Top deposote-->
  <div class="container-tab-deposite">
    <ul class=" nav nav-pills link-tab-deposite">
      <li class="active">
        <a style="text-align: right;" data-toggle="tab" href="#tab-deposite">Deposite</a>
      </li>
      <li class="">
        <a data-toggle="tab" href="#withdraw">Withdraw</a>
      </li>
      <li class="">
        <a data-toggle="tab" href="#bill" id = "depositeHistory">History</a>
      </li>
    </ul>

    <div class="tab-content">
      <!--Tab Deposite-->
      <div id="tab-deposite" class="tab-pane fade in active">
        <?php $this->load->view('dashboard/deposite/index'); ?>
      </div>
      <!--End Tab Deposite-->
      <!--Tab Withdraw-->
      <div id="withdraw" class="tab-pane">
        <?php $this->load->view('dashboard/withdraw/index'); ?>
      </div>
      <!--End Tab Withdraw-->
      <!--Tab History-->
      <div id="bill" class="tab-pane">
        <div class="content-tab-bill">
          <ul class="nav nav-tabs link-tab-bill">
            <li class="active"><a data-toggle="tab" href="#deposite-history">Deposite</a></li>
            <li><a data-toggle="tab" href="#withdraw-history">Withdraw</a></li>
          </ul>
          <div class="tab-content">
            <div id="deposite-history" class="tab-pane fade in active">
              <?php $this->load->view('dashboard/deposite/history'); ?>
            </div>
            <div id="withdraw-history" class="tab-pane fade">
              <?php $this->load->view('dashboard/withdraw/history'); ?>
            </div>
          </div>
        </div>
      </div>
      <!--End Tab History-->
    </div>
  </div>
</div>
<script>
	$("#depositeHistory").click(function(){
		$.ajax({url: "dashboard/ajax/historyDeposite",
			 success: function(result){
			$("#historyDeposite").html(result);
		}});
	});


</script>
