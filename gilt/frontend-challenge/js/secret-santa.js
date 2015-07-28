//When DOM loaded we attach click event to button
$(document).ready(function() {

    //after button is clicked we download the data
    $('.button').click(function(){
        //start ajax request
        $.ajax({
            url: "users.json",
            //force to handle it as text
            dataType: "text",
            success: processData
        });
    });
});

/*
* function processData
* This function is called after a successful ajax request and process the data into usable json
* @param - data - the data pulled back from the json file 
*/
function processData(data) {
    //data downloaded so we call parseJSON function 
    //and pass downloaded data
    var json = $.parseJSON(data);

    createDuplicate(json.users);   
}

/*
* function createDuplicate
* This function creates a duplicate of the json so it can be compared to the shuffled array to check for duplicates.
* @param - users - the filtered array of users
*/
function createDuplicate(users) {
    var original = users.slice();
    var shuffled = shuffle(users);
 
    checkForConflicts(original, shuffled);
}

/*
* function shuffle
* This function shuffles the input array into a different order than the version that it received
* @param - array - the unshuffled array
* @return - array - the shuffled array of users
*/
function shuffle(array) {
    var currentIndex = array.length, temporaryValue, randomIndex ;

    // While there remain elements to shuffle...
    while (0 !== currentIndex) {

        // Pick a remaining element...
        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex -= 1;

        // And swap it with the current element.
        temporaryValue = array[currentIndex];
        array[currentIndex] = array[randomIndex];
        array[randomIndex] = temporaryValue;
    }

    return array;
}

/*
* function shucheckForConflictsffle
* This function compares each key of both arrays to see if there are conflicts.
* If yes then go back to createDuplicate and shuffle them again
* @param - original - the original unshuffled array
* @param - shuffled - the shuffled array
*/
function checkForConflicts(original, shuffled) {
    if (original.length !== shuffled.length) {
        return false;
    }

    length = original.length;
    for (var i = 0; i < length; i++) {  
        if (original[i].guid === shuffled[i].guid) {
            createDuplicate(original);
        }
    }
    
    renderLists(original, shuffled);  
}


/*
* function renderLists
* This function renders the html lists on the page.
* @param - original - the original unshuffled array
* @param - shuffled - the shuffled array
*/
function renderLists(original, shuffled) {

    var santaList = new Array();
    var personList = new Array();
    
    //empty any existing content and render the santa's list
    $("#santa").empty();
    $.each(original, function(key, user) {
        var fullName = user.name.first + ' ' + user.name.last;
        $("#santa").append("<li>" + fullName + "</li>");
    });

    //empty any existing content and render the persons(present receivers) list
    $("#person").empty();
    $.each(shuffled, function(key, user) {             
        var fullName = user.name.first + ' ' + user.name.last;
        $("#person").append("<li>" + fullName + "</li>");  
    });

    return;
}