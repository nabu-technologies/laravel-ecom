/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./src/Resources/**/*.blade.php", "./src/Resources/**/*.js"],

    theme: {
        container: {
            center: true,

            screens: {
                "2xl": "1440px",
            },

            padding: {
                DEFAULT: "90px",
            },
        },

        screens: {
            sm: "525px",
            md: "768px",
            lg: "1024px",
            xl: "1240px",
            "2xl": "1440px",
            1180: "1180px",
            1060: "1060px",
            991: "991px",
            868: "868px",
        },

        extend: {
            colors: {
                // navyBlue: "#060C3B",
                navyBlue: "#11d459",
                lightOrange: "#F6F2EB",
                darkGreen: '#40994A',
                darkBlue: '#0044F2',
                darkPink: '#F85156',

                brand: {
                    green: "#11d459",
                    "light-green": "#dcf9e7",
                    "logo-green": "#c9f740",
                }
            },

            fontFamily: {
                // poppins: ["Poppins", "sans-serif"],
                // dmserif: ["DM Serif Display", "serif"],
                poppins: ["'Inter'", "sans-serif"],
                dmserif: ["'Inter'", "serif"],
                inter: ["'Inter'", "sans-serif"],
            },
        }
    },

    plugins: [],

    safelist: [
        {
            pattern: /icon-/,
        }
    ]
};
