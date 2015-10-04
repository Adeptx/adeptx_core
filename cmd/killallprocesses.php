<?php

/**
* PHP Kill Process
*
* Sometimes, it can happen a script keeps running when it shouldn't, and it
* won't stop after we close the browser, or shutdown the computer. Because it's
* not always easy to use SSH there's a workaround.
*
* @author      Jensen Somers <php@jsomers.be>
*/

class KillAllProcesses {    
    /**
     * Construct the class
     */
    function KillAllProcesses() {
        /*
         * PS   Unix command to report process status
         * -x   Select processes without controlling ttys
         *
         * Output will look like:
         *      16479 pts/13   S      0:00 -bash
         *      21944 pts/13   R      0:00 ps -x
         *
         */
        $output =   shell_exec('ps -x');
        $return .= $output;

        /**
         * Kill all the processes
         * It should be possible to filter in this, but I won't do it now.
         * @param   array   $array
         */
        for ($i = 1; $i < count($output); $i++) {
            $id =   substr($output[$i], 0, strpos($output[$i], ' ?'));
            shell_exec('kill '.$id);
        }

        return $return;
    }
}

return new KillAllProcesses();