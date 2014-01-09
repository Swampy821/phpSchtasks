<?php
include("schtasks.php");
/**** EXAMPLE OF USE   ****/
//Get array of all the tasks.
$arrOfTasks = schtasks::queryTasks()->getAllTasks();

//Add a task and a folder
$return = schtasks::createTask("TEST\TEST", "TEST", "MONTHLY");

//Run the task
$return = schtasks::runTask("TEST\TEST");

//Delete the Task
$return = schtasks::removeTask("TEST\TEST");

//Relete the Folder
$return = schtasks::removeTask("TEST");




?>
