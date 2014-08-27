<?php
if ($_POST['action'] == 'migrate') {
	echo "<h1>Migrating Data</h1>";	
	$upload_dir = 'uploads/';

	$data_file = $upload_dir . basename($_FILES['data_filename']['name']);
	$map_file = $upload_dir . basename($_FILES['columnmap_filename']['name']);

	move_uploaded_file($_FILES['data_filename']['tmp_name'], $data_file);
	move_uploaded_file($_FILES['columnmap_filename']['tmp_name'], $map_file);

try {

	$csvdata = csv_in_array("$map_file", ",", true ); 
} catch (Exception $e) {
	 echo "Exception: " . $e->getMessage();
}


echo "<pre>\r\n"; 
print_r($csvdata);
echo "</pre>\r\n"; 


	
	echo "<h1>Attempting To Handle Data File</h1>";	
	$df_handle = fopen("$data_fle", 'r');
	$old_col_names = fgetcsv($df_handle, ","); 

	while ($data_row = fgetcsv($df_handle, ",")) {
		

	}


function csv_in_array($url, $delm, $head) { 
	echo "MAP FILE: $map_file";

    $csvxrow = file($url);   
    
    $csvxrow[0] = chop($csvxrow[0]); 
    $csvxrow[0] = str_replace($encl,'',$csvxrow[0]); 
    $keydata = explode($delm,$csvxrow[0]); 
    $keynumb = count($keydata); 
    
    if ($head === true) { 
    	$anzdata = count($csvxrow); 
	    $z=0; 
	    for($x=1; $x<$anzdata; $x++) { 
        	$csvxrow[$x] = chop($csvxrow[$x]); 
        	$csvxrow[$x] = str_replace($encl,'',$csvxrow[$x]); 
        	$csv_data[$x] = explode($delm,$csvxrow[$x]); 
        	$i=0; 
        	foreach($keydata as $key) { 
            	$out[$z][$key] = $csv_data[$x][$i]; 
            	$i++;
            }    
        	$z++;
        }
    } else { 
        $i=0;
        foreach($csvxrow as $item) { 
            $item = chop($item); 
            $item = str_replace($encl,'',$item); 
            $csv_data = explode($delm,$item); 
            for ($y=0; $y<$keynumb; $y++) { 
               $out[$i][$y] = $csv_data[$y]; 
            }
        $i++;
        }
    }

	return $out; 
}

	
}
?>