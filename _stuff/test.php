<?php

/* This script demostrates signal handling and concurrency ,
A child process will be given task of determining if a number is prime ,
while the parent will be printing characters to the standard out put.
When the child finishes, it exits with a status (An error code, here the usage is somehow hackish)
based on the status the parent will know if the number was prime or not.
*/

/*Set a php execution directive to check signals after
every low-level tickable statements executed by the parser
This is very important, other wise the signals will not be catched*/
declare(ticks = 1);

echo "Parent Process ready to fork a new process\n";

/* This is a handle function for exit of a child*/

function childexited($signal)
{
    $chpid = pcntl_waitpid(-1, $status, WNOHANG); // Returns the PID of the child if it has already exited
    echo "\nChild with PID: $chpid exited with status:$status\n";
    if ($status == 0) {
        echo "Child Determined number is not Prime\n";
    } else {
        echo "Child Determined number is Prime\n";

    }
    echo "Finished\n";

    exit();
}

/* A task for the child, Tests if a number is prime number using direct test */
function Check_if_prime($prime_number)
{
    for ($i = 2; $i < floor(sqrt($prime_number)); $i++) {

        if ($prime_number % $i == 0) {

            exit (0); // Exits with 0 if it is not prime
        }
    }

    exit(1); // Exits with a number greater than zero if it is prime

}

/* Install the signal handler */
pcntl_signal(SIGCHLD, "childexited"); //

$pid = pcntl_fork(); // This returns 0 for the child and the PID of the child process to the parent

/* Every code after this line will execute in both parent and child */
if ($pid) {
    /* Every thing in this block will run only in the parent ,
    Parent can now do its own task */

    while (true) {

        echo ".";
// pcntl_signal_dispatch(); This is optional and has the same effect as 'decalre(ticks=1)';
    }

} else {

    /* Every thing in this block will run only in the child process hence $pid is zero */
    echo posix_getpid();
    Check_if_prime(98764321261); // Child tests if the number is prime

}

?>