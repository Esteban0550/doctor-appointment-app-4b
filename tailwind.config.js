<<<<<<< HEAD
import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'
import typography from '@tailwindcss/typography'
=======
import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
>>>>>>> f9689e724ba3b4b63b9b4acf46f2624d56b2a423

/** @type {import('tailwindcss').Config} */
export default {
    presets: [
<<<<<<< HEAD
        require("./vendor/wireui/wireui/tailwind.config.js"),
    ],

=======
        ...require("./vendor/wireui/wireui/tailwind.config.js")
    ],
>>>>>>> f9689e724ba3b4b63b9b4acf46f2624d56b2a423
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
<<<<<<< HEAD
=======

        './node_modules/flowbite/**/*.js',
>>>>>>> f9689e724ba3b4b63b9b4acf46f2624d56b2a423
        "./vendor/wireui/wireui/src/*.php",
        "./vendor/wireui/wireui/ts/**/*.ts",
        "./vendor/wireui/wireui/src/WireUi/**/*.php",
        "./vendor/wireui/wireui/src/Components/**/*.php",
<<<<<<< HEAD
        './vendor/rappasoft/laravel-livewire-tables/resources/views/**/*.blade.php',

=======
        
        './vendor/rappasoft/laravel-livewire-tables/resources/views/**/*.blade.php',
>>>>>>> f9689e724ba3b4b63b9b4acf46f2624d56b2a423
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

<<<<<<< HEAD
    plugins: [forms, typography],
}
=======
    plugins: [
        forms, 
        typography,
        require('flowbite/plugin') 
    ],
};
>>>>>>> f9689e724ba3b4b63b9b4acf46f2624d56b2a423
