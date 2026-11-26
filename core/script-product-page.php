<?php

/**
 * Generates an array containing random indices of a given product category
 * 
 * @param array $categoryProducts
 * @param int $itemCount
 * @param int $excludedID
 * @return array
 */
function generateSimilarItemIDs(array $categoryProducts, int $itemCount, int $excludedID): array
{
    $chosenItemsIndices = [];
    $chosenItemsIDs = [];
    $categorySize = sizeof($categoryProducts);

    // var_dump($excludedID);

    // No similar items to show
    if ($categorySize === 1) {
        return $chosenItemsIDs;
    }

    // Check if only 2 items and pick either one to avoid while-loop crashing
    if ($categorySize === 2) {
        if ($excludedID === $categoryProducts[0]['id']) {
            array_push($chosenItemsIDs, $categoryProducts[1]['id']);
        } else {
            array_push($chosenItemsIDs, $categoryProducts[0]['id']);
        }
        return $chosenItemsIDs;
    }

    $count = $itemCount;

    // Check if itemCount is greater, match it to category size to avoid out of bounds
    if ($categorySize < $itemCount) {
        $count = $categorySize;
    }

    // Randomly pick specified count of items
    for ($i = 0; $i < $count; $i++) {
        $index = random_int(0, $categorySize - 1);

        // Repeat while index already exists or the product of index is the excluded ID  
        while (in_array($index, $chosenItemsIndices, true) || $categoryProducts[$index]['id'] === $excludedID) {
            $index = random_int(0, $categorySize - 1);
        }
        
        array_push($chosenItemsIndices, $index);
    }

    // Convert those indices into IDs
    foreach ($chosenItemsIndices as $index) {
        array_push($chosenItemsIDs, $categoryProducts[$index]['id']);
    }

    return $chosenItemsIDs;
}
