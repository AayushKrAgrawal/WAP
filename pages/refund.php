<?php
session_start();
include('../includes/db_connect.php');
include('../includes/header.php');

// Use PDO to fetch all products from the database

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return & Refund Policy - Hamro Pratibha</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif; /* Use a readable font */
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 960px; /* Adjust for your preferred width */
            margin: 0 auto;
            padding: 2rem;
        }

        h1, h2 {
            color: #555; /* Slightly muted heading color */
        }

        a {
            color: #007bff; /* Standard link color */
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body class="bg-gray-100">

    <div class="container">
        <h1 class="text-3xl font-semibold mb-4">Return & Refund Policy</h1>

        <p>Thank you for shopping at Hamro Pratibha. We take pride in the quality and craftsmanship of our products. This policy outlines our guidelines for returns and refunds.</p>

        <h2 class="text-2xl font-semibold mt-6 mb-2">Returns</h2>

        <h3 class="text-xl font-semibold mt-4 mb-2">Eligibility</h3>
        <ul>
            <li>To be eligible for a return, your item must be unused, and in the same condition that you received it.</li>
            <li>It must also be in the original packaging, with all tags and labels attached.</li>
            <li>Certain items are exempt from being returned, such as:
                <ul>
                    <li>Customized or personalized gift boxes.</li>
                    <li>Items marked as non-returnable.</li>
                    <li>Gift cards.</li>
            </ul>
        </ul>

        <h3 class="text-xl font-semibold mt-4 mb-2">Timeframe</h3>
        <p>You have 14 days from the date of delivery to initiate a return.</p>

        <h3 class="text-xl font-semibold mt-4 mb-2">How to Initiate a Return</h3>
        <ol>
            <li>Contact our customer support team at <a href="mailto:support@hamropratibha.com">support@hamropratibha.com</a> to request a return authorization. Please provide your order number and reason for the return.</li>
            <li>Once your return is authorized, we will provide you with instructions on how to return the item.</li>
            <li>Carefully package the item in its original packaging, including all accessories and documentation.</li>
            <li>Ship the item to the address provided in the return instructions. You are responsible for the return shipping costs.</li>
        </ol>

        <h2 class="text-2xl font-semibold mt-6 mb-2">Refunds</h2>

        <h3 class="text-xl font-semibold mt-4 mb-2">Processing</h3>
        <p>Once your return is received and inspected, we will send you an email to notify you that we have received your returned item. We will also notify you of the approval or rejection of your refund.</p>

        <h3 class="text-xl font-semibold mt-4 mb-2">Approval</h3>
        <p>If your return is approved, a refund will be processed, and a credit will automatically be applied to your original method of payment within 7-10 business days.</p>

        <h3 class="text-xl font-semibold mt-4 mb-2">Rejection</h3>
        <p>If your return is rejected, we will contact you to explain the reason. The item will be returned to you at your expense.</p>

        <h2 class="text-2xl font-semibold mt-6 mb-2">Exchanges</h2>
        <p>We only replace items if they are defective or damaged. If you need to exchange an item for the same item, contact us at <a href="mailto:support@hamropratibha.com">support@hamropratibha.com</a>.</p>

        <h2 class="text-2xl font-semibold mt-6 mb-2">Shipping</h2>
        <p>You will be responsible for paying for your own shipping costs for returning your item. Shipping costs are non-refundable. If you receive a refund, the cost of return shipping will be deducted from your refund.</p>

        <h2 class="text-2xl font-semibold mt-6 mb-2">Damaged or Defective Items</h2>
        <p>If you receive a damaged or defective item, please contact us within 7 days of delivery with photos of the damage. We will work with you to resolve the issue, which may include a replacement, refund, or store credit.</p>

        <h2 class="text-2xl font-semibold mt-6 mb-2">Late or Missing Refunds</h2>
        <p>If you haven’t received a refund yet, first check your bank account again. Then contact your credit card company, it may take some time before your refund is officially posted. Next, contact your bank. There is often some processing time before a refund is posted. If you’ve done all of this and you still have not received your refund yet, please contact us at <a href="mailto:support@hamropratibha.com">support@hamropratibha.com</a>.</p>

        <h2 class="text-2xl font-semibold mt-6 mb-2">Contact Us</h2>
        <p>If you have any questions about our Return & Refund Policy, please contact us at:
            <br>Email: <a href="mailto:support@hamropratibha.com">support@hamropratibha.com</a>
            <br>Phone: 9876543210
        </p>

        <p class="mt-8 text-sm text-gray-500">
            © 2025 Hamro Pratibha. All rights reserved.
        </p>
    </div>

</body>
</html>
