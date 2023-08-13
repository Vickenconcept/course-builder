
//   const labels = ["January", "February", "March", "April", "May", "June"];
//   const data = {
//     labels: labels,
//     datasets: [
//       {
//         label: "My First dataset",
//         backgroundColor: "hsl(252, 82.9%, 67.8%)",
//         borderColor: "hsl(252, 82.9%, 67.8%)",
//         data: [0, 10, 5, 2, 20, 30, 45],
//       },
//     ],
//   };

//   const configLineChart = {
//     type: "line",
//     data,
//     options: {},
//   };

//   var chartLine = new Chart("chartLine",
//     configLineChart
//   );

//   var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
// var yValues = [55, 49, 44, 24, 15];
// var barColors = [
//   "#b91d47",
//   "#00aba9",
//   "#2b5797",
//   "#e8c3b9",
//   "#1e7145"
// ];



// new Chart("myChart", {
//   type: "doughnut",
//   data: {
//     labels: xValues,
//     datasets: [{
//       backgroundColor: barColors,
//       data: yValues
//     }]
//   },
//   options: {
//     title: {
//       display: true,
//       text: "World Wide Wine Production 2018"
//     }
//   }
// });




// const dataDoughnut = {
//     labels: ["JavaScript", "Python", "Ruby"],
//     datasets: [
//       {
//         label: "My First Dataset",
//         data: [300, 50, 100],
//         backgroundColor: [
//           "rgb(133, 105, 241)",
//           "rgb(164, 101, 241)",
//           "rgb(101, 143, 241)",
//         ],
//         hoverOffset: 4,
//       },
//     ],
//   };

//   const configDoughnut = {
//     type: "doughnut",
//     data: dataDoughnut,
//     options: {},
//   };

//   var chartBar = new Chart(
//     document.getElementById("myChart"),
//     configDoughnut
//   );





// const ctx = document.getElementById('barChart');

// new Chart(ctx, {
//   type: 'bar',
//   data: {
//     labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
//     datasets: [{
//       label: '# of Votes',
//       data: [12, 19, 3, 5, 2, 3],
//       borderWidth: 1
//     }]
//   },
//   options: {
//     scales: {
//       y: {
//         beginAtZero: true
//       }
//     }
//   }
// });



