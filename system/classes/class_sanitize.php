<?php

/**
 * sanitize class, that returns the values according to the type indicated sanitized
 *
 * Data types that reviews are:
 *    str_nohtml
 *    ip -> for type ipv4 n.n.n.n
 *    int
 *    smallint
 *    mediumint
 *    tinyint
 *    float
 *    boolean
 *    email
 *    url -> for type http://www.yourdomain.com
 *    mysql -> replace ' by \' and " bye \"
 *    mysqlUndo
 *    dateEn
 *    dateEs
 *    hour
 *

 * You can call function by function individually, or sanitize all content sent by post or get

 * EXAMPLE:

     # Created instance of the class
     $obj=new sanitize();

     # We determine how the variables are received. The default is post
     $obj->setAction("post")

     # We send an array indicating:
     #    variable name to be passed to the function as first parameter
     #    array containing:
     #        name of the function to call
     #        second parameter to pass to the function if necessary

     $obj->setValues(
        array(
            "inputName1"=>array("mysql",15),
            "inputName2"=>array("tinyint"),
            "inputName3"=>array("ip"),
            "inputName4"=>array("email"),
            "inputName5"=>array("int")
        )

    );

     # To sanitize the POST or GET values are replaced directly.

     $obj->sanitize();

     # We can also sanitize individually ...

     $valorSanitizado=$obj->mysql($_POST["inputName1"],15);

     $valorSanitizado=$obj->int($_POST["inputName5"]); 

 */

class sanitize
{
    # Determines whether we review the POST or GET parameters
    private $action="POST";

    # The array contains the name of the fields with the type of review
    public $values;

    public function __construct()
    {

    }

    /**
     * Function that determines whether the reception of parameters is by post or get
     * Receive: post|get
     */

    public function setAction($value)
    {
        if (strtoupper($value) == "POST" || strtoupper($value) == "GET")

            $this->action = strtoupper($value);

        return $this;
    }

    /**
     * Function to receive an array of field names and types of review.
     *    array("id"=>array("int"),"name"=>array("str_nohtml",1000))
     */

    public function setValues($value)
    {
        $this->values = $value;
        return $this;
    }

    /**
     * Function that sanitizes the value received by post or get with the values received in the values array
     */

    public function sanitize()
    {

        if (count($this->values)) {

            # We seek $ data values within keys
            # Returns only the $key => $value matching the contents of $data

            if ($this->action == "POST")

                $data=array_intersect_key($_POST, $this->values);

            else

                $data=array_intersect_key($_GET, $this->values);

            foreach ($data as $key => $value) {

                $values1 = $data[$key];
                $values2 = '';

                if (count($this->values[$key]) > 1)

                    $values2 = $this->values[$key][1];

                # Function call received by the second parameter of $this->values,
                # and response put it in the variable $_ POST[...]
                # We send an array with the argument list

                $_POST[$key] = call_user_func(array("sanitize",$this->values[$key][0]),$values1,$values2);

            }

        }

    }

    /**
     * Returns the formatted string with quotes and characters html
     */

    public function str_nohtml($value, $length=0)
    {

        $result = htmlentities(trim($value),ENT_QUOTES);

        if ($length > 0 && strlen($result) > $length)

            $result = substr($result,0,$length);

        return $result;

    }

    /**
     * Returns the ip if it is correct.
     * Empty if not a correct ip
     */

    public function ip($value)
    {

        return filter_var($value,FILTER_VALIDATE_IP);

    }

    /**
     * Function to sanitize a integer
     * Returns the integer value of the value received.
     * Return 0 if:
     *    - is the value received
     *    - if not an integer value
     */

    public function int($value)
    {

        return (int)$value;

    }

    /**
     * Function to sanitize a value smallint
     * It must get:
     *    $value
     *    $unsigned [true|false]: Determines if the type is unsigned
     * Returns the value received if between:
     *    -32.768 and 32.767
     * Returns 0 if not between the values indicated
     */

    public function smallint($value,$unsigned=false)
    {

        if ($unsigned) {

            if ($value >= 0 && $value <= 65535)

                return $value;

        } else {

            if ($value >= -32768 && $value <= 32767)

                return $value;

        }

        return 0;

    }

