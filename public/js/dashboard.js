// let menuicn = document.querySelector(".menuicn");
// let nav = document.querySelector(".navcontainer");

// menuicn.addEventListener("click", () => {
//     nav.classList.toggle("navclose");
// });

const inputBox = document.getElementById("input-box");
const taskContainer = document.getElementById("task-container");


    // let urgentno = document.querySelectorAll('.marked').length;
    // let urgentTasks = document.getElementById('urgentTasks');
    // urgentTasks.innerHTML = (urgentno);
    
     function addTask() {
        if (inputBox.value === '') {
            alert("Please add a task");
        } else {
            let li = document.createElement("li");
            li.innerHTML = inputBox.value;
    
            // Create delete button
            let span = document.createElement("span");
            span.innerHTML = "\u00d7 ";
            
            // Create "Mark Urgent" button
            let markUrgent = document.createElement("img");
            markUrgent.src = "flag-svgrepo-com.svg";
            markUrgent.classList.add("urgent");
            markUrgent.onclick = function () {
                li.classList.toggle("marked"); // Toggle urgency
               
                // Change the flag image based on urgency
                if (li.classList.contains("marked")) {
                    markUrgent.src = "urgentFlag.svg"; // New urgent flag image
                } else {
                    markUrgent.src = "flag-svgrepo-com.svg"; // Back to normal flag
                }
    
                saveData(); // Save state
                
            };
    
            // Append buttons to list item
            li.appendChild(markUrgent);
            li.appendChild(span);
            taskContainer.appendChild(li);
            
    
            saveData(); // Save task after adding it
        }
        inputBox.value = ''; // Clear input
    }
    
// Event Listener for Completing or Deleting a Task
taskContainer.addEventListener("click", function (e) {
    if (e.target.tagName === "LI") {
        e.target.classList.toggle("done");
        saveData();
    } else if (e.target.tagName === "SPAN") {
        e.target.parentElement.remove();
        saveData();
       
    }
}, false);


// Save tasks to localStorage
function saveData() {
    localStorage.setItem("data", taskContainer.innerHTML);
}

// Restore saved tasks on page load
function showTask() {
    taskContainer.innerHTML = localStorage.getItem("data") || "";

    // Reattach event listeners after loading from localStorage
    document.querySelectorAll(".urgent").forEach(button => {
        button.onclick = function () {
            this.parentElement.classList.toggle("marked");
            saveData();
          
        };
    });

    
}

showTask(); // Load tasks when the page opens

// Event Listener for Completing or Deleting a Task
taskContainer.addEventListener("click", function (e) {
    if (e.target.tagName === "LI") {
        e.target.classList.toggle("done");
        saveData();
    } else if (e.target.tagName === "SPAN") {
        e.target.parentElement.remove();
      
        saveData();
    }
}, false);

// Save tasks to localStorage
function saveData() {
    localStorage.setItem("data", taskContainer.innerHTML);
}

// Restore saved tasks on page load
function showTask() {
    taskContainer.innerHTML = localStorage.getItem("data") || "";

    // Reattach event listeners after loading from localStorage
    document.querySelectorAll(".urgent").forEach(button => {
        button.onclick = function () {
            this.parentElement.classList.toggle("marked");
            
            saveData();
        };
    });

    
}
showTask(); // Load tasks when the page opens

// Function to count and display the number of urgent tasks

// Progress Circle Animation
let percent = document.getElementById('percent');
let circle = document.querySelector('circle');
let counter = 0;

setInterval(() => {
    if (counter == 55) {
        clearInterval;
    } else {
        counter += 1;
        percent.innerHTML = `${counter}%`; // Use backticks
        circle.style.strokeDashoffset = 450 - (450 * (counter / 100));
    }
}, 30);

// Get today's date
const startDate = new Date(); 

// Select all <small> elements inside .description
const descriptionSmalls = document.querySelectorAll(".description small");

// Loop through each <small> and set the date dynamically
descriptionSmalls.forEach((small, index) => {
    let futureDate = new Date(startDate);
    futureDate.setDate(startDate.getDate() + index); // Add days based on container index

    // Format the date as "Monday, March 12"
    let options = { weekday: "long", month: "long", day: "numeric" };
    small.textContent = futureDate.toLocaleDateString("en-UK", options);
});

document.addEventListener("DOMContentLoaded", function () {
    fetch('/product-count') // Laravel route
        .then(response => response.json()) // Parse JSON response
        .then(data => {
            document.querySelector(".box1 .topic-heading").textContent = data.count; // Update the count
        })
        .catch(error => console.error("Error fetching product count:", error));
});
    

