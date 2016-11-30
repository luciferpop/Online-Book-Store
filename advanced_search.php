<?php
  session_start();
  ini_set('display_errors', 'On');
  include_once "helper/dbconn.php";
  require_once('helper/pageclass.php');
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Book Store | Advanced Search</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<style type="text/css">

* { margin: 0; padding: 0; }

html { height: 100%; font-size: 62.5% }

body { height: 100%; background-color: #FFFFFF; font: 1.2em Verdana, Arial, Helvetica, sans-serif; }


/* ==================== Form style sheet ==================== */

form { margin: 25px 0 0 29px; width: 445px; padding-bottom: 30px }
form * { vertical-align: middle; }

fieldset { margin: 0 0 22px 0; border: 0; }
legend { font-size: 1.2em; color: #2E6600; font-weight: bold; }

label { float: left; display: block; width: 100px; margin-top: 4px; clear: left; }
label.choose { width: 162px; }
label.spam-protection { display: inline; width: auto; }

input.text, textarea, input.choose, input.answer { border: 1px solid #909090; padding: 3px; }
input.text { width: 300px; margin: 0 0 8px 0; }
textarea { width: 400px; margin: 0 0 12px 0; display: block; }

select { width: 250px; border: 1px solid #909090; padding: 2px;  margin: 0 0 8px 0; }

input.choose { margin: 0; }
input.answer { width: 40px; margin: 0 0 0 10px; }
input.submit-text { font: 1.4em Georgia, "Times New Roman", Times, serif; letter-spacing: 1px; display: block; margin: 23px 0 0 0; }

hr.formik { height: 1px; color: gray; background-color: gray; border: 0 solid gray; margin: 3px 0 20px 0; }
form br { display: none; }

</style>

</head>

<body>
	<div id="main_container">
	<?php 
		require('helper/header.php');
	?>
	<div class="crumb_navigation"> Navigation: <span class="current">Advanced Search</span></div>
	<div class="left_content">
	<div class="prod_box">
    </div>
	</div>
	<div class="center_content">
	<form action="search_result.php" method="post">
		<!-- ============================== Fieldset 1 ============================== -->
		<fieldset>
			<legend>Title and year</legend>
			<hr class="formik" />
				<label for="input-one"><strong>Give a title:</strong></label><br />
				<input name="title" type="text" size="20" id="input-one" class="text" /><br />

				<label for="input-two"><strong>Year of publish:</strong></label><br />
				<input name="year" type="text" size="20" id="input-two" class="text" />
		</fieldset>
		<!-- ============================== Fieldset 1 end ============================== -->


		<!-- ============================== Fieldset 2 ============================== -->
		<fieldset>
			<legend>Category and publisher</legend>
			<hr class="formik" />
				<label for="select" class="choose"><strong>Category:</strong></label><br />
					<select id="select" name="cate">
						<option value="" selected="selected">--- Choose a category ---</option>
						<?php
							$sql = "SELECT Category, COUNT(ISBN) AS CNT FROM BOOK GROUP BY Category ORDER BY CNT DESC LIMIT 20";
							$result = mysqli_query($conn, $sql);
							while ($row = $result->fetch_assoc()) {
								echo '<option value='.$row['Category'].'>'.$row['Category'].'</option>';
							}
						?>
					</select>

				<label for="select2" class="choose"><strong>Publisher:</strong></label><br />
					<select id="select2" name="pub">
						<option value="" selected="selected">--- Choose a publisher ---</option>
						<?php
							$sql = "SELECT PubName, COUNT(ISBN) AS CNT FROM BOOK GROUP BY PubName ORDER BY CNT DESC LIMIT 20";
							$result = mysqli_query($conn, $sql);
							while ($row = $result->fetch_assoc()) {
								echo '<option value='.$row['PubName'].'>'.$row['PubName'].'</option>';
							}
						?>
				</select>
		</fieldset>
		<!-- ============================== Fieldset 2 end ============================== -->


		<!-- ============================== Fieldset 3 ============================== -->
		<fieldset>
			<legend>Verification</legend>
			<hr class="formik" />
			<!-- <textarea name="message" id="message" cols="20" rows="10"></textarea><br /> -->
			<label for="protection" class="spam-protection">Verify yourself: 1&nbsp;+&nbsp;1&nbsp;=</label><br />
			<input name="ochrana" type="text" id="protection" class="answer" /><br />
		</fieldset>
		<!-- ============================== Fieldset 3 end ============================== -->


		<p style="margin-left: 325px;"><input type="submit" alt="SUBMIT" name="Submit" value="Seach" class="submit-text" /></p>
	</form>
	</div>
	</div>
<?php
    require "helper/footer.php";
?>
</body>
</html>

