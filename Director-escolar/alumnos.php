
<!DOCTYPE html>
<html lang="en">
<>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/nav-barra.css">
  <link rel="stylesheet" href="css/alumnos.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <title>Document</title>
</head>
<body>
  
    <!-- Header nav -->
    <?php include 'header-nav.php'; ?>

  <div class="containers">
    <h1>ALUMNOS</h1>  
  </div>

  <div class="studens-add-bar">
    <div class="left-student">
        <i class="fas fa-users"></i><h2>Alumno(s)</h2>
    </div>
  </div>

 <section>

 <div id="chart"></div>

    
  </section>

  <script>
    const data = [30, 50, 70, 40, 90];

    function createChart() {
        const chart = document.getElementById("chart");
        const labelsContainer = document.createElement("div");
        labelsContainer.classList.add("chart-labels");
        chart.appendChild(labelsContainer);

        data.forEach((value, index) => {
          const bar = document.createElement("div");
          bar.classList.add("bar");
          bar.style.height = `${value}px`;

          const label = document.createElement("span");
          label.textContent = value;

          chart.appendChild(bar);
          labelsContainer.appendChild(label);
      });
    }

    createChart();

  </script>
</body>
</html>