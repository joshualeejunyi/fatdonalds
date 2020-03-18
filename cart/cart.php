<?php  
session_start();
?>
<table style="width:50%" align="center" id="tab">
  <caption><h2>Cart</h2></caption>
  <thead>
    <tr>
    <th><center>Index</center></th>
    <th><center>ID</center></th>
    <th><center>Name</center></th>
    </tr>
  </thead>
  <tbody>
    <?php 
        if(is_array($_SESSION)) {
                $i = 1;
                foreach($_SESSION as $id => $array){ ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $array['name']; ?></td>
                    </tr><?php
                  $i++;
                }
        }
    ?>
  </tbody>
  <tfoot>
  </tfoot>
</table>
