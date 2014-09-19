<?php
require_once 'functions.php';

?>

          <div class="col-xs-12 col-md-9">
             
            <section id="page-header">

              <h1><span class="glyphicon glyphicon-home"></span> Products :: Import</h1>

            </section>

            <section id="content">



<?php if (isset($_POST['frmAction']) && $_POST['frmAction'] == 'upload') : ?>

<?php 

$allowedExts = array("csv", "txt");
$temp = explode(".", $_FILES["import_file"]["name"]);
$extension = end($temp);
$newFile = '';
$line = array();

if ((($_FILES["import_file"]["type"] == "text/comma-separated-values"))
&& ($_FILES["import_file"]["size"] < 1000000)
&& in_array($extension, $allowedExts)) {
  if ($_FILES["import_file"]["error"] > 0) {
    echo "Return Code: " . $_FILES["import_file"]["error"] . "<br>";
  } else {
    echo "Upload: " . $_FILES["import_file"]["name"] . "<br>";
    echo "Type: " . $_FILES["import_file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["import_file"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["import_file"]["tmp_name"] . "<br>";
    if (file_exists("import/" . $_FILES["import_file"]["name"])) {
      echo $_FILES["import_file"]["name"] . " already exists. ";
    } else {
      move_uploaded_file($_FILES["import_file"]["tmp_name"],
      "import/" . $_FILES["import_file"]["name"]);
      echo "Stored in: " . "import/" . $_FILES["import_file"]["name"];
      $newFile = "import/" . $_FILES["import_file"]["name"];
    }
  }
} else {
  echo "Invalid file";
}

$fileHandle = fopen($newFile, 'r');

$line = fgetcsv($fileHandle);

foreach ($line as $value) {
    echo "COLUMN: " . $value . "<br />";
}

fclose($fileHandle);


	
	
?>


<div style="padding-top:100px">
	<h3>PRODUCT SUCCESSFULLY ADDED</h3>
</div>
<div>
	<button class="button" onCLick="window.opener.location='<?php echo $_POST['caller']?>';window.close()">CLOSE</button>
	
</div>

<?php else : ?>

<div>
	<div style="padding:20px">
		<form name="productNew" method="post" enctype="multipart/form-data">
		<input type="hidden" name="frmAction" value="upload">
        <input type="file" name="import_file">
		<input type="submit" value="Import Products">
		</form>
	</div>

</div>

<?php endif ?>

            </section>

          </div><!-- /.col-sm-12 /.col-lg-9 -->