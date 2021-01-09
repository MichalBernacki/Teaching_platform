const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: ['./storage/framework/views/*.php', './resources/views/**/*.blade.php'],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            backgroundImage: theme=> ({
                'svg1': "url('/img/svg/001-work-space.svg')",
                'svg2': "url('/img/svg/002-student.svg')",
                'svg3': "url('/img/svg/003-education.svg')",
                'svg4': "url('/img/svg/004-board.svg')",
            })
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
