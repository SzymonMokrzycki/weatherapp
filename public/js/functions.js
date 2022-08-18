function options(){
    let city = document.getElementById('form1').value;
    /*let array = input.split(",");
    let city = array[0];
    let country = array[1];
    console.log(v);*/
    let option = "";
    if(city != ""){
        $.ajax({
            url: "http://localhost:8000/city/"+city,
            method: "GET",
            async: false,
            success: function (data){
                $('#place').empty();
                for(var i = 0; i<data.length; i++){
                    option += '<option value="'+data[i]+'">'+data[i]+'</option>';
                }
                $('#place').append(option);
            }
        });
    }
    if(city == ""){
        $('#place').empty();
    }
}

function fun(){
    //console.log("cos");
    let city = document.getElementById('form1').value;
    let country = document.getElementById('place').value;
    let weather = "", temp = "", humidity = "", wind = "", array = [];
    if(country == ""){
        country = "PL";
    }
    $.ajax({
        url: "http://localhost:8000/city/"+city+"/"+country,
        method: "GET",
        success: function (data){
           weather = data.weather;
           temp = data.temperature;
           humidity = data.humidity;
           wind = data.wind;
           country = data.country;
           description = data.description;
           document.getElementById('weather').innerHTML = description;
           document.getElementById('cityname').innerHTML = city+", "+country;
           document.getElementById('temp').innerHTML = temp+"°C";
           document.getElementById('humidity').innerHTML = humidity+"%";
           document.getElementById('wind').innerHTML = wind+" m/s";
           let lower = weather.toLowerCase();
           document.getElementById('icon').src = "images/"+lower+".png";
           $(function(){
            $('#bg').css("background-image", "url('images/"+lower+".jpg')").hide().fadeIn(2000);
           });
        }
    });
}

function selectRow(id){
    $("#"+id).addClass('opacity-100 bg-secondary selected').siblings().removeClass('opacity-100 bg-secondary selected');
    //console.log(selected);
}

function selectRow1(id, name, country){
    $("#"+id).addClass('opacity-100 bg-secondary selected').siblings().removeClass('opacity-100 bg-secondary selected');
    $("#addcity").on('click', function(e){
        addCity(name, country);
    });
    //console.log(selected);
}

function selectRow2(name, country){
    $("#titlechart").html(""+name+", "+country);
}

function displayWeather(name, country){
    let weather = "", temp = "", humidity = "", wind = "", array = [];
    $.ajax({
        url: "http://localhost:8000/city/"+name+"/"+country,
        method: "GET",
        success: function (data){
           weather = data.weather; 
           temp = data.temperature;
           humidity = data.humidity;
           wind = data.wind;
           country = data.country;
           description = data.description;
           document.getElementById('weather').innerHTML = description;
           document.getElementById('cityname').innerHTML = name+", "+country;
           document.getElementById('temp').innerHTML = temp+"°C";
           document.getElementById('humidity').innerHTML = humidity+"%";
           document.getElementById('wind').innerHTML = wind+" m/s";
           let lower = weather.toLowerCase();
           document.getElementById('icon').src = "images/"+lower+".png";
           $(function(){
            $('#bg').css("background-image", "url('images/"+lower+".jpg')").hide().fadeIn(2000);
           });
        }
    });
}

function deleteRow(id, name, country){
    $.ajax({
        url: "http://localhost:8000/deletecity/"+name+"/"+country,
        method: "GET",
        success: function (){
            $('#'+id).remove();
        }
    });
    
}

let arr = "", arr1 = "", i = 0;
function allCities(){
    $.ajax({
        url: "http://localhost:8000/allcities",
        method: "GET",
        success: function (data){
            $.each(data, function(i, array) {
               arr += "<tr class='bg-gradient opacity-75' id='"+i+"' onclick='selectRow("+i+"), displayWeather(\""+ array.name + "\",\""+ array.country + "\")'>"+
               "<td><i class='fas fa-city fa-lg'></i></td>"+
               "<td>"+array.name+"</td>"+
               "<td>"+array.country+"</td>"+
               "<td></td><td><button type='button' class='btn btn-dark' data-bs-toggle='modal' data-bs-target='#exampleModal' onclick='selectRow2(\""+ array.name + "\",\""+ array.country + "\")' title='Display humidity chart'><i class='fas fa-chart-line fa-xl'></i></button></td><td><button type='button' class='btn btn-dark' title='Delete' onclick='deleteRow("+i+", \""+ array.name + "\",\""+ array.country + "\")'><i class='fas fa-trash fa-xl'></i></button></td>";
            });
            $('#tab').append(arr);
        }
    });
}

function listCities(cont){
    $.ajax({
        url: "http://localhost:8000/list",
        method: "GET",
        success: function (data){
            for(var i = 0; i<data.length; i++){
                if(data[i].country === cont){
                    arr1 += "<tr class='bg-gradient opacity-75' name='listadd' id='"+i+"' onclick='selectRow1("+i+", \""+ data[i].name + "\",\""+ data[i].country + "\")'>"+
                    "<td><i class='fas fa-city fa-lg'></i></td>"+
                    "<td>"+data[i].name+"</td>"+
                    "<td>"+data[i].country+"</td></tr>";
                }
            }
            $('#listcity').append(arr1);
        }
    });    
}

function addCity(name, country){
    $.ajax({
        url: "http://localhost:8000/add/"+name+"/"+country,
        method: "GET",
        success: function (){
        }
    });
    window.location.reload(true);
}

function searchFunction() {
    var searchInput = document.getElementById("filter");
    var filter = searchInput.value.toUpperCase();
    var tableRow = document.getElementsByName("listadd");
    var tableCell, value;

    for (var i = 0; i < tableRow.length; i++) {
        tableCell = tableRow[i].getElementsByTagName("td")[1];
        if (tableCell) {
            value = tableCell.textContent || tableCell.innerText;

            if (value.toUpperCase().indexOf(filter) > -1) {
                tableRow[i].style.display = "";
            }
            else {
                tableRow[i].style.display = "none";
            }
        }
    }
}

function createChart(){
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

function set(){
    let country = document.getElementById('contry').value;
    listCities(country);
}