<?php


use Chippyash\Matrix\Matrix;
//
  require '../vendor/autoload.php';
//
// // simple code test
//
// $matrix = '{
//             "matrix": [
//                 [1, 2, 3],
//                 [4, 5, 6],
//                 [7, 8, 9]
//             ]
//         }';
// //
// //
//  $obj = new calculate($matrix,false,false,'2-x');
// //
// echo '<pre>';
// var_dump($obj->validate());
// // var_dump($obj->add());
// // var_dump($obj->substract());
// // var_dump($obj->multiply());
// // var_dump($obj->divide());
// var_dump($obj->sum());
// var_dump($obj->product());
// var_dump($obj->max());
// var_dump($obj->min());
// var_dump($obj->average());
// echo '</pre>';

/**
 * TODO Comments  If I win ticets for starupweekend
 */
class calculate
{
    private $matrix_obj,
            $matrix_json,
            $matrix_rows,
            $matrix_cols,
            $pos_1_str,
            $pos_2_str,
            $pos_1_arr = array(),
            $pos_2_arr = array(),
            $val = array(),
            $range_str,
            $range_arr = array(1, 1);

    public $error_code,
           $error_message;

    public function __construct($matrix_json, $pos_1_str = false, $pos_2_str = false, $range = false)
    {
        // load variables
        $this->matrix_json = $matrix_json;
        $this->pos_1_str = $pos_1_str;
        $this->pos_2_str = $pos_2_str;
        $this->range_str = $range;

    }

    public function validate()
    {
        // if no matrix return false
        if (!$this->validate_matrix())
            return false;
        // not valid positions
        if ($this->pos_1_str OR $this->pos_2_str){
            return $this->validate_positions();
        }

        // optional validation of range
        return $this->validate_range();


    }

    public function validate_matrix()
    {
        // testing json
        $matrix_array = json_decode($this->matrix_json, true);

        // testing array
        if (!is_array($matrix_array)) {
            $this->error_code = 422;
            $this->error_message = 'No request body.';

            return false;
        }

        // testing matrix key
        if (!array_key_exists('matrix', $matrix_array)) {
            $this->error_code = 422;
            $this->error_message = 'No matrix field.';

            return false;
        }

        // if matrix is array
        if (!is_array($matrix_array['matrix'])) {
            $this->error_code = 422;
            $this->error_message = 'No matrix inside field.';

            return false;
        }

        // loading matrix obj for operation
        $this->matrix_obj = new Matrix($matrix_array['matrix']);

        // if is empty
        if ($this->matrix_obj->is('empty')) {
            $this->error_code = 422;
            $this->error_message = 'Empty mantrix no values passed.';

            return false;
        }


        $this->matrix_rows = $this->matrix_obj->rows();
        $this->matrix_cols = $this->matrix_obj->columns();

        return true;
    }

    public function validate_positions()
    {

        // get array from string
        $this->pos_1_arr = explode('-', $this->pos_1_str);
        $this->pos_2_arr = explode('-', $this->pos_2_str);

        // if is array
        if (!is_array($this->pos_1_arr) or !is_array($this->pos_2_arr)) {
            $this->error_code = 422;
            $this->error_message = "No parameter delimiter missing  '-'.";

            return false;
        }

        // two dimensional position x and y
        if (count($this->pos_1_arr) !== 2 or count($this->pos_2_arr) !== 2) {
            $this->error_code = 422;
            $this->error_message = 'Wrong field format.';

            return false;
        }

        // CHECK OUT OF MATRIX RANGE
        // position 1
        if ($this->pos_1_arr[0] > $this->matrix_rows or $this->pos_1_arr[1] > $this->matrix_cols) {
            $this->error_code = 422;
            $this->error_message = 'postion_1 out of matrix range.';

            return false;
        }

        // position 2
        if ($this->pos_2_arr[0] > $this->matrix_rows or $this->pos_2_arr[1] > $this->matrix_cols) {
            $this->error_code = 422;
            $this->error_message = 'postion_2 out of matrix  range.';

            return false;
        }

        $this->val[] = $this->matrix_obj->get($this->pos_1_arr[0], $this->pos_1_arr[1]);
        $this->val[] = $this->matrix_obj->get($this->pos_2_arr[0], $this->pos_2_arr[1]);

        return true;
    }

