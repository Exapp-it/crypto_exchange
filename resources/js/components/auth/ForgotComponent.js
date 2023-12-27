import axios from "axios";

export default function ForgotComponent() {
    return {
        email: "",
        errors: {
            email: "",
        },
        message: {
            status: "",
            text: "",
        },
        showAlert: false,
        alertTimer: null,

        clearErrors() {
            this.errors = {
                email: "",
            }
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

        handleForgotError(error) {
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
                this.redirect(routes.home);
            }, 1000);
        },

        async forgotAction() {
            try {
                const response = await axios.post(routes.forgot, {
                    email: this.email,
                    _token: csrfToken,
                });

                this.handleSuccessResponse(response);
            } catch (error) {
                this.handleForgotError(error);
            }
        },
    };
}
