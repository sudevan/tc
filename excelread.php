<?php 
include('connection.php');
$data = array();
function add_person( $first, $middle, $last, $email )
{

 global $data;
 echo" ('$middle','$last',$email,2020),";
/*
	$admissionno=10100;
	$sql="SELECT name from student where admissionno=$admissionno";
	
	$result=$conn->query($sql);
	$row = $result->fetch_assoc();
	echo json_encode($row);

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}*/
 $data []= array(
   'first' => $first,
   'middle' => $middle,
   'last' => $last,
   'email' => $email
 );
}
 
if ( $_FILES['file']['tmp_name'] )
{
 $dom = DOMDocument::load( $_FILES['file']['tmp_name'] );
 $rows = $dom->getElementsByTagName( 'Row' );
 $first_row = true;
 foreach ($rows as $row)
 {
   if ( !$first_row )
   {
     $first = "";
     $middle = "";
     $last = "";
     $email = "";
 
     $index = 1;
     $cells = $row->getElementsByTagName( 'Cell' );
     foreach( $cells as $cell )
     {
       $ind = $cell->getAttribute( 'Index' );
       if ( $ind != null ) $index = $ind;
 
       if ( $index == 1 ) $first = $cell->nodeValue;
       if ( $index == 2 ) $middle = $cell->nodeValue;
       if ( $index == 3 ) $last = $cell->nodeValue;
       if ( $index == 4 ) $email = $cell->nodeValue;
 
       $index += 1;
     }
     add_person( $first, $middle, $last, $email );
   }
   $first_row = false;
 }
}
?>
<html>
<body>
These records have been added to the database:
<table>
<tr>
<th>First</th>
<th>Middle</th>
<th>Last</th>
<th>Email</th>
</tr>
<?php foreach( $data as $row ) { ?>
<tr>
<td><?php echo( $row['first'] ); ?></td><
<td><?php echo( $row['middle'] ); ?></td><
<td><?php echo( $row['last'] ); ?></td><
<td><?php echo( $row['email'] ); ?></td><
</tr>
<?php } ?>
</table>
Click <a href="list.php">here</a> for the entire table.
</body>
</html>
