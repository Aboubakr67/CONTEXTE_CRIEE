<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<p> Site fonctionnel </p>


		<?php
			foreach($result as $r) {
				echo $r['idLot'];
			}
		?>

