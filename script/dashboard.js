// Consolidate duplicate student entries
function consolidateData(students, hours) {
  const consolidated = {};
  
  // Sum hours for duplicate students
  for (let i = 0; i < students.length; i++) {
    const student = students[i];
    if (!consolidated[student]) {
      consolidated[student] = 0;
    }
    consolidated[student] += hours[i];
  }
  
  // Convert back to arrays
  const uniqueStudents = Object.keys(consolidated);
  const totalHours = uniqueStudents.map(student => consolidated[student]);
  
  return { uniqueStudents, totalHours };
}

// Original data
let students = ["Joshco (Day 1)", "Joshco (Day 2)", "Joshco (Day 3)", "Pogi (AM)", "Pogi (PM)", "Ana"];
let hours = [90, 30, 60, 120, 40, 80];

// Consolidate the data
const { uniqueStudents, totalHours } = consolidateData(students, hours);

// Generate colors (one per unique student)
function getRandomColor() {
  return `hsl(${Math.random() * 360}, 70%, 60%)`;
}
let backgroundColors = uniqueStudents.map(() => getRandomColor());

// Function to create/update chart
function createChart() {
  const ctx = document.getElementById("bar_hours").getContext("2d");

  // Destroy previous chart if it exists
  if (window.myChart) {
    window.myChart.destroy();
  }

  // Create new chart
  window.myChart = new Chart(ctx, {
    type: "bar",
    data: {
      labels: uniqueStudents,
      datasets: [
        {
          label: "Rendered Hours",
          data: totalHours,
          backgroundColor: backgroundColors,
          borderColor: "#2c3e50",
          borderWidth: 2,
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text: "Hours"
          }
        },
        x: {
          title: { display: true, text: "Students" },
          ticks: { autoSkip: false, maxRotation: 45 }
        },
      },
      plugins: {
        legend: {
          display: true,
          position: 'top'
        },
        tooltip: {
          callbacks: {
            label: function(context) {
              return `${context.parsed.y} hours`;
            }
          }
        }
      }
    },
  });
}

// Initial chart creation
createChart();

// Add resize event listener with debounce to prevent too many redraws
let resizeTimer;
window.addEventListener('resize', function() {
  clearTimeout(resizeTimer);
  resizeTimer = setTimeout(function() {
    createChart();
  }, 250);
});

// Also handle orientation change for mobile devices
window.addEventListener('orientationchange', function() {
  setTimeout(createChart, 250);
});

// Make sure chart is properly sized when DOM is fully loaded
document.addEventListener('DOMContentLoaded', function() {
  createChart();
});