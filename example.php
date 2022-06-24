/*
You can use this code if search is not working!!!
$text_to_search = $_POST['textToSearch'];
$text_to_search = pg_escape_string($text_to_search);
if(isset($_POST["search"])){
		unset($_POST["search"]);
	}
*/
$WHERE = [
		"user_id = 1",
		"status = 2"
	];
/*
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
  array( 'db' => 'id', 			'dt' => 0 ),
  array( 'db' => 'title', 	'dt' => 1 ),
  array( 'db' => 'content', 'dt' => 2 )
);
*/
$columns = array(
		array( 'db' => 'id', 			'dt' => 'id' ),
		array( 'db' => 'title', 	'dt' => 'title' ),
		array( 'db' => 'content', 'dt' => 'content' )
	);
$result = getDrafts($data,$columns,$WHERE);
echo json_encode($result);
function getDrafts($request,$columns,$WHERE=null){
	global $db;//PDO Connection for Postgre
	// DB table to use
	$table = 'posts';
	// Table's primary key
	$primaryKey = 'id';

	
	

	// SQL server connection information IF YOU DON'T HAVE PDO CONNECTION CREATE YOURSELF DON'T USE THIS COMMENT THIS IS DEFAULT COMMENT WHICH COMES FROM ssp.class.php !!
	/* $sql_details = array(
		'user' => '',
		'pass' => '',
		'db'   => '',
		'host' => ''
	); */
	$sql_details = $db;
  // This two lines below is important for PostgreSQL If you delete it probably You can't get results and can't see results !!
	$sql_details->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql_details->exec("SET NAMES 'UTF8'");
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	* If you just want to use the basic configuration for DataTables with PHP
	* server-side, there is no need to edit below this line.
	*/

	require( 'pg.ssp.class.php' );

	return SSP::complex( $data, $sql_details, $table, $primaryKey, $columns,null,$WHERE);

}
