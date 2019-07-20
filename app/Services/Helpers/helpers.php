<?php

/**
 * Get the selected option.
 *
 * @param  string $value1
 * @param  string $value2
 * @return string
 */
function getSelected($value1 , $value2)
{
    return $value1 == $value2 ? 'selected' : '';
}
