<?php
    /**
     * Deal with querying tasks.
     */
    class schtasksTasks {
        /**
         * Array of all the tasks.
         * @var Array
         */
        private $taskArray = array();
        /**
         * Fill $taskArray variable when class initializes. 
         */
        public function __construct() {
            $this->taskArray = $this->retAllTasks();
        }
        /**
         * Queries all the tasks in scheduled tasks.
         * @return Array Return all the tasks. 
         */
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
        /**
         * Queries a specific task.
         * @param String $taskName
         * @return Array Task Information
         */
        public function getTaskInfo($taskName) {
            $taskArray = $this->taskArray;
            
            foreach($taskArray as $key=>$rs) {
                if(strtolower(ltrim($rs['taskname'],'\\'))==strtolower($taskName)) {
                    return $taskArray[$key];
                }
            }
        }
        /**
         * Queries the entire task list. 
         * @return Array The entire tasklist
         */
        public function getAllTasks() {
            return $this->taskArray;
        }
        /**
         * Gets list of all ready tasks. 
         * @return Array Returns list of all ready tasks.
         */
        public  function getReadyTasks() {
            $taskArray = $this->taskArray;
            foreach($taskArray as $key=>$rs) {
                if($rs['status']!='R    eady') {
                    unset($taskArray[$key]);
                } 
            }
            return $taskArray;
        }
        /**
         * Gets list all off tasks within a folder.
         * @param type $folder
         * @return Array Returns list of 
         */
        public function getAllTasksInFolder($folder=null) {
            $taskArray = $this->taskArray;
            if($folder!=null) {
                foreach($taskArray as $key=>$value) {
                    if(strtolower(ltrim($value['folder'], '\\')) != strtolower($folder)) {
                        unset($taskArray[$key]);
                    }
                }
            }
            return $taskArray;
        }
    }
    
    
    
    
    class schtasks {
        /**
         * Returns object schtasksTasks;
         * @return Class schtasksTasks
         */
        public static function queryTasks() {
           return new schtasksTasks;
        }
        /**
         * Removes task. 
         * @param String $taskName
         * @return Array output from schtasks /DELETE
         */
        public static function removeTask($taskName) {
            $comm = 'schtasks /DELETE /F /TN '.$taskName;
            exec($comm, $out);
            return $out;
        }
        /**
         * Creates Task
         * @param String $taskName
         * @param String $command
         * @param String $interval
         * @param String $start
         * @param String $startDate
         * @param String $endDate
         * @return Array Return from schtasks /CREATE
         */
        public static function createTask($taskName, $command, $interval, $start=null, $startDate=null, $endDate=null) {
            $comm = sprintf('SchTasks /Create /SC %s /TN %s /TR %s',$interval,$taskName,$command);
            if($start!==null) {
                $comm .= ' /ST '.$start;
            }
            if($startDate!==null) 
                {$comm .= ' /SD '.$startDate;}
            if($endDate!==null) 
                {$comm .= ' /ED '.$endDate;}
            exec($comm, $output);
            return $output;
        }
        /**
         * Modifies Task
         * @param String $taskName
         * @param String $command
         * @param String $interval
         * @param String $start
         * @param String $startDate
         * @param String $endDate
         * @return Array Return from schtasks /change
         */
        public static function modifyTask($taskName, $command, $interval, $start=null, $startDate=null, $endDate=null) {
            $comm = sprintf('SchTasks /change /SC %s /TN %s /TR %s',$interval,$taskName,$command);
            if($start!==null) {
                $comm .= ' /ST '.$start;
            }
            if($startDate!==null) 
                {$comm .= ' /SD '.$startDate;}
            if($endDate!==null) 
                {$comm .= ' /ED '.$endDate;}
            exec($comm, $output);
            return $output;
        }
        /**
         * Runs task.
         * @param String $taskName
         * @return Array output from schtasks /run
         */
        public static function runTask($taskName) {
            $command = "schtasks /run /tn ".$taskName;
            exec($command,$out);
            return $out;
        }
        
       
    }
?>
