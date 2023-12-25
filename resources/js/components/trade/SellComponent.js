import axios from "axios";

export default function SellComponent() {
    return {
        state: {
            quantity: "",
            from_currency: 'BTC',
            price: '',
            total_amount: '',
            to_currency: 'USD',
            fee: 0.04,
            fee_amount: 0,
            errors: {
                quantity: "",
                from_currency: "",
                price: "",
                to_currency: "",
            },
            message: {
                status: "",
                text: "",
            },
            showAlert: false,
            alertTimer: null,
        },

        clearErrors() {
            this.state.errors = {
                quantity: "",
                from_currency: "",
                price: "",
                to_currency: "",
            };
        },

        openAlert() {
            if (!this.state.showAlert) {
                this.state.showAlert = true;

                this.state.alertTimer = setTimeout(() => {
                    this.closeAlert();
                }, 5000);
            }
        },

        showError(message) {
            this.state.message.status = "error";
            this.state.message.text = message;
            this.openAlert();
        },

        clearAlertTimer() {
            clearTimeout(this.state.alertTimer);
        },

        closeAlert() {
            this.state.showAlert = false;
            this.clearAlertTimer();
        },

        redirect(url) {
            window.location.href = url;
        },

        handleSellError(error) {
            if (error.response && error.response.status === 422) {
                const validationErrors = error.response.data.error;
                if (validationErrors instanceof Object) {
                    this.processValidationErrors(validationErrors);
                } else {
                    this.showError(validationErrors);
                }
            } else {
                console.error('Ошибка при отправке запроса:', error);
            }
        },

        processValidationErrors(validationErrors) {
            this.clearErrors();
            Object.keys(validationErrors).forEach((field) => {
                if (field in this.state.errors) {
                    this.state.errors[field] = Array.isArray(validationErrors[field]) ? validationErrors[field][0] : "";
                } else {
                    this.showError(validationErrors[field]);
                }
            });
        },

        handleSuccessResponse(response) {
            this.state.message.status = response.data.status;
            this.state.message.text = response.data.message;
            this.openAlert();

            setTimeout(() => {
                this.closeAlert();
            }, 3000);
        },

        calculate() {
            this.state.quantity = this.state.quantity.slice(0, 8); 
            this.state.total_amount = (this.state.quantity * this.state.price).toString().slice(0, 8);
            this.state.fee_amount = (this.state.total_amount * this.state.fee).toString().slice(0, 8);
        },
        


        async sellAction() {
            try {
                const response = await axios.post(routes.trade.sell, {
                    quantity: this.state.quantity,
                    from_currency: this.state.from_currency,
                    price: this.state.price,
                    to_currency: this.state.to_currency,
                    _token: csrfToken,
                });

                this.handleSuccessResponse(response);
            } catch (error) {
                this.handleSellError(error);
            }
        },
    };
}
