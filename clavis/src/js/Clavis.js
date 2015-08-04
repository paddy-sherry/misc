//When DOM loaded we attach click event to button
$(document).ready(function() {

    //after button is clicked we download the data
    $('#good-generate').click(function(){
        
        $('html, body').animate({
            scrollTop: $("#good-results").offset().top
        }, 2000);

        //start ajax request
        $.ajax({
            url: "https://athena-7.herokuapp.com/ancients.json",
            //force to handle it as text
            dataType: "text",
            success: processData
        });
    });

    $('#convert-to-upper').click(function(){
        convertToUpper();
    });

    $('#search').click(function(){
        var searchString = $('#search-field').val();
        console.log(searchString);
         //start ajax request
        $.ajax({
            url: "https://athena-7.herokuapp.com/ancients.json?search=" + searchString,
            //force to handle it as text
            dataType: "text",
            success : displaySearchResults,
            error : function() {
                alert('no data');
            },            
        });
    });

    $('#display-error').click(function(){

         //start ajax request
        $.ajax({
            url: "https://athena-7.herokuapp.com/ancients.json?error=true",
            //force to handle it as text
            dataType: "text",
            success : function() {
                alert('success')
            },
            error : displayError             
        });
    });
});

/*
 * function processData
 * This function is called after a successful ajax request and process the data into usable json
 * @param - data - the data pulled back from the ajax request 
 */
function processData(data) {
    //data downloaded so we call parseJSON function 
    //and pass downloaded data
    var json = $.parseJSON(data);

    //store the results in localstorage so we can use later
    localStorage.setItem('storedJson', JSON.stringify(json));
    renderList(json);
}

/*
 * function renderList
 * This function renders the html lists on the page.
 * @param - json - the json array
*/
function renderList(json) {
    
    //empty any existing content and render the santa's list
    $("#good-results").empty();
    $.each(json, function(key, value) {
        $("#good-results").append("<ul><li class=\"list-title\">Name: " + value.name + "</li><li class=\"list-title\">Superpower: " + value.superpower + "</li><li class=\"list-title\">End Of An Era" + value.end_of_an_era + "</li></ul>");
    });

    return;
}

function convertToUpper() {

    //fetch the json from localstorage
    var storedJson = JSON.parse(localStorage.getItem('storedJson'));

    $("#good-results").empty();
    $.each(storedJson, function(key, value) {

        var name = "<li class=\"list-title\">Name: " + value.name.toUpperCase() + "</li>";
        var superpower = "<li class=\"list-title\">Superpower: " + value.superpower.toUpperCase() + "</li>"; 
        var endOfAnEra = "<li class=\"list-title\">Superpower: " + value.end_of_an_era.toUpperCase() + "</li>"; 

        $("#good-results").append("<ul>" + name + superpower + endOfAnEra + "</ul>");
    });

    $('html, body').animate({
        scrollTop: $("#good-results").offset().top
    }, 2000);
}

function displayError(data) {
    var json = $.parseJSON(data.responseText);
    $.each(json, function(key, value) {
        alert(value);
    });
}

function displaySearchResults(data) {
    console.log(data);
}