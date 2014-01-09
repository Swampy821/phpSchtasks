<?php
    class schtasks {
        
            public static function removeTask() {
                
            }
            
            public static function createTask() {
                
            }
            
            public static function modifyTask() {
                
            }
            
            public static function runTask($taskName) {
                $command = "schtasks /run /tn ".$taskName;
                exec($command,$outputData);
                return $outputData;
            }
            
            public static function getAllTasks() {
                
            }
            
            public static function getTaskInfo() {
                 $command = "schtasks /query /fo LIST";
                 exec($command,$outputData);
                 return $outputData;
            }
                    
            public static function disableTask() {
                
            }
    }
?>
