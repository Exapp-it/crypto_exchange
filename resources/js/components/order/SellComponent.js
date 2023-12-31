import axios from "axios";

export default function SellComponent() {
    return {
        quantity: "",
        base_currency: 'BTC',
        price: '',
        total_amount: '',
        quote_currency: 'USD',
        fee: 0.03,
        fee_amount: 0,
        errors: {
            quantity: "",
            base_currency: "",
            price: "",
            quote_currency: "",
        },
        message: {
            status: "",
            text: "",
        },
        showAlert: false,
        alertTimer: null,

        clearErrors() {
            this.errors = {
                quantity: "",
                base_currency: "",
                price: "",
                quote_currency: "",
            };
        },

        openAlert() {
            if (!this.showAlert) {
                this.showAlert = true;

                this.alertTimer = setTimeout(() => {
                    this.closeAlert();
                }, 5000);
            }
        },

        showError(message) {
            this.message.status = "error";
            this.message.text = message;
            this.openAlert();
        },

        clearAlertTimer() {
            clearTimeout(this.alertTimer);
        },

        closeAlert() {
            this.showAlert = false;
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
                if (field in this.errors) {
                    this.errors[field] = Array.isArray(validationErrors[field]) ? validationErrors[field][0] : "";
                } else {
                    this.showError(validationErrors[field]);
                }
            });
        },

        handleSuccessResponse(response) {
            this.message.status = response.data.status;
            this.message.text = response.data.message;
            this.openAlert();

            setTimeout(() => {
                this.closeAlert();
            }, 3000);
        },

        calculate() {
            this.quantity = this.quantity.slice(0, 8);
            this.total_amount = (this.quantity * this.price).toString().slice(0, 8);
            this.fee_amount = (this.quantity * this.fee).toString().slice(0, 8);
        },



        async sellAction() {
            try {
                const response = await axios.post(routes.order.sell, {
                    quantity: this.quantity,
                    base_currency: this.base_currency,
                    price: this.price,
                    quote_currency: this.quote_currency,
                    _token: csrfToken,
                });

                this.handleSuccessResponse(response);
            } catch (error) {
                this.handleSellError(error);
            }
        },
    };
}
