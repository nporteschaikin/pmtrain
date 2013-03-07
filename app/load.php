<?php

require ( 'lib/config/config.php' );
require ( 'lib/db/connection.php' );
require ( 'lib/db/table.php' );
require ( 'lib/db/sql.php' );
require ( 'lib/db/model.php' );

// include all files in directory
// could definitely be changed.
$include_directories = array ( 'app/models/' );
foreach ( $include_directories as $dir ) {
	$models = scandir ( $dir );
	foreach ( $models as $model ) {
		$model = pathinfo ( $model );
		if ( $model['extension'] == 'php' ) {
			require $dir . $model['basename'];
		}
	}
}


require ( 'config.php' );
