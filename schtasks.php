<?php
    class schtasksTasks {
        protected $taskArray = array();
        public function __construct() {
            $this->taskArray = $this->retAllTasks();
        }
        public static function factory() {
            return new schtasksTasks;
        }
        private function retAllTasks() {
                $newArray = array();
                $taskCount = 0;
                $command = "schtasks /query /FO LIST";
                exec($command,$outputData); 
                 foreach($outputData as $rs) {
                     $tempArray = explode(":",$rs);
                     if(count($tempArray)===1) {
                         $taskCount++;
                     }else{
                         $newArray[$taskCount][str_replace(' ','_',strtolower($tempArray[0]))] = trim($tempArray[1]);
                     }
                 }
                 foreach($newArray as $key=>$ar) {
                     if(count($ar)<5) {
                         unset($newArray[$key]);
                     }
                 }
                 return $newArray; 
            }
            
            
        public function getAllTasks() {
            return $this->taskArray;
        }
        
        public  function getReadyTasks() {
                $taskArray = $this->taskArray;
                foreach($taskArray as $key=>$rs) {
                    if($rs['status']!='R    eady') {
                        unset($taskArray[$key]);
                    } 
                }
                return $taskArray;
            }
    }
    
    class schtasks {
        public $tasks;
        
        public function __construct() {
            $this->tasks = schtasksTasks::factory();
        }
            public static function removeTask() {
                
            }
            
            public static function createTask() {
                
            }
            
            public static function modifyTask() {
                
            }
            /**
             * 
             * @param type $taskName
             * @return type
             */
            public static function runTask($taskName) {
                $command = "schtasks /run /tn ".$taskName;
                exec($command,$outputData);
                return $outputData;
            }
            
            
            
            
            public static function getTaskInfo() {

            }
                    
            public static function disableTask() {
                
            }
    }
?>
