<html>
	<head></head>
	<title> 글 삭제 페이지 </title>
	<body>

		<script language=javascript>
			function check_form(form) {
				if (!delete_form.passwd.value) {
					alert('패스워드를 입력하세요.');
					delete_form.passwd.focus();
					return;
				}
				delete_form.submit();
			}

			function pass_alert() {
				alert("패스워드가 일치하지 않습니다!!");
				history.back();
			}

			function go_list() {
				history.back(-1);
			}
		</script>

		<?php

		include "./dbconn.inc";

		$table_name="board_free";

		$mode=$_GET[mode];
		$delete_uno=$_GET[delete_uno];
		$pn=$_GET[pn];

		if(!$mode)
		$mode="form";

		if(!strcmp($mode,"form")){
		$query="select name from $table_name where uno=$delete_uno";
		$result=mysql_query($query,$dbconn) or die('mysql 접속 혹은 쿼리 error  '.mysql_error());
		$name=mysql_result($result,0,0);       // 글쓴이

		?>

		<form name="delete_form" method="post" action="./delete.html?mode=post&delete_uno=<?=$delete_uno ?>">
			<table width="300" border=1 cellspacing=0 cellpadding=0 align=center>
				<tr>
					<td height=25 align=center><b><?=$name ?> </b> 님의 글을 삭제합니다. </td>
				</tr>
				<tr>
					<td height=40 align=center> 패스워드
					<input type=password name="passwd" size="21">
					</td>
				</tr>
			</table>
			<table width=300 border=0 cellspacing=0 cellpadding=0 align=center>
				<tr>
					<td width=100></td><td width=100></td>
					<td align =center>
					<input type=button onclick="check_form();" value="확인">
					<input type=button onclick="go_list('<?=$delete_uno ?>')" value="취소">
					</td>
				</tr>
			</table>
		</form>

		<?php
		}else if(!strcmp($mode,"post"))
		{
		$passwd=$_POST[passwd];
		echo "\$table_name : $table_name
		<br>
		";

		$query="select passwd from $table_name where uno=$delete_uno";
		$result =mysql_query($query,$dbconn) or die('쿼리 혹은 DB 접속 실패'.mysql_error());
		$real_passwd=mysql_result($result,0,0);

		echo "\$real_passwd : $real_passwd
		<br>
		";

		$query="select password('$passwd')";
		$result=mysql_query($query,$dbconn);
		$input_passwd=mysql_result($result,0,0);

		echo "\$input_passwd : $input_passwd
		<br>
		";

		if(strcmp($real_passwd,$input_passwd))
		{ ?>
		<script>
			pass_alert();
		</script>
		<?
		exit();
		}

		$query="delete from $table_name where uno=$delete_uno";
		$result=mysql_query($query,$dbconn);
		?>

		<script language="javascript">
			alert("글이 삭제 되었습니다");
			document.location.href = './list.html';
		</script>

		<?
		}
		?>

	</body>
</html>