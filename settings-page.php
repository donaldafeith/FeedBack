<div class="wrap">

<h3><?php esc_attr_e( 'Feedback', 'df' ); ?></h3>
<table class="widefat">
	<thead>
	<tr>
	<th><?php esc_attr_e( 'Time', 'df' ); ?></th>
    <th><?php esc_attr_e( 'Name', 'df' ); ?></th>
	<th><?php esc_attr_e( 'Telephone Number', 'df' ); ?></th>
	<th><?php esc_attr_e( 'Email Address', 'df' ); ?></th>
	<th><?php esc_attr_e( 'City', 'df' ); ?></th>
	<th><?php esc_attr_e( 'Device', 'df' ); ?></th>
	<th><?php esc_attr_e( 'Message', 'df' ); ?></th>
	
	</tr>
	</thead>
	<tbody>
	<?php foreach($client_msg as $client): ?>
	 <tr>
	 <td><?php esc_attr_e($client->time,'df');?></td>
	 <td><?php esc_attr_e($client->name,'df');?></td>
	 <td><?php esc_attr_e($client->telno,'df');?></td>
	 <td><?php esc_attr_e($client->email,'df');?></td>
	 <td><?php esc_attr_e($client->town,'df');?></td>
	  <td><?php esc_attr_e($client->device,'df');?></td>
	 <td><?php esc_attr_e($client->message,'df');?></td>
	 </tr>
	 </tr>
	 <?php endforeach;?>		
	</tbody>
		
</table>
</div>