import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
  ],

  theme: {
    extend: {
      colors: {
        primary: {
          DEFAULT: '#F29120',
          50:  '#FFF6EC',
          100: '#FFE7D1',
          200: '#FFD0A3',
          300: '#FFB166',
          400: '#FB9D3F',
          500: '#F29120',
          600: '#E27E12',
          700: '#C9650A',
          800: '#9B4D08',
          900: '#6B3506',
        },
      },
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
      },
    },
  },

  plugins: [forms],
};
