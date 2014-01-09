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
    </ul>
</li>
</ul>



##Examples

###Querying tasks.

####Query All Tasks
```php
$taskArray = schTasks::queryTasks()->getAllTasks();
```