<?php

namespace Relaxed\Merge\ThreeWayMerge;

use Exception;

class ThreeWayMerge
{

    /**
     * Performs automatic merge if no conflict arises else throws exception.
     *
     * @param array $ancestor
     * @param array $local
     * @param array $remote
     *
     * @return array
     * @throws Exception
     */
    public function performMerge(array $ancestor, array $local, array $remote)
    {
        // Returning a new Array for now. Can return the modified ancestor as well.
        $merged = [];
        $conflict = false;
        foreach ($ancestor as $key => $value) {
            if (is_array($value)) {
                $merged[$key] = $this->performMerge(
                    $value,
                    $local[$key],
                    $remote[$key]
                );
            } else {
                // If ancestor's value is equal to remote's value,
                // Set the merged array's value to local value.

                // Else If ancestor's value is equal to local's value,
                // Set the merged array's value to remote value.

                // Else If local's value is equal to remote's value,
                // Set the merged array's value to any value as they both are same.

                // Else set conflict to TRUE as none of the above is True.
                if ($ancestor[$key] == $local[$key]) {
                    $merged[$key] = $remote[$key];
                } elseif ($ancestor[$key] == $remote[$key]) {
                    $merged[$key] = $local[$key];
                } elseif ($local[$key] == $remote[$key]) {
                    $merged[$key] = $local[$key];
                }
            }
        }
        // Throw Exception if there is a conflict.
        if ($conflict) {
            throw new Exception('A merge conflict has occured.');
        }
        return $merged;
    }
}
