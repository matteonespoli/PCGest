<?php
	exec("isRunning.bat", $task_list);

	if($task_list[0]) //NOT RUNNING
	{
		if(!popen('start "CardListener" include/CardListener/CardListener.exe', "r"))
			die("ERRORE nell'avvio del gestionale");
	}
?>