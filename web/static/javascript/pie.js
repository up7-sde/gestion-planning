var donutOptions = {
    cutoutPercentage: 85, 
    legend: {position:'bottom', 
         labels:{pointStyle:'circle',
         usePointStyle:true}
    }
  };
  
  var chDonutData1 = {
      labels: ['Bootstrap', 'Popper', 'Other'],
      datasets: [
        {
          backgroundColor: ['red', 'blue', 'green'],
          borderWidth: 0,
          data: [74, 11, 40]
        }
      ]
  };
  
  var chDonut1 = document.getElementById("chDonut1");
  if (chDonut1) {
    console.log('test');
    new Chart(chDonut1, {
        type: 'pie',
        data: chDonutData1,
        options: donutOptions
    });
  }