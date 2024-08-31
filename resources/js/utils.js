// utils.js
export const Utils = {
    calculateTotalPrice(amount, bookingFeePercentage, gstPercentage) {
        const bookingFee = (amount * bookingFeePercentage) / 100;
        const gst = (amount * gstPercentage) / 100;
        return amount + bookingFee + gst;
    },

    updateSummary(totalPrice, itemPrice) {
        const formattedTotalPrice = totalPrice.toFixed(2);
        document.getElementById("total-amount").textContent = `Total Amount: ₹${formattedTotalPrice}`;
        document.getElementById("item-price").textContent = `${itemPrice.toFixed(2)}`;
        document.getElementById('totalValue_rj').value = `${formattedTotalPrice}`;
    },

    showError(message) {
        Swal.fire('Error', message, 'error');
    },

    showSuccess(message) {
        Swal.fire('Success', message, 'success');
    }
};
