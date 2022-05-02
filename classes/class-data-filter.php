<?php

include("class-db.php");

class DataFilter {
	function __construct($db){
		extract($_POST);

		if($startdate && $enddate){
			$data = $db->getByDate("buyer_info", "buyer, note, city, phone, entry_at", "entry_at BETWEEN '$startdate' AND '$enddate'");

			if(is_array($data)){
				echo $this->filteredData($data);
			}else{
				echo "<p>No Data Found</p>";
			}
		}
	}

	private function filteredData($data){
		ob_start();
		?>
			<table>
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
				?>
			<table>
		<?php

		return ob_get_clean();
	}
}

new DataFilter($db);
