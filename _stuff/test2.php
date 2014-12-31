<?php
/* This script demostrates concurrency with multiple (3 in this case) processes ,
Each of the child will be the given the same number to determine if it is prime.
Execution time will be recorded for later comparision.
*/

function Check_if_prime($prime_number)
// Checks if a number is prime, direct test.
{
    for ($i = 2; $i < floor(sqrt($prime_number)); $i++) {

        if ($prime_number % $i == 0) {
            break;
            return false;

        }
    }
    return True;

}

echo "Parent Process ready to fork 3 new child processes \n";
$ppid = posix_getpid(); // Keep refrence to the PID of the parent process
$pids = array(0, 1, 2); // An array to hold refrence to PIDs of child processes

for ($i = 0; $i <= 2; $i++) {

    echo "Forked child" . $i . "\n";
    $pid = pcntl_fork(); // Forks a new child process and keeps refrence to its PID;
    if (!$pid) {
        /* This only runs in a child process */
// Get the PID of the child process display it and break out of the loop
        $pids[$i] = posix_getpid();
        echo $pids[$i] . "\n";
        break;
    } else {
        $pids[$i] = $pid;
    }
}

/* By this time all processes, child and parent have there own copy of $pid and $pids[]*/

$current_pid = posix_getpid(); // Get the PID of the curently running process

if ($current_pid = $pids[0]) {
    /*Task for child 1 */
    $start_time = microtime(true);
    Check_if_prime(98764321261);
    Check_if_prime(98764321261);
    $end_time = microtime(true);
    echo $end_time - $start_time . "seconds. \n";
    exit();
} elseif ($current_pid = $pids[1]) {
    /*Task for child 2 */
    $start_time = microtime(true);
    Check_if_prime(98764321261);
    Check_if_prime(98764321261);
    $end_time = microtime(true);
    echo $end_time - $start_time . "seconds. \n";
    exit();
} elseif ($current_pid = $pids[2]) {
    /*Task for child 3 */

    $start_time = microtime(true);
    Check_if_prime(98764321261);
    Check_if_prime(98764321261);
    $end_time = microtime(true);
    echo $end_time - $start_time . "seconds. \n";
    exit();
} elseif ($current_pid = $ppid) {
    /* This is the Parent */
    $start_time = microtime(true);
    echo $pids[0] . $pids[1] . $pids[2];
    while (pcntl_waitpid(-1, $status, WNOHANG)) {

    }
    $end_time = microtime(true);
    echo $end_time - $start_time . "seconds. \n";
    exit();
}

?>