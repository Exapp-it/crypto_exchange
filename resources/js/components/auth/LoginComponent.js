import axios from "axios";

export default function LoginComponent() {
    return {
        state: {
            login: "",
            password: "",
            errors: {
                login: "",
                password: "",
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
                login: "",
                email: "",
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

        handleLoginError(error) {
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
                this.redirect(routes.main);
            }, 1000);
        },

        async loginAction() {
            try {
                const response = await axios.post(routes.login, {
                    login: this.state.login,
                    email: this.state.email,
                    password: this.state.password,
                    password_confirmation: this.state.password_confirmation,
                    _token: csrfToken,
                });

                this.handleSuccessResponse(response);
            } catch (error) {
                this.handleLoginError(error);
            }
        },
    };
}
