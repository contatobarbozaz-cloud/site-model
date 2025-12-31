
fetch('connect.php')
    .then(response => response.json())
    .then(data => {
        console.log('Data from database:', data);
        // You can now use the data in your frontend
    })
    .catch(error => {
        console.error('Error fetching data:', error);
    });