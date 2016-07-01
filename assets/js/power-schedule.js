
/*
getSavedSchedules : takes all saved power schedules from database , add that schedules to the right
panel body whose id is "mainDivAfterSave" 
*/
function getSavedSchedules() {
    var newDiv = document.createElement('div'); // schedules from database are to be variables
    newDiv.id = 'newDivCreated'; // not nessecary to make id
    newDiv.innerText = 'Schedule 1(created from power-schedule.js)'; // determine the text of the div
                                                        //  you can also use .innerHTML
    var hLine = document.createElement('hr'); // create a horizontal line
    document.getElementById('mainDivAfterSave').appendChild(hLine); // add a horizontal line
    document.getElementById('mainDivAfterSave').appendChild(newDiv); // add the newDiv to the right panel
}

getSavedSchedules(); //  call the function