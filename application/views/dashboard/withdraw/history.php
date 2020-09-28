<div class="content-deposite-history">
  <table class=" table-deposite table table-hover">
    <thead>
      <tr>
        <th>User</th>
        <th>Amount</th>
        <th>Date</th> 
        <th>Status</th>
      </tr>  
    </thead>
    <?php if(isset($history) && $history != NULL){ ?>
    <tbody>
      <?php foreach ($history as $key => $val) { ?>
      <tr>
        <td><?php echo $val['fullname'] ?></td>
        <td class="currency">$<?php echo $val['amount'] ?></td>
        <td><?php echo $val['date'] ?></td>
        <?php 
          $status = $val['status'];
          switch ($status)
          {
            case 0 :
              echo '<td><span class="waiting">waiting</span></td>';
              break;
            case 1:
               echo '<td><span class="status">success</span></td>';
              break;
            case 2:
               echo '<td><span class="pending">pending</span></td>';
              break;
            case 3:
               echo '<td><span class="destroy">destroy</span></td>';
              break;
            default:
              echo 'not found';
            break;
          }
        ?>
      </tr>
      <!-- <tr>
        <td>chuongle</td>
        <td class="currency">$100</td>
        <td>9-23-2020</td>
        <td><span class="pending">Pending</span> </td>
      </tr>
      <tr>
        <td>chuongle</td>
        <td class="currency">$100</td>
        <td>9-23-2020</td>
        <td><span class="destroy">Destroy</span></td>
      </tr>
        <td>chuongle</td>
        <td class="currency">$100</td>
        <td>9-23-2020</td>
        <td><span class="waiting">Waiting</span></td>
      </tr> -->
      <?php } ?>
    </tbody>
    <?php } ?>
  </table>
</div>