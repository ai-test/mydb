<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2014/11/27
 * Time: 23:01
 */

namespace Common\Lib;

class Tree
{

    public $array = array();

    public $icon = array('│', '├', '└');

    public $space = '&nbsp;';

    public $result = '';

    public $level = 0;

    public function __construct($inArray = array())
    {
        $this->array = $inArray;
        $this->result = '';
        return is_array($inArray);
    }

    /**
     * @param $inId
     * @return array|bool
     */
    public function getChild($inId)
    {
        $newArray = array();

        if (is_array($this->array)) {
            foreach ($this->array as $theId => $theArray) {
                if ($theArray['pid'] == $inId) {
                    $newArray[$theId] = $theArray;
                }
            }
        }

        return count($newArray) ? $newArray : false;
    }

    /**
     * @param $inId
     * @param $inString
     * @param int $selectId
     * @param string $add
     * @param string $inGroup
     * @return string
     */
    public function getTree($inId, $inString, $selectId = 0, $add = '', $inGroup = '')
    {
        $index = 1;

        $theChild = $this->getChild($inId);

        if (is_array($theChild)) {
            $total = count($theChild);

            foreach ($theChild as $k => $theItem) {

                $m = $n = '';

                if ($index == $total) {
                    $m .= $this->icon[2];
                } else {
                    $m .= $this->icon[1];
                    $n = $add ? $this->icon[0] : '';
                }

                $theSpacer = ($add ? $add . $m : '');

                extract($theItem);

                if (empty($theItem['selected'])) {
                    $theSelected = ($inId == $selectId ? 'selected' : '');
                }

                $newString = $inString;
                if ($thePid = 0 && $inGroup) {
                    $newString = $inGroup;
                }

                $this->result .= $newString;

                $theSpace = $this->space;

                $this->getTree($inId, $inString, $selectId, $add . $n . $theSpace, $inGroup);
                $index++;
            }
        }

        return $this->result;
    }

}