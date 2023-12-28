import axios from "axios";

export default function OrderListComponent() {
    return {
        orders: {},

        fetchOrders: async function () {
            try {
                const response = await axios.post(routes.order.listByUser);
                this.orders = response.data;
            } catch (error) {
                console.log(error);
            }
        },

        handleUpdateOrder: function () {
            this.fetchOrders()
        },

        init: function () {
            // setInterval(() => {
                this.fetchOrders()
            // }, 1000)
            
        }
    };
}
