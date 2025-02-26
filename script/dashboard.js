let students = ["Joshco", "Joshco", "Joshco", "Pogi", "Pogi", "Ana"];
let hours = [90, 30, 60, 120, 40, 80];

function getRandomColor() {
  return `hsl(${Math.random() * 360}, 70%, 60%)`;
}
let backgroundColors = students.map(() => getRandomColor());

const ctx = document.getElementById("bar_hours").getContext("2d");

if (window.myChart) {
  window.myChart.destroy();
}

window.myChart = new Chart(ctx, {
  type: "bar",
  data: {
    labels: students,
    datasets: [
      {
        label: "Rendered Hours",
        data: hours,
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
      },
      x: {
        title: { display: true, text: "Students" },
        ticks: { autoSkip: false, maxRotation: 0, minRotation: 0 },
      },
    },
  },
});
