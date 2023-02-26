<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Control Structures and Logical Expressions</title>
    </head>

    <body>
<!-- if statements -->
        <p>
           <?php 
           $a = 4;
           $b = 3;

           if ($a > $b) {
               echo "a is larger than b";
           }
           ?>
        </p>

        <p>
           <?php
            $pie = 12 / 3;
            echo $pie;
           ?>
        </p>

<!-- else statements -->  
        <p>
            <?php
            if ($a > $b) {
                echo "a is greater than b";
            }
            else {
                echo "a is less than or equal to b";
            }
            ?>

        </p>

<!-- elseif statements -->
        <p>
            <?php
            $c = 5;
            $d = 5;

            if ($c > $d) {
                echo "a is greater than b";
            }   elseif ($c < $d) {
                echo "a is smaller than b";
            }   else {
                echo "a is equal to b";
            }
            ?>
        </p>

<!-- ternary operator --> 
        <!-- dependant value -->
        <p>
            <?php
            $studio = 'ghibli';
            $best = ($studio == 'marvel') ? 'Yeah, bud.' : 'Wrong choice, dude.' ;
            echo $best;
            ?>
        </p>
            
            <!-- Default value - this t. operator echoes the value to the left of ?: if the value is true, otherwise the value to the right of ?: will echo -->
        <p>
            <?php
            $cost = 20;
            $spend = $cost ?: 25;

            echo $spend;
            ?>

        </p>


<!-- Logical operators -->  
    
    <!-- assign value: =
         equal to, comparing: ==
         identical <ie. type>: ===
         compare: > < >= <= <>
         not equal: !=
         not identical: !==
         ~ we can combine these ~
         and: &&
         or: ||
         not: !  
    -->

    <h3>Comparison and Logical Operators</h3>
        <p>
            <?php
            $aa = 4;
            $bb = 3;
            $cc = 1;
            $dd = 20;
            if (($aa > $bb) || ($cc > $dd)) {
                echo "a is larger than b AND/OR ";
                echo "c is larger than d";
            } //changed amps to pipes to test
            ?>
        </p>

        <br />

        <p>
            <?php //this has all kinds of applications
            $ee = 150;
            if (!isset($ee)) {
                $ee = 200;
            }
            echo $ee;
            ?>
        </p>

        <p>
            <?php //addresses common error with forms
            //don't reject 0 or 0.0
            $quantity = 0;
            if (empty($quantity) && !is_numeric($quantity)) {
                echo "You must enter a quantity.";
            }   else {
                echo "quantity is good";
            }
            ?>
        </p>

<!-- Switch Statements -->     

        <p>
            <?php
            $zap = 2;

            switch ($zap) {
                case 0:
                    echo "zap equals 0 <br />";
                case 1:
                    echo "zap equals 1 <br />";
                case 2:
                    echo "zap equals 2 <br />";
                case 3:
                    echo "zap equals 3 <br />";
            }
            /*Change zap to different nums, 0-3. See that every case following the true case is executed. Next, observe the following to learn about breaks.  */
            ?>
        </p>

        <p>
            <?php
            $whale = 1;

            switch ($whale) {
                case 0:
                    echo "whale equals 0 <br />";
                    break;
                case 1:
                    echo "whale equals 1 <br />";
                    break;
                case 2:
                    echo "whale equals 2 <br />";
                    break;
                case 3:
                    echo "whale equals 3 <br />";
                    break;
            }
            //'Break' skips everything and goes to }
            
            ?>
        </p>

        <p>
            <?php
            $bonus = 9;

            switch ($bonus) {
                case 0:
                    echo "whale equals 0 <br />";
                    break;
                case 1:
                    echo "whale equals 1 <br />";
                    break;
                case 2:
                    echo "whale equals 2 <br />";
                    break;
                case 3:
                    echo "whale equals 3 <br />";
                    break;
                default:
                    echo "bonus! check out how 'default' works! <br />";
            }
            //'Break' skips everything and goes to }
            
            ?>
        </p>

        <p>
            <?php //check out this guy!
            $year = 2013;
            switch (($year - 4) % 12) {
                case  0: $zodiac = 'Rat';     break;
                case  1: $zodiac = 'Ox';      break;
                case  2: $zodiac = 'Tiger';   break;
                case  3: $zodiac = 'Rabbit';  break;
                case  4: $zodiac = 'Dragon';  break;
                case  5: $zodiac = 'Snake';   break;
                case  6: $zodiac = 'Horse';   break;
                case  7: $zodiac = 'Goat';    break;
                case  8: $zodiac = 'Monkey';  break;
                case  9: $zodiac = 'Rooster'; break;
                case 10: $zodiac = 'Dog';     break;
                case 11: $zodiac = 'Pig';     break;
            }
            echo "{$year} is the year of the {$zodiac}.";
            ?>
        </p>

        <p>
            <?php //example of using a switch statement 
            $user_type = 'customer';

            switch ($user_type) {
                case 'student';
                    echo "Welcome!";
                    break;
                case 'press';
                    echo "Hello!";
                    break;
                case 'customer';
                    echo "Howdy!";
                    break;
            }
            ?>
        </p>



    </body>
</html>