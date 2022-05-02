<?php 
	include("../classes/class-db.php");
	include("header.php");
?>

	<div class="table-container">
		<div class="filterbar">
			<label>Start Date</label>
			<input type="date" id="star_date" name="star_date">
			<label>End Date</label>
			<input type="date" id="end_date" name="end_date">
		</div>
		<div id="table-list">
			<table>
			  <?php 
			  	$data = $db->getAll('buyer_info','buyer, note, city, phone, entry_at'); 

			  	if(is_array($data)){
			  		?>
			  			<tr>
						    <th>Buyer</th>
						    <th>Note</th>
						    <th>City</th>
						    <th>Phone</th>
						    <th>Entry Date</th>
					    </tr>
			  		<?php
			  		foreach($data as $row){
			  			echo '<tr>';
			  			foreach($row as $value){
			  				?>
							    <td><?php echo $value ?></td>
			  				<?php
			  			}
			  			echo "</tr>";
			  		}
			  	}else{
			  		echo "No data found";
			  	}
			  ?>
			</table>
		</div>
	</div>
<?php include("footer.php"); ?>
