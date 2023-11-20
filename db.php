// PHP script for server-side processing (db.php)
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "BankDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

// JavaScript code
<script>
    let balance = 0;
    // ... other variables

    function deposit() {
        const depositAmount = parseFloat(document.getElementById("depositAmount").value);
        if (!isNaN(depositAmount) && depositAmount > 0) {
            const afterTaxAmount = applyTax(depositAmount);

            // Use Ajax to send a request to the server-side script (PHP) for deposit
            // Update the URL in the following line based on your server configuration
            fetch('http://localhost/path/to/deposit.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    amount: afterTaxAmount,
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    balance = data.newBalance;
                    updateBalance();
                    showNotification(`Deposited Kw${afterTaxAmount.toFixed(2)} after tax`);
                } else {
                    showNotification(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    }

    function withdraw() {
        const withdrawAmount = parseFloat(document.getElementById("withdrawAmount").value);
        if (!isNaN(withdrawAmount) && withdrawAmount > 0 && withdrawAmount <= balance) {
            // Use Ajax to send a request to the server-side script (PHP) for withdrawal
            // Update the URL in the following line based on your server configuration
            fetch('http://localhost/path/to/withdraw.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    amount: withdrawAmount,
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    balance = data.newBalance;
                    updateBalance();
                    showNotification(`Withdrawn Kw${withdrawAmount.toFixed(2)}`);
                } else {
                    showNotification(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        } else {
            showNotification("Withdrawal failed. Insufficient funds or invalid amount.");
        }
    }
    
    // ... other functions
</script>
