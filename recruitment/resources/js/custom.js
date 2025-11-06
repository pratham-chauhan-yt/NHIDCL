// attendance chart 

  // Load the Google Charts library
  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(drawDonutChart);
  google.charts.setOnLoadCallback(drawColumnChart);

  // Function to draw the Donut Chart
  function drawDonutChart() {
    var data = google.visualization.arrayToDataTable([
      ['Task', 'Hours per Day'],
      ['Work',     7],
      ['Eat',      3]
    ]);

    var options = {
      pieHole: 0.6,
      width: '100%',
    };

    var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
    chart.draw(data, options);
  }

  // Function to draw the Column Chart
  function drawColumnChart() {
    var data = google.visualization.arrayToDataTable([
      ["Element", "Density", { role: "style" }],
      ["Deputation", 8.94, "#2541E1"],
      ["Contractual", 19.30, "#00DBFF"],
      ["Outsourced", 10.49, "#32B952"]
    ]);

    var view = new google.visualization.DataView(data);
    view.setColumns([0, 1,
                     { calc: "stringify",
                       sourceColumn: 1,
                       type: "string",
                       role: "annotation" },
                     2]);

    var options = {
      width: '100%'
    };

    var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
    chart.draw(view, options);
  }

// Edn ################# 

// Side menu submenu script
// Side menu submenu script
document.addEventListener("DOMContentLoaded", function () {
  // Get all menu links with the class 'menu-link'
  document.querySelectorAll('.menu-link').forEach(function (link) {
    link.addEventListener('click', function (e) {
      e.preventDefault(); // Prevent default anchor click behavior

      // Get the sidebar element
      const sidebar = document.querySelector('.sidebar');

      // Check if the sidebar has the 'open' class
      if (sidebar && sidebar.classList.contains('open')) {
        // Get the parent 'li' element
        const parentDropdown = this.parentElement;

        // Toggle 'show' class on the parent 'li' element to show/hide the dropdown
        parentDropdown.classList.toggle('show');

        // Close other dropdowns if needed (optional)
        document.querySelectorAll('.menu-item.dropdown').forEach(function (item) {
          if (item !== parentDropdown) {
            item.classList.remove('show');
          }
        });
      }
    });
  });
});

// Sidebar close button and open script 
// Get the sidebar, close button, and search button elements
let sidebar = document.querySelector(".sidebar");
let closeBtn = document.querySelector("#btn");
let searchBtn = document.querySelector(".bx-search");
let navList = document.querySelector(".nav-list");

// Event listener for the menu button to toggle the sidebar open/close
closeBtn.addEventListener("click", () => {
  sidebar.classList.toggle("open"); // Toggle the sidebar's open state
  navList.classList.toggle("scroll"); // Toggle scroll state
  menuBtnChange(); // Call function to change button icon
  closeAllDropdowns(); // Close all dropdowns when sidebar is closed
});

// Event listener for the search button to open the sidebar
searchBtn.addEventListener("click", () => {
  sidebar.classList.toggle("open");
  navList.classList.toggle("scroll");
  menuBtnChange(); // Call function to change button icon
  closeAllDropdowns(); // Close all dropdowns when sidebar is closed
});

// Function to change the menu button icon
function menuBtnChange() {
  if (sidebar.classList.contains("open")) {
    closeBtn.classList.replace("bx-menu", "bx-menu-alt-right"); // Change icon to indicate closing
  } else {
    closeBtn.classList.replace("bx-menu-alt-right", "bx-menu"); // Change icon to indicate opening
  }
}

// Function to close all dropdowns
function closeAllDropdowns() {
  // Remove 'show' class from all dropdown menu items
  document.querySelectorAll('.menu-item.dropdown').forEach(function (item) {
    item.classList.remove('show');
  });
}

// Edn ################### 

 
