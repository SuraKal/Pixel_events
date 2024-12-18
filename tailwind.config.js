import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                sm: ["15px", "1.25rem"], // 15px with line height of 1.25rem (20px)
                md: ["16px", "1.5rem"], // 16px with line height of 1.5rem (24px)
                
            },
            margin: {
                "custom-20": "20px",
                "custom-50": "50px",
                "custom-100": "100px",
            },
        },
    },
    plugins: [],
};
