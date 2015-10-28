<?php 
// 10.66.147.5:9101
	$memcache = new Memcache;
	$con_ok = $memcache->connect('10.66.147.5',9101);
	
	// for ($i=0; $i < 10000 ; $i++) { 
	// 	$memcache->set('hello==>'.$i,'world-->'.$i);

	// }

	// for ($i=0; $i < 10000 ; $i++) { 
	// 	echo $memcache->get('hello==>'.$i);
	// 	flush();
		
	// }
	echo "ok";
 ?>