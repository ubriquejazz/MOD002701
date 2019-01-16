    <div id="footer">Copyright <?php echo date("Y"); ?>, The As and When Foundation</div>

	</body>
</html>
<?php
  // 5. Close database connection
	if (isset($connection)) {
	  mysqli_close($connection);
	}
?>
