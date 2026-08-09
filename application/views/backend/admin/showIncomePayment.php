
<table id="example" class="table display">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                            <th><div><?php echo get_phrase('title');?></div></th>
                            
                            <th><div><?php echo get_phrase('description');?></div></th>
                            <th><div><?php echo get_phrase('amount_paid');?></div></th>
                            
                    		<th><div><?php echo get_phrase('payment_method');?></div></th>
                    		<th><div><?php echo get_phrase('session_/_year');?></div></th>
                            
						</tr>
					</thead>
                    <tbody>
    
                    <?php
                //   <!-- function get_invoice($invoice_id, $date) {$query("SELECT * FROM invoice WHERE $creation_timestamp=$date, $invoice_id=$invoice_id");
                  //      if ($query->result_array()>0){
            //        return $query->result_array();
              //              }
                //            return false;
                  //      }
                //  -->
                    $counter = 1; $invoices =  $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->result_array();
                    foreach($invoices as $key => $invoice):?>         
                        <tr>
                            <td><?php echo $counter++;?></td>
                            <td><?php echo $invoice['title'];?></td>
                            <td><?php echo $invoice['description'];?></td>
                            <td><?php echo $invoice['amount_paid'];?></td>
                            <td><?php echo $invoice['method'];?></td>
                            <td><?php echo $invoice['creation_timestamp'];?></td>
                           
                        </tr>
    <?php endforeach;?>
                    </tbody>
                </table>