    /**
     * Function to sanitize a mediumint value
     * This must get:
     *    $value
     *    $unsigned [true|false]: Determines if the type is unsigned
     * Returns the value received if between:
     *    -8.388.608 and 8.388.607
     * Returns 0 if not indicated values
     */

    public function mediumint($value,$unsigned=false)
    {

        if ($unsigned) {

            if ($value >= 0 && $value <= 16777215)

                return $value;

        } else {

            if ($value >= -8388608 && $value <= 8388607)

                return $value;

        }

        return 0;

    }

    /**
     * Function that validates a tinyint value. It must be between 0 and 255
     */
    public function tinyint($value)
    {

        if ($value >= 0 && $value <= 255)

            return $value;

        return 0;

    }

    /**
     * Function to sanitize a value float
     * Returns the value received if a float.
     * Returns 0 if:
     *    - is the value received
     *    - if not an integer value
     */

    public function float($value)
    {

        return (float)$value;

    }

    /**
     * Function to sanitize a Boolean value
     * Returns 1 if the value is true, TRUE, 1, "1", "yes", "on"
     * Returns 0 if another value
     */

    public function boolean($value)
    {

        if (filter_var($value, FILTER_VALIDATE_BOOLEAN))

            return 1;

        return 0;

    }

    /**
     * Function for sanitize an email
     * Returns the email if this is correct.
     * If it is incorrect or the length exceeds the specified returns empty
     */

    public function email($value, $length = 0)
    {

        $result = filter_var($value, FILTER_VALIDATE_EMAIL);

        if ($length > 0 && strlen($result) > $length)

            $result = '';

        return $result;

    }

    /**
     * Function to validate a URL: http://www.yourdomain.com
     * Returns the url or empty if not correct url
     */

    public function url($value)
    {

        return filter_var(trim($value), FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED);

    }

    /**
     * Returns the string, putting a backslash before a single quote and double quote
     * This must get:
     *    $value
     *    $length -> maximum logitud of string: 0 unlimited
     * Sample:
     *    a'a"a -> a\'a\"a
     */

    public function mysql($value, $length = 0)
    {

        $result = addslashes(trim($value));

        //$result=str_replace("'","\'",str_replace("\"","\\\"",trim($value)));

        if ($length > 0 && strlen($result) > $length)

            $result = substr($result, 0, $length);

        return $result;

    }

    /**
     * Undo the funcion "mysql". Replace single quotes, and doubles
     * Sample:
     *    a\'a\"a -> a'a"a
     */

    public function mysqlUndo($value)
    {

        return stripslashes(trim($value));

        //return str_replace("\'","'",str_replace("\\\"","\"",trim($value)));

    }

    /**
     * Sanitizes a date type english format, for type:
     *    yy/m/d o yyyy/mm/dd
     *    yy-m-d o yyyy-mm-dd
     * Returns the date if it is correct or empty if not correct
     */

    public function dateEn($value)
    {

        $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][12])[\/|-](0?[1-9]|[12][0-9]|[3][01])$/";

        if (preg_match($pattern, $value))

            return $value;

        return '';

    }

    /**
     * Sanitizes a date format in Spanish of type:
     *    d/m/yy o dd/mm/yyyy
     *    d-m-yy o dd-mm-yyyy
     * Returns the date if it is correct or empty if not correct
     */

    public function dateEs($value)
    {

        $pattern = "/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][12])[\/|-](0?[1-9]|[12][0-9]|[3][01])$/";

        if (preg_match($pattern, $value))

            return $value;

        return '';

    }

    /**
     * Sanitized a hour
     * Returns the time it is correct or 0 if it is not correct
     */

    public function hour($value)
    {

        $pattern = "/^([0-5]?[0-9])$/";

        if (preg_match($pattern, $value))

            return $value;

        return "0";

    }

    /**
     * Sanitized a hours:minutes
     * Returns the hour:minutes if it is correct or 0 if it is not correct
     */

    public function hourMinute($value)
    {

        $pattern = "/^([0-5]?[0-9]):([0-5]?[0-9])$/";

        if (preg_match($pattern, $value))

            return $value;

        return "0";

    }

}
?>