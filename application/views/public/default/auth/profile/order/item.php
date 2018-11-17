<?php

if(!empty($data)) foreach ($data as $item){
  ?>
  <tr class="first odd">
    <td>#<?php echo $item->id ?></td>
    <td><?php echo date('d/m/Y',strtotime($item->created_time)) ?></td>
    <td><?php echo $item->bill_address ?></td>
    <td><span class="price"><?php echo formatMoney($item->total_amount) ?></span></td>
    <td><em><?php echo status_order($item->is_status) ?></em></td>
    <td class="a-center last"><span class="nobr"> <a href="<?php echo getUrlProfile('detail-order/'.$item->id) ?>">Chi tiết</a> <span class="separator"></td>
  </tr>
  <?php
}
