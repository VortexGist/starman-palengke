<?php

/**
 * Generates an array containing random indices of a given product category
 * 
 * @param array $categoryProducts
 * @param int $itemCount
 * @param int $excludedIndex
 * @return array
 */
function generateSimilarItemIndices(array $categoryProducts, int $itemCount, int $excludedIndex): array
{
    $chosenItemsIndices = [];
    $categorySize = sizeof($categoryProducts);

    // var_dump($excludedIndex);

    // No similar items to show
    if ($categorySize === 1) {
        return $chosenItemsIndices;
    }

    // Check if only 2 items and pick either one to avoid while-loop crashing
    if ($categorySize === 2) {
        if ($excludedIndex === 0) {
            array_push($chosenItemsIndices, 1);
        } else {
            array_push($chosenItemsIndices, 0);
        }
        return $chosenItemsIndices;
    }

    $count = $itemCount;

    // Check if itemCount is greater, match it to category size to avoid out of bounds
    if ($categorySize < $itemCount) {
        $count = $categorySize;
    }

    // Randomly pick specified count of items
    for ($i = 0; $i < $count; $i++) {
        $index = random_int(0, $categorySize - 1);
        while (in_array($index, $chosenItemsIndices, true) || $index === $excludedIndex) {
            $index = random_int(0, $categorySize - 1);
        }
        array_push($chosenItemsIndices, $index);
    }

    return $chosenItemsIndices;
}
