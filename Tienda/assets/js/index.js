  // Llama a la función productosMinimos y a la función topProductos para generar el gráfico correspondiente
  productosMinimos()
  topProductos()

  // Función para generar el gráfico de productos mínimos
  function productosMinimos() {
    // URL para obtener los productos mínimos
    const url = base_url + "admin/productosMinimos";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    // Manejador de eventos para procesar la respuesta de la solicitud
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        // Convierte la respuesta en formato JSON a un objeto JavaScript
        const res = JSON.parse(this.responseText);
        // Crea dos arrays vacíos para almacenar los nombres y cantidades de los productos mínimos
        let nombre = [];
        let cantidad = [];
        // Recorre el objeto de respuesta y extrae los nombres y cantidades de los productos mínimos
        for (let index = 0; index < res.length; index++) {
          nombre.push(res[index]['nombre']);
          cantidad.push(res[index]['cantidad']);
        }

        // Obtiene el contexto del gráfico en el elemento canvas con el id "chart2"
        var ctx = document.getElementById("chart2").getContext('2d');

        var myChart = new Chart(ctx, {
          type: 'doughnut',
          data: {
            labels: nombre,
            datasets: [{
              backgroundColor: [
                '#008cff',
                '#ffd200',
                '#15ca20'
              ],
              hoverBackgroundColor: [
                '#008cff',
                '#ffd200',
                '#15ca20'
              ],
              data: cantidad,
              borderWidth: [1, 1, 1]
            }]
          },
          options: {
            maintainAspectRatio: false,
            cutoutPercentage: 75,
            legend: {
              position: 'bottom',
              display: true,
              labels: {
                boxWidth: 20
              }
            },
            tooltips: {
              displayColors: false,
            }
          }
        });
      }
    }
  }

  // Función para generar el gráfico de productos mas vendidos
  function topProductos() {
    // URL para obtener los productos mas vendidos
    const url = base_url + "admin/topProductos";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    // Manejador de eventos para procesar la respuesta de la solicitud
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        // Convierte la respuesta en formato JSON a un objeto JavaScript
        const res = JSON.parse(this.responseText);
        // Crea dos arrays vacíos para almacenar los nombres y cantidades de los productos mas vendidos
        let nombre = [];
        let cantidad = [];
        // Recorre el objeto de respuesta y extrae los nombres y cantidades de los productos mas vendidos
        for (let index = 0; index < res.length; index++) {
          nombre.push(res[index]['producto']);
          cantidad.push(res[index]['total']);
        }

        // Obtiene el contexto del gráfico en el elemento canvas con el id "chart3"
        var ctx = document.getElementById("chart3").getContext('2d');

        var myChart = new Chart(ctx, {
          type: 'doughnut',
          data: {
            labels: nombre,
            datasets: [{
              backgroundColor: [
                '#008cff',
                '#ffd200',
                '#15ca20'
              ],
              hoverBackgroundColor: [
                '#008cff',
                '#ffd200',
                '#15ca20'
              ],
              data: cantidad,
              borderWidth: [1, 1, 1]
            }]
          },
          options: {
            maintainAspectRatio: false,
            cutoutPercentage: 75,
            legend: {
              position: 'bottom',
              display: true,
              labels: {
                boxWidth: 20
              }
            },
            tooltips: {
              displayColors: false,
            }
          }
        });
      }
    }
  }

