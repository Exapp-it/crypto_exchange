export default function Modal() {
    return {
        isLoginModalOpen: false,
        openLoginModal() {
            this.isLoginModalOpen = true;
        },
        closeLoginModal() {
            this.isLoginModalOpen = false;
        },
        isRegisterModalOpen: false,
        openRegisterModal() {
            this.isRegisterModalOpen = true;
        },
        closeRegisterModal() {
            this.isRegisterModalOpen = false;
        },
        isForgotModalOpen: false,
        openForgotModal() {
            this.closeRegisterModal();
            this.closeLoginModal();
            this.isForgotModalOpen = true;
        },
        closeForgotModal() {
            this.isForgotModalOpen = false;
        },

    };

}
