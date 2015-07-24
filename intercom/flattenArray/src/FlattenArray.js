//the array on integers to be flattened
var numbers = [[1,2],[3,4],[5,6,7,8,9,10],[11],[12,13,14]];

//setting up the var that will hold the flattened arrays.
var merged = [];


/**
* function flattenArrays 
* This function takes the arrays as a parameter and flattens them using the js apply function.
* @param - numbers - the array of arbitrary arrays.
* @return - merged - the flatten array of integers
*/
function flattenArrays(numbers) {
 
    merged = merged.concat.apply(merged, numbers);
    return merged;
}

/**
* function showFlattenedArray 
* This function is called from the html page. It calls flattenArrays.
*
* @return - flattenedArray - the flattened array that is alerted in a popup
*/
function showFlattenedArray()  {
    var flattenedArray = flattenArrays(numbers);
    return alert(flattenedArray);
}
