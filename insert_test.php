<html>
<head><meta charset="utf-8"/></head>
<body>
	<?php
	echo "insert_test0\n";
	//mysql‚ÉÚ‘±
	$link = mysql_connect('localhost','root','Mysql123%');
	echo "insert_test1\n";
	//DB‚Ì‘I‘ð
	$db_selected = mysql_select_db('test_db',$link);
	echo "insert_test2\n";
	//SQL•¶‚Ì”­s
	$result = mysql_query('INSERT INTO user_data(name, password, login_time)
		VALUES("POP", "pass2", now())');
	echo "insert_test3\n";
	?>
</body>
</html>
