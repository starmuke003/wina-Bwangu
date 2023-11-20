<?php
$balance = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle deposit request
    if (isset($_POST['depositAmount'])) {
        $depositAmount = floatval($_POST['depositAmount']);
        if (is_numeric($depositAmount) && $depositAmount > 0) {
            $balance += $depositAmount;
            updateBalance();
            showNotification("Deposited Kw" . number_format($depositAmount, 2));
        }
    }

    // Handle withdrawal request
    if (isset($_POST['withdrawAmount'])) {
        $withdrawAmount = floatval($_POST['withdrawAmount']);
        if (is_numeric($withdrawAmount) && $withdrawAmount > 0 && $withdrawAmount <= $balance) {
            $balance -= $withdrawAmount;
            updateBalance();
            showNotification("Withdrawn Kw" . number_format($withdrawAmount, 2));
        } else {
            showNotification("Withdrawal failed. Insufficient funds or invalid amount.");
        }
    }
}

function updateBalance() {
    global $balance;
    echo json_encode(['balance' => number_format($balance, 2)]);
    exit; // Terminate the script after sending the response
}

function showNotification($message) {
    echo json_encode(['message' => $message]);
    exit; // Terminate the script after sending the response
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple Bank App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #FF0000, #b60202);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 40px;
            text-align: center;
        }

        h1 {
            color:#FF0000;;
        }

        h2 {
            margin-bottom: 10px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #FF0000; /* Red background */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #CC0000; /* Darker red on hover */
        }

        p {
            font-size: 18px;
            margin: 0;
            color: #333;
        }

        #notifications {
            margin-top: 15px;
        }
        </style>
</head>
<body>
    <div class="container">
        <h1>AIRTEL</h1>

        <div id="bank">
            <form method="post">
                <label for="depositAmount">Deposit Amount (Kwacha):</label>
                <input type="number" id="depositAmount" name="depositAmount">
                <button type="submit">Deposit</button>
            </form>

            <br>

            <form method="post">
                <label for="withdrawAmount">Withdraw Amount (Kwacha):</label>
                <input type="number" id="withdrawAmount" name="withdrawAmount">
                <button type="submit">Withdraw</button>
            </form>

            <br>
            <label for="transferAmount">Transfer Amount (Kwacha):</label>
            <input type="number" id="transferAmount">
            <button onclick="transfer()">Transfer</button>
                <br>

            <p>Balance: Kw<span id="balance">0.00</span></p>
            <div id="notifications"></div>

            <!-- Button to go to WayToHome.php -->
            <a href="WayToHome.php">
                <button style="background-color: #FF0000;">Go to WayToHome</button>
            </a>
        </div>
    </div>

    <script>
        // Your JavaScript code for client-side interactions remains the same.
        // You can use AJAX to communicate with the PHP server.
        function updateBalance() {
            fetch('updateBalance.php') // Change 'updateBalance.php' to your PHP script URL
                .then(response => response.json())
                .then(data => {
                    // Update the balance on the client side
                    document.getElementById("balance").textContent = data.balance;
                })
                .catch(error => console.error('Error updating balance:', error));
        }

        function showNotification(message) {
            fetch('showNotification.php', { // Change 'showNotification.php' to your PHP script URL
                method: 'POST',
                body: JSON.stringify({ message: message }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Handle the response (e.g., display a notification)
                console.log(data.message);
            })
            .catch(error => console.error('Error showing notification:', error));
        }

        function transfer() {
    // Get the transfer amount and recipient's account from the input fields
    const transferAmount = parseFloat(document.getElementById("transferAmount").value);
    const recipientAccount = document.getElementById("recipientAccount").value; // You'll need an input field for recipient account

    // Check if the transfer amount is valid and greater than 0
    if (!isNaN(transferAmount) && transferAmount > 0) {
        // Assuming you have some way to validate the recipient's account
        if (recipientAccount) {
            // Here, you would typically make an AJAX request to your server
            // to perform the actual transfer operation, deducting the amount
            // from the sender's balance and adding it to the recipient's balance.
            
            // For this example, we'll just show a success message.
            showNotification(`Transferred Kw${transferAmount.toFixed(2)} to ${recipientAccount}`);
            
            // Optionally, you can update the sender's and recipient's balances
            // by calling the updateBalance() function.
            updateBalance();
        } else {
            showNotification("Transfer canceled. Please enter a valid recipient account.");
        }
    } else {
        showNotification("Transfer failed. Invalid amount.");
    }
}

    </script>
</body>
</html>
