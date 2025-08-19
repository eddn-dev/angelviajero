import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {

    // --- Configuration ---
    // REPLACE WITH THE ACTUAL PHONE NUMBER (Format: CountryCode + Number, e.g., 521...)
    const WHATSAPP_PHONE = '5215651899438'; 
    const WHATSAPP_MESSAGE = 'Hola, podrías darme más informacion sobre la licencia permanente';

    // --- Functionality 1: Dynamic WhatsApp Links ---

    /**
     * Generates the WhatsApp API link with URL encoding.
     * @param {string} phone - The target phone number.
     * @param {string} message - The predefined message.
     * @returns {string} The complete, URL-encoded WhatsApp link.
     */
    const generateWhatsAppLink = (phone, message) => {
        // Ensure the message is properly encoded for the URL
        const encodedMessage = encodeURIComponent(message);
        return `https://api.whatsapp.com/send/?phone=${phone}&text=%C2%A1Hola!%20Me%20gustar%C3%ADa%20mas%20informacion%20sobre%20la%20licencia%20permanente.&type=phone_number&app_absent=0`;
    }

    /**
     * Updates all elements with the class 'js-whatsapp-link'.
     */
    const initializeWhatsAppLinks = () => {
        const links = document.querySelectorAll('.js-whatsapp-link');
        const whatsappUrl = generateWhatsAppLink(WHATSAPP_PHONE, WHATSAPP_MESSAGE);

        links.forEach(link => {
            if (link.tagName === 'A') {
                link.setAttribute('href', whatsappUrl);
                // Open in a new tab for better user experience and tracking
                link.setAttribute('target', '_blank');
                link.setAttribute('rel', 'noopener noreferrer');
            }
        });
    }

    // --- Functionality 2: Dynamic Footer Year ---

    /**
     * Updates the footer year element with the current year.
     */
    const updateFooterYear = () => {
        const yearElement = document.getElementById('year');
        if (yearElement) {
            yearElement.textContent = new Date().getFullYear();
        }
    }

    // Initialize functions
    initializeWhatsAppLinks();
    updateFooterYear();
});