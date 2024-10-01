/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'primary': {
          DEFAULT: '#001D22',
          '94': 'rgba(0, 29, 34, 0.94)',
          '84': 'rgba(0, 29, 34, 0.84)',
          'hover': 'rgb(18, 62, 70)',
        },
        'secondary': '#013943',
        'border': '#003840',
        'stroke': {
          DEFAULT: '#000000',
          '24': 'rgba(0, 0, 0, 0.24)',
        },
      },
    },
  },
  plugins: [
    "@tailwindcss/typography",
  ],
}