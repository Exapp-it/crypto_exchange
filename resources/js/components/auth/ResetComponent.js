import axios from "axios";

export default function ResetComponent() {
    return {
        state: {
            token: "",
            email: "",
            password: "",
            password_confirmation: "",
            errors: {
                password: "",
                password_confirmation: "",
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
                password: "",
                password_confirmation: "",
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

        handleResetError(error) {
            if (error.response && error.response.status === 422) {
                const validationErrors = error.response.data.error;
                console.log(validationErrors)
                if (validationErrors instanceof Object) {
                    console.log(validationErrors);
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
                this.redirect(routes.home);
            }, 1000);
        },

        async resetAction() {
            try {
                const response = await axios.post(routes.reset, {
                    token: this.state.token,
                    email: this.state.email,
                    password: this.state.password,
                    password_confirmation: this.state.password_confirmation,
                    _token: csrfToken,
                });

                this.handleSuccessResponse(response);
            } catch (error) {
                this.handleResetError(error);
            }
        },
    };
}
