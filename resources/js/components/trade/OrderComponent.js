import axios from "axios";

export default function OrderComponent() {
    return {
        orders: {},

        fetchOrders: async function () {
            try {
                const response = await axios.post(routes.trade.buyOrders);
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
