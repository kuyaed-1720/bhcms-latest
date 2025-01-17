import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        forms,
        typography,
        function ({ addUtilities }) {
            addUtilities({
                ".no-arrows": {
                    // Chrome, Safari, Edge
                    "&::-webkit-outer-spin-button": {
                        appearance: "none",
                        margin: 0,
                    },
                    "&::-webkit-inner-spin-button": {
                        appearance: "none",
                        margin: 0,
                    },
                    // Firefox
                    '&[type="number"]': { "-moz-appearance": "textfield" },
                },
            });
        },
    ],
};
