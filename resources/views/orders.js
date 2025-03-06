// Fetch and display the order history when the page loads
document.addEventListener("DOMContentLoaded", function () {
  // Replace with actual user ID or get it from session
  const userId = 123;

  // Fetch order history data from the server
  fetch(`/api/orders/history?user_id=${userId}`)
    .then((response) => response.json())
    .then((data) => {
      const ordersList = document.getElementById("orders-list");
      data.forEach((order) => {
        const orderRow = document.createElement("tr");
        orderRow.innerHTML = `
                    <td>${order.order_id}</td>
                    <td>${order.order_date}</td>
                    <td>$${order.total_amount}</td>
                    <td>${order.status}</td>
                    <td>
                        <button onclick="viewDetails(${order.order_id})">View Details</button>
                        <div>
                            <button onclick="returnParcel(${order.order_id})">Return Parcel</button>
                            <button onclick="trackParcel(${order.order_id})">Track Parcel</button>
                        </div>
                    </td>
                `;
        ordersList.appendChild(orderRow);
      });
    })
    .catch((err) => console.error("Error fetching order history:", err));
});

// Function to view order details in a modal
function viewDetails(orderId) {
  // Fetch order details from the server by order ID
  fetch(`/api/orders/${orderId}`)
    .then((response) => response.json())
    .then((order) => {
      const modal = document.getElementById("order-detail-modal");
      const orderDetailDiv = document.getElementById("order-detail");

      // Show order details inside the modal
      orderDetailDiv.innerHTML = `
                <h4>Order ID: ${order.order_id}</h4>
                <p>Status: ${order.status}</p>
                <p>Shipping Address: ${order.shipping_address}</p>
                <h5>Items</h5>
                <ul>
                    ${order.items
                      .map(
                        (item) => `
                        <li>${item.name} - ${item.quantity} x $${item.price}</li>
                    `
                      )
                      .join("")}
                </ul>
            `;
      modal.style.display = "block";
    })
    .catch((err) => console.error("Error fetching order details:", err));
}

// Function to return parcel (for demonstration purposes)
function returnParcel(orderId) {
  // Placeholder logic for returning a parcel
  alert(`Request to return parcel for Order ID: ${orderId}`);
  // You can implement actual logic for returning a parcel, such as making an API request
}

// Function to track parcel (for demonstration purposes)
function trackParcel(orderId) {
  // Placeholder logic for tracking a parcel
  alert(`Tracking parcel for Order ID: ${orderId}`);
  // Implement tracking logic, e.g., open tracking page or request status from API
}

// Close modal when the user clicks the close button
document.getElementById("close-modal").onclick = function () {
  document.getElementById("order-detail-modal").style.display = "none";
};
