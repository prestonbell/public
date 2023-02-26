<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Control Structures and Logical Expressions</title>
    </head>

    <body>

    <h3>While Loops</h3>

        <p>
            <?php
            $count = 3;
            while ($count <= 22) {
                echo $count . ", ";
                $count ++;
            }   
            echo "<br />";
            echo "Count: {$count}";
            ?>
        </p>

        <p>
            <?php
            $count = 3;
            while ($count <= 22) {
                if ($count == 5) {
                    echo "FIVE, ";
                }   else {
                    echo $count . ", ";
                }
                $count ++;
            }   
            echo "<br />";
            echo "Count: {$count}";
            ?>
        </p>

         <p>
            <?php
            $count = 0;
            while ($count <= 22) {
                if ($count != 6) {
                    echo "PIE, ";
                }   else  {
                    echo $count . ", ";
                }
    
                $count ++;
            }   
            echo "<br />";
            echo "Count: {$count}";
            ?>
        </p>

    <h3>Repeating actions with while and do/while loops</h3>
    <p>
        <?php //try removing the if statement
            $i = 0;
            while ($i < 10) {
                $i++;
                echo $i . '<br />';
                if ($i == 6) {
                    break;
                }
            }
        ?>

        <?php //look at the behavior of 'continue'
            $i = 0;
            while ($i < 10) {
                $i++;
                if ($i % 2) {
                    continue;
                }
                echo $i . '<br />';
            }
        ?>

        <?php /* 'do while' is variant of 'while' - while will display nothing if first loop is false, but do while displays one even if false */
           
            $k = 100;
            do {
                $k++;
                echo $i . '<br />';
            } while ($k < 10); 
        ?>

    </p>

    <h3>For Loops</h3>
    <p>

        <?php //compare while loop to for loop
            $number = 0;
            while ($number <= 10) {
                echo $number . ", ";
                $number++;
            }
        ?>
    </p>

    <p>
        <?php 
            //for (initial, test, each)
            for ($number = 0; $number <= 10; $number++) {
                echo $number . ", ";
            }
        ?>
    </p>

    <h3>Foreach Loops</h3>
    <p> 
        <?php //loops through each item of an array, so
                //there is no condition needed
            //foreach (array as value) statement;
            $ages = array(4,8,16,18,22,29,31,54,55);
            foreach ($ages as $age) {
                echo "Age: {$age} <br />";
            }
        ?>
    </p>

    <p> 
        <?php //what about associative arrays?
            $person = array(
                "first_name" => "Kevin", 
                "last_name"  => "Warthen",
                "address"    => "123 Main Street", 
                "city"       => "Berkley",
                "state"      => "CA",
                "zip_code"   => "90210"
            );
            foreach($person as $key => $data) {
                $attr_nice = ucwords(str_replace("_", " ", $key));
                echo "{$attr_nice}: {$data} <br />";
            }
        ?>
    </p>
        
    <h3>Continue</h3>
    <p>
        <?php /* used inside a loop to skip the rest and go to the condition evaluation that starts the next iteration */
            for($numero=0; $numero <= 10; $numero++) {
                if ($numero == 5) {
                    continue;
                }
                echo $numero . ", ";
            }
        ?>
    </p>

    <p>
        <?php
            for ($first=0; $first<=5; $first++) {
                if ($first % 2 == 0) { continue; }
                for ( $second=0; $second<=5; $second++) {
                    if ($second == 3) { continue; }
                    echo $first . "-" . $second . "<br />";
                }
            }
        ?>
    </p>

    <p>
        <?php // loop inside loop
            for ($first=0; $first<=5; $first++) {
                if ($first % 2 == 0) { continue; }
                for ( $second=0; $second<=5; $second++) {
                    if ($second == 3) { continue; }
                    echo $first . "-" . $second . "<br />";
                }
            }
        /* In the above example, the second 'continue' loops back to the second 'for'. What if the desired outcome was to loop back to the first 'for'?  */
        ?>
    </p>

    <p>
        <?php // loop inside loop
            for ($first=0; $first<=5; $first++) {
                if ($first % 2 == 0) { continue(1); }
                for ( $second=0; $second<=5; $second++) {
                    if ($second == 3) { continue(2); }
                    echo $first . "-" . $second . "<br />";
                }
            }
        /* <1> is the default, hidden, silent value. It just means to loop back one loop. <2> means to skip the first layer and go to the second loop - to the parent */
        ?>
    </p>
    
    <h3>Break</h3>
    <p>
        <?php //compare 'continue' to 'break'
            for ($numero=0; $numero <= 10; $numero++) {
                if ($numero == 5) {
                    continue;
                }
                echo $numero . ", ";
            }
        ?>
        
        <hr>

        <?php //we've used break before...
            for ($numero=0; $numero <= 10; $numero++) {
                if ($numero == 5) {
                    break;
                }
                echo $numero . ", ";
            }
        ?>
    </p>

    <hr>

    <?php // breaking out of loop 1
            for ($first=0; $first<=5; $first++) {
                if ($first % 2 == 0) { continue(1); }
                for ( $second=0; $second<=5; $second++) {
                    if ($second == 3) { break(1); }
                    echo $first . "-" . $second . "<br />";
                }
            }
        ?>

        <hr>

        <?php // breaking out of loop 2
            for ($first=0; $first<=5; $first++) {
                if ($first % 2 == 0) { continue(1); }
                for ( $second=0; $second<=5; $second++) {
                    if ($second == 3) { break(2); }
                    echo $first . "-" . $second . "<br />";
                }
            }
        ?>

    <h3>Understanding Array Pointers</h3>
    <p>
        <?php
           $ages = array(11,13,15,16,21,42,43);
           //current: current pointer value
           echo "first is " . current($ages) . "<br />";

           //next: moves the pointer >
           next($ages);
           echo "second is " . current($ages) . "<br />";

           //yes, you can do it twice
           next($ages);
           next($ages);
           echo "fourth is " . current($ages) . "<br />";

           //prev: moves the pointer <
           prev($ages);
           echo "third is " . current($ages) . "<br />";

           //end: moves pointer to last element
           end($ages);
           echo "last is " . current($ages) . "<br />";

           //reset: moves pointer to first element
           reset($ages);
           echo "first (again) is " . current($ages);
        ?>
    </p>

    <p>
        <?php
        //this loop increments the array pointer! 
            while($age = current($ages)) {
                echo $age . ", ";
                next($ages);
            }
        ?>
    </p>

    </body>
</html>

