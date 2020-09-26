<div id="myTransfer" class="main-transfer modal fade" role="dialog">
  <div class="top-deposite">
    <div class="wallet">
      <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>
  <div class="container-fluid">
    <ul class="row nav nav-pills link-tab-bill">
      <li class="active col-md-offset-4 col-md-2 col-sm-offset-4 col-xs-3 col-lg-offset-4 col-lg-2 col-xs-offset-2 ">
        <a data-toggle="tab" href="#tabTransfer">Transfer</a>
      </li>
      <li class="col-lg-5 col-xs-4 "><a data-toggle="tab" href="#tabTransferHistory">History</a></li>
    </ul>
  </div>
  <div class="tab-content">
    <div id="tabTransfer" class="tab-pane fade in active">
      <div class="content-transfer">
        <form action="" method="">
          <label>Amount</label><br />
          <input id="txtAmountTransfer" value="" type="number" min="0" name="" /><br />
          <label>Transfer to</label><br />
          <input id="txtTransferTo" type="text" name="" /><br />
          <label>2FA code</label><br />
          <input id="FACodeTransfer" type="text" name="" /><br />
          <label class="lable-btn"><button id="btn-confirm" type="submit">Confirm</button></label>
        </form>
      </div>
    </div>
    <div id="tabTransferHistory" class="tab-pane fade">
      <div class="content-transferHistory">
        <!-- table -->
        <table style="overflow-x:auto" class=" table-deposite table table-hover">
          <thead>
            <tr>
              <th>Sender </th>
              <th>Receiver</th>
              <th>Amount</th>
              <th>Date</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>chuongle</td>
              <td>mesi</td>
              <td class="currency">$100</td>
              <td>9-23-2020</td>
              <td><span class="status">success</span> </td>
            </tr>
            <tr>
              <td>chuongle</td>
              <td>jenny</td>
              <td class="currency">$100</td>
              <td>9-23-2020</td>
              <td><span class="status">success</span> </td>
            </tr>
          </tbody>
        </table>
        <!-- END table -->
      </div>
    </div>
  </div>
</div>