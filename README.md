phpSchtasks
===========

Scheduled tasks Class to give a simulated Cron that can be controlled via php on a windows server.



<h3>list of commands</h3>
<ul>
<li>removeTask</li>
<li>createTask</li>
<li>modifyTask</li>
<li>runTask</li>
<li>queryTasks 
    <ul>
        <li>getTaskInfo</li>
        <li>getAllTasks</li>
        <li>getReadyTasks</li>
        <li>getAllTasksInFolder</li>
        <li>getTaskCount</li>
    </ul>
</li>
</ul>



##Examples

###Querying tasks.

#####Query All Tasks
```php
$taskArray = schTasks::queryTasks()->getAllTasks();
```

#####Query Ready Tasks
```php
$taskArray = schTasks::queryTasks()->getReadyTasks();
```

#####Query all tasks within a folder
```php
$taskArray = schTasks::queryTasks()->getAllTasksInFolder("TaskFolder");
```

#####Query single task.
```php
$taskArray = schTasks::queryTasks()->getTaskInfo("SingleTask");
```

#####Count Tasks 
```php
$taskCount = schtasks::queryTasks()->getTaskCount('Optional Folder');
```

###Creating Tasks
```php
$taskResponse = schTasks::createTask("taskFolder\taskName","runThisProgram.exe","DAILY","09:00","1/9/2014","12/9/2014");
```


###Modifying Tasks
```php
$taskResponse = schTasks::modifyTask("taskFolder\taskName","runThisNewProgram.exe","DAILY","10:00","1/9/2013","12/9/2014");
```


###Removing Tasks
```php
$taskResponse = schTasks::removeTask("taskFolder\taskName");
```

###Running Tasks
```php
$taskResponse = schTasks::runTask("taskFolder\taskName");
```