    public function validate_range()
    {
        // OPTIONAL PRAPRAMETER
        if (!$this->range_str) {
            return true;
        }

        $this->range_arr = explode('-', $this->range_str);

        // two params
        if (!is_array($this->range_arr)) {
            $this->error_code = 422;
            $this->error_message = "No parameter delimiter missing  '-'.";

            return false;
        }

        // two dimensional parameter
        if (count($this->range_arr) !== 2) {
            $this->error_code = 422;
            $this->error_message = 'Wrong parameter format.';

            return false;
        }

        // one of them are X support uppercase lowercase
        if (!(mb_strtolower($this->range_arr[0], 'UTF-8') == 'x' OR mb_strtolower($this->range_arr[1], 'UTF-8') == 'x')) {
            $this->error_code = 422;
            $this->error_message = "Missing 'x' in parameter.";

            return false;
        }

        $row = intval($this->range_arr[0]);
        $col = intval($this->range_arr[1]);

        if ($row and $row > $this->matrix_rows) {
            $this->error_code = 422;
            $this->error_message = 'Row is out of matrix range.';

            return false;
        }

        if ($col and $col > $this->matrix_cols) {
            $this->error_code = 422;
            $this->error_message = 'Column is out of matrix range.';

            return false;
        }

        $this->range_arr[0] = $row;
        $this->range_arr[1] = $col;

        return true;
    }

    public function add()
    {
        return $this->val[0] + $this->val[1];
    }

    public function subtract()
    {
        return $this->val[0] - $this->val[1];
    }

    public function multiply()
    {
        return $this->val[0] * $this->val[1];
    }

    public function divide()
    {
        //  be careful about zero and false value !!!!

        if ($this->val[1] === 0) {
            $this->error_code = 422;
            $this->error_message = 'Division by zero is not defined';

            return false;
        }

        $result = $this->val[0] / $this->val[1];
        $resul = round($result, 2);

        return $result;
    }

    public function sum()
    {

        // rows
        $row = $this->range_arr[0];
        $col = $this->range_arr[1];

        $row = $row ? $row : 1;
        $col = $col ? $col : 1;

        $sum = 0;
        // start with rows
        while ($row <= $this->matrix_rows):

            // contiu cols
            while ($col <= $this->matrix_cols):

                $sum = $sum + $this->matrix_obj->get($row, $col);

        if (!$this->range_arr[0]) {
            break;
        }

        ++$col;
        endwhile;

        if (!$this->range_arr[1]) {
            break;
        }

            // reset col
            $col = 1;
        ++$row;
        endwhile;

        return $sum;
    }

    public function product()
    {
        // rows
        $row = $this->range_arr[0];
        $col = $this->range_arr[1];

        $row = $row ? $row : 1;
        $col = $col ? $col : 1;

        $product = 1;
        // start with rows
        while ($row <= $this->matrix_rows):

            // contiu cols
            while ($col <= $this->matrix_cols):

                $product = $product * $this->matrix_obj->get($row, $col);

        if (!$this->range_arr[0]) {
            break;
        }

        ++$col;
        endwhile;

        if (!$this->range_arr[1]) {
            break;
        }

            // reset col
            $col = 1;
        ++$row;
        endwhile;

        return $product;
    }

    public function max()
    {
        // rows
        $row = $this->range_arr[0];
        $col = $this->range_arr[1];

        $row = $row ? $row : 1;
        $col = $col ? $col : 1;

        $max = 0;
        // start with rows
        while ($row <= $this->matrix_rows):

            // contiu cols
            while ($col <= $this->matrix_cols):

                $value = $this->matrix_obj->get($row, $col);

        $max = $max < $value ? $value : $max;

        if (!$this->range_arr[0]) {
            break;
        }

        ++$col;
        endwhile;

        if (!$this->range_arr[1]) {
            break;
        }

            // reset col
            $col = 1;
        ++$row;
        endwhile;

        return $max;
    }

    public function min()
    {
        $row = $this->range_arr[0];
        $col = $this->range_arr[1];

        $row = $row ? $row : 1;
        $col = $col ? $col : 1;

        $min = $this->matrix_obj->get($row, $col);
        // start with rows
        while ($row <= $this->matrix_rows):

            // contiu cols
            while ($col <= $this->matrix_cols):

                $value = $this->matrix_obj->get($row, $col);

        $min = $min > $value ? $value : $min;

        if (!$this->range_arr[0]) {
            break;
        }

        ++$col;
        endwhile;

        if (!$this->range_arr[1]) {
            break;
        }

            // reset col
            $col = 1;
        ++$row;
        endwhile;

        return $min;
    }

    public function average()
    {
        $row = $this->range_arr[0];
        $col = $this->range_arr[1];

        $row = $row ? $row : 1;
        $col = $col ? $col : 1;

        $sum = 0;
        $avg = 0;
        $divider = 0;
        // start with rows
        while ($row <= $this->matrix_rows):

            // contiu cols
            while ($col <= $this->matrix_cols):

                $value = $this->matrix_obj->get($row, $col);

                $sum = $sum + $value;
                ++$divider;

                if (!$this->range_arr[0]) {
                    break;
                }

                ++$col;
            endwhile;

            if (!$this->range_arr[1]) {
                break;
            }

            // reset col
            $col = 1;
            ++$row;
        endwhile;

        $avg = $sum / $divider;

        $avg = round($avg, 2);

        return $avg;
    }
}
