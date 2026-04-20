/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    content: ["./resources/**/*.blade.php", "./resources/**/*.js"],
    theme: {
        extend: {
            colors: {
                brand: {
                    500: "#6366f1",
                    600: "#4f46e5",
                },
            },
            fontFamily: {
                sans: ["Inter", "sans-serif"],
            },
        },
    },
    plugins: [],
};
