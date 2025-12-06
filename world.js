window.addEventListener("DOMContentLoaded", initialize);

function initialize()
{
    document.getElementById("lookup").addEventListener("click", lookup);
    document.getElementById("lookup-cities").addEventListener("click", lookupCities);
}

function lookup()
{
    let country = document.getElementById("country").value;

    fetch("world.php?country=" + country)
    .then(response => response.text())
    .then(data => {
        document.getElementById("result").innerHTML = data;
    });
}

function lookupCities()
{
    let country = document.getElementById("country").value;

    fetch(`world.php?country=${country}&lookup=cities`)
    .then(response => response.text())
    .then(data => {
        document.getElementById("result").innerHTML = data;
    });
}