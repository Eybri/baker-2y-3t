// // public/js/orderhistory.js
// $(document).ready(function() {
//     function loadOrders() {
//         $.ajax({
//             url: '/api/orders',
//             method: 'GET',
//             success: function(response) {
//                 renderOrders(response);
//             },
//             error: function(xhr) {
//                 console.error(xhr.responseText);
//             }
//         });
//     }

//     function renderOrders(orders) {
//         let orderHistoryContainer = $('.order-history');
//         orderHistoryContainer.empty();

//         if (orders.length === 0) {
//             orderHistoryContainer.append('<p class="text-center">No pending orders found.</p>');
//             return;
//         }

//         orders.forEach(order => {
//             let orderCard = `
//                 <div class="order-card">
//                     <div class="order-header">
//                         Order #${order.id}
//                     </div>
//                     <div class="order-details">
//                         <div class="row">
//                             <div class="col-md-6">
//                                 <p><strong>Recipient Name:</strong> ${order.recipient_name}</p>
//                                 <p><strong>Phone:</strong> ${order.phone}</p>
//                                 <p><strong>Address:</strong> ${order.address}</p>
//                                 <p><strong>Date Placed:</strong> ${new Date(order.created_at).toLocaleString()}</p>
//                             </div>
//                             <div class="col-md-6">
//                                 <p><strong>City:</strong> ${order.city}</p>
//                                 <p><strong>Postal Code:</strong> ${order.postal_code}</p>
//                                 <p><strong>Country:</strong> ${order.country}</p>
//                                 <p><strong>Total Price:</strong> $${parseFloat(order.total_price).toFixed(2)}</p>
//                                 <p class="order-status"><strong>Status:</strong> ${capitalizeFirstLetter(order.status)}</p>
//                             </div>
//                         </div>
//                         <p><strong>Products:</strong></p>
//                         <ul>
//                             ${order.items.map(item => `
//                                 <li>${item.product.name} (Quantity: ${item.quantity}) - $${parseFloat(item.price).toFixed(2)}</li>
//                             `).join('')}
//                         </ul>
//                         ${order.status === 'pending' ? `
//                             <form class="cancel-order-form" data-order-id="${order.id}">
//                                 <button type="submit" class="btn btn-danger">Request Cancellation</button>
//                             </form>
//                         ` : ''}
//                     </div>
//                 </div>
//             `;
//             orderHistoryContainer.append(orderCard);
//         });
//     }

//     function capitalizeFirstLetter(string) {
//         return string.charAt(0).toUpperCase() + string.slice(1);
//     }

//     $(document).on('submit', '.cancel-order-form', function(e) {
//         e.preventDefault();
//         let orderId = $(this).data('order-id');

//         $.ajax({
//             url: `/api/orders/${orderId}/cancel`,
//             method: 'POST',
//             success: function(response) {
//                 alert(response.success);
//                 loadOrders();
//             },
//             error: function(xhr) {
//                 alert(xhr.responseJSON.error);
//             }
//         });
//     });

//     loadOrders();
// });
