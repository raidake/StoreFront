<html>
<form method="post" action="readupdatedelete.php">
<table align="center" border="0">
<td>Log ID:</td>
<td><?php echo $_GET['log_ID']; ?></td> <!-- retrieves the log ID specified in "readupdatedelete.php" -->
</tr>
<td>Remarks:</td>
<td><input type="text" name="remarks" value="<?php echo $_GET['remarks']; ?>"/></td><!-- the remark made on the log -->
</tr>
<tr>
<td>&nbsp;</td>
<td align="right">
<input type="hidden" name="log_ID" value="<?php echo $_GET['log_ID'] ?>" />
<input type="hidden" name="update" value="yes" />
<input type="submit" value="update Record"/>
</td>
</tr>
</table>
</form>
<html>