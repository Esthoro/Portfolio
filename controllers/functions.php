<?php

/**
 * Function to clean requests
 *
 * @param mixed $data
 * @param array|null $exclude
 *
 * @return array|string
 */
function cleanRequest($data)
{
    if (is_array($data)) {

        foreach ($data as $key => $value) {

                $data[$key] = cleanRequest($value);
        }

    } else {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
    }

    return $data;
}
